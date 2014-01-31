<?php

namespace Dragoon\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Dragoon\Middleware\MiddlewareInterface;
use JMS\Serializer\SerializerInterface;


/*
	All responses need to follow a standard protocol.
	This standard protocol needs enough information so that one function
	can figure what format (HTML/PLAIN/JSON/XML/YAML)
	Because JSON and XML and YAML are data interchange formats, whereas HTML/PLAIN are more descriptive formats
	we require with each response, a description of what the data means.
	This should be part of the message response.
	Plain should take the message response literally and provide the rest of the information as pretty printed (via var_export or print_r).
	HTML is a bit more wierd. Perhaps we need an HTML template??? NO this is an API framework. So there really shouldn't be HTML outputted. OK no HTML it is.

	{
		"status",
		"data": {
	
		},
		"message" <- description of the data
		"code" <- other various detections
	}

	we should also use options type and a object storage

 */

abstract class AbstractController implements MiddlewareInterface{

	protected $request;
	protected $response;
	protected $serializer;

	public function __construct(Response $response, SerializerInterface $serializer){

		$this->response = $response;
		$this->serializer = $serializer;
		
	}

	public function handle(Request $request){

		$this->request = $request;

		$method = strtolower($this->request->getMethod());
		if(is_callable([$this, $method], true)){
			return $this->{$method}();
		}else{

			$available_methods = $this->getAvailableMethods();
			$content = $this->prepareContent(
				'Requested method is not available on this resource.', 
				$available_methods, 
				'error'
			);
			$this->response->setContent($content);
			$this->response->setStatusCode(405);
			$this->response->headers->set('Allow', implode(', ', $available_methods));
			
			return $this->response;
		}

	}

	//methods will and should always be lower case
	public function getAvailableMethods(){

		$class_methods = get_class_methods($this);

		$available_methods = array_intersect([
			'get',
			'post',
			'put',
			'patch',
			'delete',
			'options',
		], $class_methods);

		return $available_methods;

	}

	public function getAcceptableContentType(){

		//THIS IS COMPLETELY UNTESTED

		$types = $this->request->getAcceptableContentTypes();

		$preferred = [
			'text/plain',
			'application/json',
			'application/xml',
			'application/yaml',
		];

		$matched = array_intersect($preferred, $types);

		if(!empty($matched)){
			return $matched[0];
		}else{
			return $preferred[0];
		}

	}

	//for preparing text content, not binary content
	//THERE NEEDS TO BE A WAY TO to manually force preferred content type and it should return 2 data
	public function prepareContent($message, $data, $status){

		$type = $this->getAcceptableContentType();

		switch($type){
			case: 'text/plain':
				$short_type = 'text';
			break;
			case: 'application/json':
				$short_type = 'json';
			break;
			case: 'application/xml':
				$short_type = 'xml';
			break;
			case: 'application/yaml':
				$short_type = 'yml';
			break;
		}

		//if the shortType is a serializable shortType, we're going to serialize everything
		if($short_type == 'json' OR $short_type == 'xml' OR $short_type == 'yml'){

			$protocol = [
				'message'	=> $message,
				'data'		=> $data,
				'status'	=> $status,
			];

			$data = $this->serializer->serialize($protocol, $short_type);

		}else{

			$protocol = [
				'data'		=> $data,
				'status'	=> $status,
			];

			$data = "$message\n";
			$data .= print_r($protocol, true);
		
		}

		$this->response->headers->set('Content-Type', $type);

		return $data;

	}

	public function options(){

		$available_methods = $this->getAvailableMethods();

		$content = $this->prepareContent(
			'Allowed HTTP methods for this resource include: ' . implode(', ', $available_methods) . '.', 
			$available_methods, 
			'success'
		);

		$this->response->setContent($content);
		$this->response->setStatusCode(200);
		$this->response->headers->set('Allow', implode(', ', $available_methods));

		return $this->response;

	}

}