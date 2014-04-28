Dragoon
=======

Dragoon is an experimental API framework. It's focused on bringing the concepts of FBP (flow based programming), AOP (aspect oriented programming), FRP (functional reactive programming), CSP (communicating sequential processes), CPS (continuation passing style), immutable data structures, fault tolerant dependencies, ubiquitous concurrency, service oriented dependent interfaces, inversion of control, multi-paradigm (async/sync/coroutines) framework, test/behaviour driven optimisation and implementing them in PHP. However the end result should be a framework interface that can be adapted to any general purpose language. One of the driving philosophies is that the front end is just another service and that it should be a separated project (literally repositories) to the backend, and that they should communicate over both asynchronous and synchronous communication protocols (that are able to upgrade or downgrade easily).

Nothing is currently usable right now. Still in pre-omega phase.

Routing Structure
-----------------

Index.php is the FC.
Router.php is a master middleware which calls in the other middleware.
Loader.php is the IOC that bootstraps all modules, libraries and most importantly controllers.

Loader is the IOC that registers all the necessary controllers and modules.
The Kernel needs to the Loader so it can build up a stack of middleware. (pre middle and post middle)
The Router needs to the Kernel so it rout any URL paths to the controller, while running through the middleware
stack(A, B, C) -> Controller -> stack(X, Y, Z)

Router
    -> /
        -> Stack(A, B, C, D)->IOC->Stack(X, Y, Z)

Use FastRouter

Build Tools
-----------

Gulp.js for streamed and watched builds.

Object Construction
-------------------

IOC - Auryn build object graph at the front. Perhaps we have intermediate factories so that it's not all in one bootstrapped superclass. Or we could use traits to build related objects.
Use Options Resolved for complex options in classes -> http://symfony.com/doc/current/components/options_resolver.html

Dragoon uses PSR-4. It has it's own autoloader. But Composer can be used to.

Persistent State Manipulation
-----------------------------

Temporal database. Functional databases. ORM. Data hydration into correct models.

Storage should be abstracted into drivers, these drivers are therefore declarative. Moving the storage access logic out of the flow.

This is all about converting the data model stored into a data model workable in PHP.

http://www.doctrine-project.org/
https://github.com/auraphp/Aura.Marshal
https://github.com/thephpleague/fractal
LINQ implementations.

Conditions: Flexibility of SQL databases. Elegant syntax. Fixing up the affected rows. Exposing the PDO object instance.

Standards
---------

Follows PSR as closely as possible. Mixed case is fine. Most parts will be in underscore, but some API will obviously utilise camelCase. All data properties will always be in camelCase to match the front end javascript standard.

Communications
--------------

Requests + Artax + Phystrix

Serializing
-----------

Use Serializer -> http://symfony.com/doc/current/components/serializer.html for serialising objects.

DSL and Math DSLs
-----------------

Use Expression Language for DSL -> http://symfony.com/doc/current/components/expression_language/introduction.html#how-can-the-expression-engine-help-me

Data Structures
---------------

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