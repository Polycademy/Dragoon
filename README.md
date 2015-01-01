Dragoon
=======

Dragoon is an experimental API framework. It's focused on bringing the concepts of FBP (flow based programming), AOP (aspect oriented programming), FRP (functional reactive programming), CSP (communicating sequential processes), CPS (continuation passing style), immutable data structures, fault tolerant dependencies, ubiquitous concurrency, service oriented dependent interfaces, inversion of control, multi-paradigm (async/sync/coroutines) framework, test/behaviour driven optimisation and implementing them in PHP. However the end result should be a framework interface that can be adapted to any general purpose language. One of the driving philosophies is that the front end is just another service and that it should be a separated project (literally repositories) to the backend, and that they should communicate over both asynchronous and synchronous communication protocols (that are able to upgrade or downgrade easily).

Nothing is currently usable right now. Still in pre-alpha phase.

We need a Vagrant Docker to provision and run this application! Vagrant + Docker is probably better than a full image. Although a full image can be used with Tiny Core Linux.

Routing Structure
-----------------

Server (daemon loop)
    -> records HTTP requests (asynchronously) (initiates Front Controller)
        -> HTTP requests are converted to HTTP Foundation
            -> HTTP Foundation is pipelined into middleware pipe
                -> Middleware is piped to Composer (Router)
                    -> Router hits the Controller
                        -> Controller brings together all the modules to do work
                            -> Templater uses Macro Template + URL DSL
                                -> Construct Response
                            <- End Tmplaterr
                        <- End the controller
                    <- Finish Routing
                <- Reponse middleware pipe
            <- Converter to HTTP Foundation Response
        <- Response object
    <- outputs response

External Server Eventloop + FastCGI
    This then just starts at the HTTP Foundation level entering into the Front Controller

```
                                                                Kernel is a Monad! It's also the IOC DI.                                                                 
                                                                                                                                                                         
                                                                                                                                                                         
                                     Request     +-------------------------------------------------------------------+                                                   
            +-----------------+                  |                                                                   |                                                   
            |                 | +------------->  +-+                                                                 |                                                   
            |                 |                  | |                                                                 |                                                   
            |                 |                  | |  +---------------------+             +------------------+       |                                                   
   SAPI     |                 |                  | |  |      Aspect         |             |      Aspect      |       |                                                   
            |   Router is     |                  | |  |                     |             |   +-----------+  |       |     T => Type Task                                
+-------->  |   the composer  |                  | |T |  T +------------+ T | T        T  | T |Controller |T |T      |     Aspects and Controllers are Functions         
            |   that executes |                  | +> | +> | Controller +-> | +---------> +-> |           +-----+    |     that accept and return the same type T.       
            |   the flow      |                  |    |    +------------+   |             |   +-----------+  |  |    |     Which allows them to be infinitely composable,
            |   based graph.  |                  |    |                     |             |                  |  |    |     and deterministic. Side effects allowed!      
            |                 |      Response    |    +---------------------+             +------------------+  |    |                                                   
            |                 |                  |                                                              |    |                                                   
            |                 | <-------------+  | <------------------------------------------------------------+    |                                                   
            +-----------------+                  |                                                                   |                                                   
                                                 +-------------------------------------------------------------------+                                                   
            Router processes                                                                                                                                             
            DSL and Macro Template                               Aspects take over the role of middleware.                                                               
            which comes from the                                 In other words, any logic that is a cross                                                               
            external client.                                     cutting concern is an aspect!                                                                           
```

Things to incorporate:

1. Symfony Options Resolver
2. Dragoon based Autoloader
3. https://github.com/auraphp/Aura.Marshal
4. https://github.com/thephpleague/fractal
5. LINQ
6. Artax + Phystrix
7. Expression Engine for DSLs
8. Pysh for running Dragoon from the Commandline and internal documentation!

DSL and Macro Template:

1. http://www.sitepen.com/blog/2010/11/02/resource-query-language-a-query-language-for-the-web-nosql/
2. http://www.jsoniq.org/
3. https://github.com/ativelkov/yaql
4. http://htsql.org/paper/icomp07_paper.pdf
5. http://www.javacodegeeks.com/2012/01/simplifying-restful-search.html
6. http://www.w3.org/DesignIssues/MatrixURIs.html and http://stackoverflow.com/questions/401981/when-to-use-query-parameters-versus-matrix-parameters and http://stackoverflow.com/questions/2048121/url-matrix-parameters-vs-request-parameters

Using an FBP graph we can use as a "compositor" or "orchestrator" that wires up the inports and outports of each controller. The T type which is the task type is a simple type specifying the Req and Res. Controllers can be ran in separate threads if needed, but otherwise they are simply spun up as part of the same process, with the idea of the inports and outports orthogonal to the actual transport layer, it could just be memory copies after all. The FBP graph is also the IoC in this case, injecting dependencies to construct the controllers. Part of this will be done through the Resource Query Language.
Furthermore unlike Noflo, the inports and outports are not strictly defined, but simply the public functions of the controllers. So whichever public functions there are, they represent the inports. In a RESTful controller, there are GET, POST, PUT, PATCH, DELETE. These isolated operations can be piped into each other, so one can activate a delete on one controller, and recursively activate a get function on the same controller. But it could also pipe into another controller. Now as to the error control semantics, this probably is not defined by the in-port functions, because they can't know what piped into them. Instead this is setup at a high level, either from the IoC Object/Flow Graph, or the Resource Query Language. Fail hard, fail soft, or fail in between. Along with split tracks... etc.
There maybe a problem regarding serialisation of output data and then deserialisation of input data at each connection pipe. We could just leave it with this problem, but it might also be possible to make it that when piping to each other, they use a very cheap serialisation method? Instead of human readable output format? So we're not encoding into JSON at the end of each controller endpoint, but instead we're just passing straight text? Or some sort of memory encoded data structure? Like a raw array? Binary arrays? Now what if these controllers live in a distributed system? Then you're in erlang territory already. If we do this, then there's no such thing as template transformer at the end of each function, instead there is an Human Readable Output controller. This becomes the default end pipe to collates everything together, it's the "REDUCE" function. Or templating function? See this: http://en.wikipedia.org/wiki/Data_transformation and http://stackoverflow.com/questions/6845682/real-time-collaborative-drawing-whiteboard-in-html5-js-and-websockets
What about split piping and returning everything. We need some way of linearing them?
The whole DSL should be able to quickly define a hypergraph, graphs that contain subgraphs, subgraphs make up minicomputations, and they can become macros that can be inserted between operations and larger operations.

->C1 -> (subgraph C21 -> C22 ?? recursive?) -> C3

One interesting difference is that FBP makes components first class citizens, whereas controllers are not really intended to be loaded by other controllers. They define the API endpoints, that can be reused in order construct more flexible resource outputs, and promise pipelining of functionality.

However the end modules that are used by the Controllers can also be managed by FBP. They can be wired up, using hypergraphs as well.

Is there a way in which we can blur the difference between Controller Components and Module Components, so that Module Components can be elected to become Controller components?

I guess one can think of Controller Components are the entry points with no immediate ancestors. Whereas the module components are not necessarily meant to be used against the public manner. They are the business domain logic which can also be modelled using flow based programming if need be.

Another concept is FSM -> Finite State Machines. They are slightly different in the idea that one models the changes in the state of a single value. They are essentially sequential control?

Hypergraphs are simpy that instead of nodes directly connected to each other, that is edges with 2 vertices, but that edges can have multiple vertices. So 3 nodes can be connected to each other using a single edge. For example a hypergraph is useful when a relationship isn't strictly binary, but trinary and up. In chemistry one can model A+C => B+C. In that with C as a catalyst, it changes to A to B. Therefore instead of A <> B, it's actually A <> B <> C. In terms of DSL, one would command dataflow like A -> out (B, C), which splits A's output to B and C. Or that A -> B -> C. Which means A's output goes into B then C. But this is simple binary relationships. 

Noflow has a FBP network protocol which allows WAN communication! Also internal messaging too.

You know subgraphs are packaging a wired up graph to be used elsewhere, it doesn't really DSL perspective, but represents a domain model that can be used by the user. I think this means that one should be able to create subgraphs for the user to use as expressions in the DSL.

We need experiment with Swoole or React + Recoil (https://github.com/recoilphp/recoil)

Noflow exported to JSON graph language is not a good way of writing applications. It's an approximation of visual but turned into an ugly and verbose format. This format is great for machines though. I can envision that one can export the program into a JSON graph, and another machine can read the JSON graph and visualise it. Or the other way around would be create something visually then export it to a graph, which might be able to be converted to a DSL.

Finite State Machines => http://ptolemy.eecs.berkeley.edu/papers/96/bilungMasters/msReport.pdf

Some ideas here: https://github.com/bergie/phpflo/blob/master/src/PhpFlo/Graph.php

DSL and Math DSLs
-----------------

Use Expression Language for DSL -> http://symfony.com/doc/current/components/expression_language/introduction.html#how-can-the-expression-engine-help-me

Data Structures
---------------

We need proper data structures in programming. I believe static typing is superior to loose typing. I also believe that typing for most purposes should be simple and reusable. They should be able to prevent errors!

* http://linepogl.wordpress.com/2011/03/15/a-php-maybe-monad-2/
* http://poefke.nl/code/php-option-maybe/
* https://github.com/schmittjoh/php-option
* https://github.com/asm89/php-try
* https://github.com/morrisonlevi/Ardent

Automation
----------

It needs a project template generator that is a binary executable that can create project with any global namespace.

We need to deal with migrations and backups at this point. Migrations can exist on schema or data or both.

The CLI tool will also setup configuration properties. Prevents the need to parse config directly. It can use Configula. The configuration should also be "dynamic", in that can be requested from external sources and cached? The tool could also listen on events and be activated like a daemon.

https://github.com/schmittjoh/PHP-Manipulator to change the source code. We may need to use PHP-Parser.

Use this https://github.com/c9s/GenPHP for generated scaffolding.

CLI can run watch + processes such as mess detector, lint, style checker, and also benchmarking. It can benchmark based on API end point, or running particular controller/model/transformer (in fact automated tests should profile and benchmark everything, since they are ones running the code). Watch changed files and launch these tasks. Can run simultaneous queries. Watch can also learn from logs. So debug logs can be sent to the watcher. "dragoon watch debug"

PHP PDepend
PHP Copy/Paste Detector
PHP Analyzer

It should use things like Mondrian..etc to figure out dependency graphs if your framework.

Memory benchmarking will be important in detection of any memory leaks. Especially if you can drill down.

Then use ASCII graphs!

Benchmarking:
https://github.com/almadomundo/benchmark
https://github.com/polyfractal/athletic
https://github.com/BKWLD/reporter
https://github.com/firstrow/feature-science

https://github.com/facebook/watchman (use with Symfony Process)

When adding new resources:

1. Create the Controller and subsequent wrappings.
2. Load it into the IOC (traversal of needed tools)
3. Register it as part of the Router

Exception Handling
------------------

All exceptions are handled from the root.

All PHP errors are converted to the exceptions.

At no point should ANY error/exception be shown to the end user. It must all be controlled.

Perhaps the error object being thrown can contain both the HTTP status code and the Log error status codes! Or there needs to be some sort of translation.

https://github.com/eloquent/asplode

https://github.com/freddiefrantzen/e2ex

Debugging
---------

Integrated PsySH to allow interactive testing and random coding experiments.

Use psysh and with the rc.php. This allows you make psysh when at the current working directory (getcwd()) of the project, it can use the loader to autoload everything. Allowing you to have REPL for the entire project. This means you can quickly test new code or libraries in the context of your app. No more creating test files or test controllers. Just straight up launch psysh, if the Bootstrap + Autoloader is available, just go and load them up! Then let's say you want test out if some code works in isolation. Then you load your libraries, and away you go. Let's you write a model, and you have a function in that model that don't know if it will work, then go ahead and straight up test it. It's a goldmine! Actually the psysh shell should bring in the bootstrapper. Basically this means any Autoloaders (Composer + Custom autoloaders), and an IOC that allows you to quickly instantiate any class. Also any bootstrapping logic might be good.

Agile Optimisation
------------------

Tests are constructed 2 levels: behavioural/functional API tests, then class unit tests.

We use a watchman to watch changed files. On each change, tests are ran. On each test performance benchmarks are ran and compared. Logs are generated. Reports are created. Reports can be temporary.

Upon any kind of deployment, dependencies are locked, and autoloading is fixed.

Runtime Agnostic
----------------

We should endeavour to make Dragoon workable in production with HHVM and standard PHP.

Standard Library
----------------

Dragoon does not provide it's own standard library. It needs to take advantage of other people's work across the whole PHP community. See thehitlist for more.

Reactive Process Flow
---------------------

Middleware layer should follow with HTTPKernal like developments. But HTTPKernel sucks, it's too Symfony focused.

It will include Content-Negotiation https://github.com/willdurand/Negotiation

Involve EventBus, Hooks, Interceptors and AOP into the framework, allowing you to do things at certain times. Such as hooking to a database update/create and running some other code. Even logging can be intercepted. It also makes the framework pluggable: http://symfony.com/doc/current/components/event_dispatcher/introduction.html  Logging is not part of the logic, so you can inject logging into wherever it's needed.

IOC (
    Router (
        Kernel + MW - Content-Negotiation, Main Requests, Sub Requests (see hhvm), Redirect for Sockets, Global Exception Handling, Status Codes based on FSM, FSM can be called by any layer to change the status and morph it to whatever, Request Kill Timeout (
            Controller - Model Management, Transactions, Multithreading, Async, Simultaneous, Forking, Coroutines, Task Scheduler, Promises, Storage Adapter Choice, Initiating SubRequests for Embedded Data/Composition, MapReduce (map out tasks to models, reduce to single result with a transformer) (
                Validator + Filter + Business Rules (
                    Model + Modules + Libraries + Workers (
                        Do the work and return results
                    )
                )
                Transformers (
                    LINQ + Business Rules (raw data gets turned into appropriate format)
                )
            )
        )
    )
)

WE HAVE NOT FIGURED OUT SUBRESOURCES, PERHAPS NESTED RESOURCES via NESTED controllers. HMVC? Remember 4 different resources: 1. Resources
2. Embedded Resources (cross referenced data)
3. Composited Resources (combined data, not necessary embedded, basically transformed data)
4. Subresources (data that exists only in relation to a parent resource)

Whats interesting is the when querying for a subresource, that subresource is the only one that is interesting to the client. We are not embedding a subresource into the parent resource, the subresource stands along as the response output. This means a chained path is just that, it's just directions to find out the subresource. Therefore any HMVC solution would not be using the parent resource's controllers, only the subresource's controller, and the subresource controller will need resolve the path and their ids to see if there is a relevant resource. In order to make the path finding quicker and more efficient, the path finding is not separated between the resources, but concentrated in the subresource, there'll need to be a query construction that allows you to traverse the ownership graph. The specific way to do this is left to the programmer. For example MySQL has a number of ways to represent hierarchal data: http://www.slideshare.net/billkarwin/models-for-hierarchical-data 
A cool little thing would be a way to build a single pathfinding chain from parent controllers to child controller, and then running this query. Perhaps LINQ might help here too... But that might be sufficiently complex too.
http://karwin.blogspot.com/2010/03/rendering-trees-with-closure-tables.html Closure table method seems the best!

Global transformations such as embedding, composition and HATEOAS and Content Negotation (language/format) can be done either in the Kernel MW or in a Master Transformer (inherited transformer) or Traits..etc. It depends. If the entire APP will always be RESTful..etc, then in the Kernel MW might be better. If however some parts of the app does not use those aspects, then a Master Transformer might be better.

URLs a directive (functional) based DSL for controlling a REST API through REST methods, HATEOAS, query parameters and matrix parameters. Will support embedding cross referenced data via subrequests, and transformations (operations) of the data by forcing LINQ.

new Controller ( new Validator ( new Model (new Transformer ) ) ); (each thing will be a callable class)

return $validate($data);
return $model($data);
return $transformer($data);
return $data;

URLS need to allow:

0. Constraints (limit/offsetting data)
1. Transformation (transformation of data)
2. Composition (cross referenced unrelated data)
3. Embedding (cross referenced embedded data)
4. Payload (GET query param or POST payload)
5. Direction (Path Segments)

SOA Interface
-------------

Dragoon's API will abide by varous service interfaces. Choose one!

HATEOAS - https://github.com/willdurand/Hateoas
See WOAE for more ideas.

Also collections should have metadata, so you acquire information about the collection, but the collection itself. The transformers can embed this metadata. The collection metadata can be on the array itself. Like Object[1, 2...etc] but also Object.metadata ...etc. Arrays are objects in Javascript. Most important thing is that a collection is a array of objects, of which the object would be a single entity if the resource was requested as one GET operation.

Syntactic Sugar
---------------

Dragoon will create syntactic sugar where necessary, in some other languages it may not be needed. But we need ease of use and testability. This will include common operations like underscore, functional primitives, and LINQ. LINQ is required because we need a declarative way to manipulate data structures. Also superclosures for the ability to serialize code and allow code to be transportable cross-process.

* https://github.com/Anahkiasen/underscore-php
* https://github.com/lstrojny/functional-php
* Laravel's Facade Pattern
* https://github.com/akanehara/ginq
* https://github.com/Athari/YaLinqo
* https://github.com/Blackshawk/phinq
* https://github.com/jeremeamia/super_closure

Syntactic sugar will not be dependency injected, because this would laborious. Consider them like global helpers. But they are still testable using Laravel's Facade Pattern.

Atomic Transactions
-------------------

This is referring to as single system, not a distributed system. Distributed systems have another problem involving CAP.

http://en.wikipedia.org/wiki/CAP_theorem
ACID

Transactions in Dragoon need to operate of the controller layer. Not at the model or worker layer. If multiple controllers will be brought together to do work, then transactions need to be initiated at the middleware layer. Any further, then the client will need to bring up their own transaction model or implement distributed transactions.

UTF8 Compliant
--------------

Dragoon needs to be fully UTF-8 compliant and internationalisation enabled.

https://github.com/nicolas-grekas/Patchwork-UTF8
https://github.com/danielstjules/Stringy (this will be implemented as syntactic sugar)

Separated Client Side
---------------------

Client side code should be in a separate repository to the server side code. The server side exposes and API. The client side consumes it. However because a single repository means a single application, the server side repo needs some way of connecting to the client side in order to serve up the initial client side application. There are 3 ways of doing this: Deployment adapter (that brings the 2 together), Git Submodules, Git Subtree or private dependency manager. I believe Git Subtree in the short term will be the most useful. Here is how you do subtree: http://blogs.atlassian.com/2013/05/alternatives-to-git-submodule-git-subtree/

Read Only Maintenance
---------------------

This is better than maintenance page.

Will need client side operations to block post, put, patch, delete. But allow logout, but not login.

Can do this on router level, need to notify any non idempotent actions with read only maintenance status. This should allow clientside to react.

Add admin page with just controls. Admin page widgets?

Certain actions may be allowed such as logging read count, but they must be partitioned, not part of the same DB. Also you dual set to readonly. Such as database and router.

But what about dynamic services like the SnapSearch robot? I think that will need to be shutdown too.

In some cases, the database may have failed, or network failure. In that case the front end can request from a static mirrored cache that acts as primary backup. Essentially a backup server which is set to readonly.

Swoole
------

Make this work with Swoole! One day we won't need PHP-FPM.

Composable RESTful RPC
----------------------

REST is essentially a form of constrained RPC with a bunch of rules. While these rules are great as a standard of resource communication, they often fall flat when it comes to more complex requirements. Here are somethings we need to allow a more flexible API creation:

1. Transparent upgrade/downgrade between stateless and stateful connections. That is an HTTP request upgrades to WebRTC (preferred over WebSockets) and downgrade the HTTP request.
2. Transparent encoding and decoding of data whether it is in readable text form or binary. So if we're transferring binary over readable text, we need to use base 91.
3. Transparent support for streaming, this relates to stateless/stateful conenctions.
4. Composable APIs via Promise pipelining and RESTful promises. This means we take ideas from Cap'n Proto's promise pipelining "time travel" RPC. This means users can still implement simple API methods corresponding to RESTful resources, but there's support for subrequests and subresources, and a promise pipelining abstraction that allows one client call to bring together multiple API calls and merge their results, or pass one result into another result, in a functional declarative way. Perhaps it's possible for RESTful RPC to define macro templates to be passed from client to server. Imagine where the client can send a macro template in its message body or URL segments/query parameters, which allows one to perform API operations like using one call to map out to multiple calls and then reduce to a single resource. Or using one call to pipeline the dataflow from one function to another.

```
                                                                                                          THIS IS A SINGLE PROGRAM.                                                           
                                                                                                          DATAFLOW OCCURS INSIDE IT.                                                          
                                                                                                          OF COURSE THE CLIENT DOESN'T KNOW                                                   
                                                                                                          ABOUT THE SERVER'S UPSTREAM DEPENDENCIES.                                           
                                                                                                                                                                                              
                                                                                                                                                                                              
                                                                                                                                                                                              
                                                                                                                   +---------+                           Dataflow                             
                                                                 Mapped Subrequests                                |         |                           Pipelining                           
                                                                                    +--------------------------->  |   λ     | +-------------------+                                          
                                                                                    |                              |         |                     |                                          
                                                                                    |                              +---------+                     |                                          
                                                              +---------------------+                                                              |                                          
                                                              |                                                                                    |                                          
                                                              |                                                                                    |                                          
                                                              |                                                                                    |               +-----------+              
                                                              |                              These are just API     +---------+                    |               |           |              
                                                              |                              "endpoints"            |         |                    |               | Use Macro |              
                                                              |                              "methods"              |   λ     | +------------------------------->  | Template  |  +----------+
                                                              |                              "procedures"           |         |                    |               |           |             |
+-----------+                                                 +                              "resources"            +---------+                    |               +-----------+             |
|           |    Declarative Expression Graph                                                "whatever"                                            v                                         |
|           |                                      +------------+                                                            ^                                           ^   ^               |
|           |                                      |            |                                                            |              +-----------+                |   |               |
|  Client   | +-------------------------------->   |  Composer  |   +---------------------+                                  |              |           |                |   |  Reduce       |
|           |                                      |            |                         |                                  |              |    λ      |                |   |  Transformer  |
|           |                                      +------------+                         |                     +---------+  +------------+ |           |                |   |               |
|           |         Also contains:                                                      |                     |         |                 |           |                |   |               |
+-----------+         Macro Template                                                      |                     |         |                 +-----------+                |   |               |
                                                           +                              +------------------>  |   λ     |                                              |   |               |
        ^                                                  |                                                    |         | +--------------------------------------------+   |               |
        |                                                  |                                                    +---------+                                                  |               |
        |                                                  |                                                                                                                 |               |
        |                                                  |                                                                                                                 |               |
        |                                                  |                                                                                                                 |               |
        |                                                  |                                                                                                                 |               |
        |                                                  |                                                                                                                 |               |
        |                                                  |                                                                                                                 |               |
        |                                                  +--------------------------------+                               +-----------+                                    |               |
        |                                                                                   |                               |           |                                    |               |
        |                                                                                   |                               |    λ      |                                    |               |
        |                                                                                   +-----------------------------> |           | +----------------------------------+               |
        |                                                                                                                   |           |                                                    |
        |                                                                                                                   +-----------+                                                    |
        |                                                                                                                                                                                    |
        |                                                                                                                                                                                    |
        +------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
                                                                                                                                                                                              
                                                                            Response                                                                                                          

```

But what can we use do such a declarative expression graph? And how would our Composer work in order to perform map reduce operations or dataflow pipelining?

Anyway thus big programs are created by little programs, and it's turtles all the way down.

Note that the whole map reduce concept up there does not necessarily mean all the functions are calculated in parrallel. They could be processed sequentially, but they might be parrallel, who knows? The client doesn't need to know the implementation specifics. If we're talking about PHP, such a thing might be done via real multithreading using pthreads, or subprocesses actually launching subinstances similar to HHVM. Or just doing each sequentially in normal PHP using subrequests similar to HTTPKernel. Or the composer could be moved to the client side instead of the server side, and the client would be the one sending multiple requests. This does mean increased network load however, and is often what is used when the server is not very intelligent.

HATEOAS is somewhat similar but also supports discoverability.

Another key consideratio is this maps well to capabiility based security or RBAC security. However one has to make a decision as to whether the API fails hard or fails soft. Or maybe that concern is shifted to the client. Fail hard means if any resources or lambda refused to cooperate due to a lack of security, we fail the whole request. Whereas fail soft is you just ignore it and continue on. This has the implication for network requests, whether the request is strict or not strict with regards to a failure over the network. I think this depends on whether the task is meant to be atomic and transactional or not. So I guess it's all about ACID guarantee or not.

Anyway:

1. http://en.wikipedia.org/wiki/Function_composition_%28computer_science%29
2. http://en.wikipedia.org/wiki/Monad_%28functional_programming%29
3. http://en.wikipedia.org/wiki/Monad_%28functional_programming%29

So we have a new thing called ASCID transactions. Atomic Secure Consistent Isolated Durable.

Data Streaming
--------------

Client side should stream all of its inputs most of the time, unless when it expects the data is small.

Our CSV can be streamed.

Our JSON can be streamed using Oboe.js

XML can also be streamed.

So can YAML!

I recommend YAML over XML in pretty every situation!

JSON is very good too.

The great thing, is that servers don't have to do anything. It's always from the client side!

Streaming has a huge advantage in perceived performance. Note that for streaming to work well, the data must be "sequentially read". You cannot operate on the data if you need "random writes".

The other cool thing about Oboe.js, is that you can request a LARGE JSON stream or when it never completes, and you can still use the data.

Also check this out: https://github.com/blongden/hal