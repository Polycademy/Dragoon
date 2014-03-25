Dragoon
=======

Dragoon is an experimental framework.

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

Begin providing all dependencies:

IOC, Symfony Config or the other configuration file. Symfony Command, HTTP Kernel, HTTP Foundation. PHPDaemon or AMP, Artax/Guzzle. StackPHP's builder. PHP Asset Loader, PHP Twig. Testing frameworks like Codeception.

You could have a cached folder too, but that's dependent on the project.

Gruntfile should optimise autoload, actually use GulpJS instead! Or Phake!

Input data may have formatting errors. We should deal with that.

Priority: Find a good ORM that is PDO based:

Choose:

1. http://j4mie.github.io/idiormandparis/
2. http://propelorm.org/
3. http://www.doctrine-project.org/

Conditions: Flexibility of SQL databases. Elegant syntax. Fixing up the affected rows. Exposing the PDO object instance.

Follows PSR as closely as possible. Mixed case is fine. Most parts will be in underscore, but some API will obviously utilise camelCase. All data properties will always be in camelCase to match the front end javascript standard.

Choose one HTTP requests library:

1. https://github.com/guzzle/guzzle - Most full featured and complex
2. https://github.com/rmccue/Requests - Quite a nice and simple syntax

Do not use Buzz (<- lacks a lot of features) or Httpful (<- bad at testing)

Use Serializer -> http://symfony.com/doc/current/components/serializer.html for serialising objects.

Use Expression Language for DSL -> http://symfony.com/doc/current/components/expression_language/introduction.html#how-can-the-expression-engine-help-me

Use Options Resolved for complex options in classes -> http://symfony.com/doc/current/components/options_resolver.html

When creating API constructs, one should follow this style: https://github.com/noetix/pin-php
Basically the entire the API structure is mapped to an hierarchical namespaced object structure.
Note that one could do multiple requests individually, or provide convenience objects that do a multitude of requests at the same time.

Dragoon uses PSR-4. It has it's own autoloader. But Composer can be used to.
It needs a site template generator that is a binary executable that can create project with any global namespace.

Perhaps the error object being thrown can contain both the HTTP status code and the Log error status codes! Or there needs to be some sort of translation.

Benchmarking: https://github.com/devster/ubench
DateTime: https://github.com/briannesbitt/Carbon
Asset Management: https://github.com/kriswallsmith/assetic (probably good for template scripts)
Verify: Validation
Filtering (combine with Verify) https://github.com/ircmaxell/filterus
Templating - https://github.com/php-loep/Plates, Mustache, Twig
File Management - https://github.com/KnpLabs/Gaufrette & https://github.com/thephpleague/flysystem
Payment - https://github.com/adrianmacneil/omnipay
API Billing & Throttling - https://github.com/adrianmacneil/omnipay
Uploads - https://github.com/codeguy/Upload & Downloads - Download Controller
XSS - https://github.com/ezyang/htmlpurifier
Shell Manipulation - https://github.com/MrRio/shellwrap
Geolocation - https://github.com/mjaschen/phpgeo & https://github.com/thephpleague/geotools
Colour Manipulation - https://github.com/mikeemoo/ColorJizz-PHP
Data Generator - https://github.com/fzaninotto/Faker
HTTP Requests - https://github.com/rmccue/Requests OR Guzzle OR Artax (for non curl)
Utility - https://github.com/Anahkiasen/underscore-php OR http://brianhaveri.github.com/Underscore.php/
ORM - Propel or Doctrine! Proper transaction and nested transactions support are a must. Transactions begin from the Controller and Models. If you're using Propel or Doctrine, they bundle migrations directly. Using Propel use getConnection() to extract PDO connection: https://github.com/propelorm/Propel2/issues/509
I recommend Doctrine for big applications as the data mapper pattern is far superior to the active record pattern. In small simple apps, use Propel. In even smaller apps just use raw PDO.
Simple ORM - https://github.com/auraphp/Aura.Sql (PDO extended)
Migrations - Phinx
Active Record - https://github.com/j4mie/paris
PDF - https://github.com/psliwa/PHPPdf OR https://github.com/KnpLabs/snappy
Image Manipulation - https://github.com/avalanche123/Imagine OR http://phpimageworkshop.com/
Routing - https://github.com/chriso/klein.php
Logging - Monolog
Middleware - SnapSearch for HTML Interception
Authentication & Authorisation - PolyAuth
Documentor - ApiGen or PHPDocumentor
HTTP Kernel - Symfony Requests
CLI App - Symfony Console
Configuration - Configula
Class Creation - Symfony Options Resolver
DI & IOC - Auryn
Statistics - https://github.com/mcordingley/PHPStats
Functional Primitives - https://github.com/lstrojny/functional-php
API Throttling - https://github.com/davedevelopment/stiphle AND https://github.com/danapplegate/leaky-bucket-php
API Billing - ?? none yet!
API Usage Tracking - ??
Federated Logging - http://graylog2.org/ OR any of the commercial loggers and https://github.com/bzikarsky/gelf-php
Status Page - ??
Internationalisation - intl extension (http://au1.php.net/manual/en/intro.intl.php) OR Symfony Translator http://symfony.com/doc/master/book/translation.html AND https://github.com/dotroll/I18N
Representing Money - https://github.com/ikr/money-math-php for BIG money and https://github.com/mathiasverraes/money for Cents based money
Build Automation - https://github.com/gulpjs/gulp OR Grunt OR https://github.com/jaz303/phake (Rake/Make)
Math - https://github.com/moontoast/math & https://github.com/moontoast/math/issues/3#issuecomment-33243171 OR https://github.com/powder96/numbers.php
Math Equations - https://github.com/rezzza/Formulate & https://github.com/mormat/php-formula-interpreter
Statistics - https://github.com/mcordingley/PHPStats
Multithreading - https://github.com/krakjoe/pthreads
LINQ - https://github.com/akanehara/ginq OR https://github.com/Athari/YaLinqo OR https://github.com/Blackshawk/phinq
Markup or TextFormatting (forums) - https://github.com/s9e/TextFormatter
Output Filtering (XSS/Escaping) - http://htmlpurifier.org/
Encryption - https://github.com/phpseclib/phpseclib
More internationalisation and fallback classes - https://github.com/flourishlib/flourish-classes
Nice exceptions - https://github.com/filp/whoops
Serializable Closures (code as data) - https://github.com/jeremeamia/super_closure
ANSI Colours - https://github.com/kevinlebrun/colors.php
Git Project Maintenance - https://github.com/cordoval/gush
PHP REPL - Boris
LESS - https://github.com/mrmrs/colors
Client Side Persistence - http://www.slideshare.net/casden/inbrowser-storage-and-me
AngularJS Style Guide - https://github.com/mgechev/angularjs-style-guide
Autoloader (PSR-4 and PSR-0) - https://github.com/auraphp/Aura.Autoload
Deployment (SSH) - https://github.com/Anahkiasen/rocketeer
Option Type - https://github.com/schmittjoh/php-option
PHP Parsing - https://github.com/nikic/PHP-Parser
Serializer (XML, JSON, YAML) - https://github.com/schmittjoh/serializer
Collection Type - https://github.com/schmittjoh/PHP-Collection
PHP Source Code Manipulator - https://github.com/schmittjoh/PHP-Manipulator (This is needed!?)
DSL Parsers - https://github.com/schmittjoh/parser-lib & https://github.com/symfony/expression-language & https://github.com/hafriedlander/php-peg & http://www.slideshare.net/troelskn/overview-dslforphp & https://github.com/maximebf/parsec & http://stackoverflow.com/questions/3720362/what-is-a-good-parser-generator-for-php & http://stackoverflow.com/questions/13940641/implementing-a-dsl-in-php (To do this in JS: https://github.com/zaach/jison)
Event Bus - https://github.com/igorw/evenement
Async Task Queue - https://github.com/CoderKungfu/php-queue
Jade for Templates - https://github.com/visionmedia/jade - this can be combined with PHP Plates for the initial template. But since all templates are client side anyway. Don't bother with plates unless you're not writing a Client side app! BTW HTML IS UGLY!
HATEOAS - https://github.com/willdurand/Hateoas


Investigate - https://github.com/auraphp/Aura.Marshal

For everything else -> https://github.com/ziadoz/awesome-php AND http://thephpleague.com/

Indent using 4 spaces for tabs.

Process Management: http://blog.crocodoc.com/post/48703468992/process-managers-the-good-the-bad-and-the-ugly

https://github.com/chriso/klein.php/issues/166#issuecomment-31385173

USE: https://github.com/nicolas-grekas/Patchwork-UTF8 for UTF8

Barcode - https://github.com/dineshrabara/barcode
String Manipulation - https://github.com/danielstjules/Stringy

OOCSS!
http://coding.smashingmagazine.com/2011/12/12/an-introduction-to-object-oriented-css-oocss/

Use PHP Fractal for data marshalling!

Use: https://github.com/willdurand/Negotiation for negotiation AND READ THIS: http://stackoverflow.com/a/385216/582917

Start using Pux as a router again. It supports PATCH, HEAD, OPTIONS!

https://github.com/eloquent/asplode

Character Encoding Issue
------------------------

There is a big problem with UTF-8 and PHP:

http://www.phpwact.org/php/i18n/charsets
http://stackoverflow.com/questions/279170/utf-8-all-the-way-through
http://kunststube.net/encoding/

Need to solve this for portability.

Use composer install --no-dev during production!

https://github.com/jackfranklin/pulldown - Dependencies on specific files.

If we use Jade as a templating language. We could the templates and partials and compile down to one single file that can still be rendered with PHP.
However elements should be compiled elements. Should they use Jade? Yea sure I guess. They can compile down to .html files.

Angular Elements => http://benclinkinbeard.com/posts/towards-atomic-angularjs-components-with-browserify/
https://www.npmjs.org/package/partialify

PHP HIGH PERFORMANCE! (opcode cache has a problem with Rocketeer and Capistrano)
https://support.cloud.engineyard.com/entries/26902267-PHP-Performance-I-Everything-You-Need-to-Know-About-OpCode-Caches

Zero downtime for NGINX?

http://blog.argteam.com/coding/hardening-node-js-for-production-part-3-zero-downtime-deployments-with-nginx/
http://blog.argteam.com/coding/hardening-node-js-for-production-part-2-using-nginx-to-avoid-node-js-load/
http://blog.argteam.com/coding/hardening-nodejs-production-process-supervisor/

DEPLOYMENT SCENARIO:

React (dragoon can be the server starter, by adding commands to dragoon)
https://github.com/marcj/php-pm
http://marcjschmidt.de/blog/2014/02/08/php-high-performance.html
HHVM
Mongrel2 instead of Nginx (for fault tolerance and resending messages)
Add in multithreading and coroutines
Now PHP-PM just needs process monitoring and restarts and managing memory.
http://software-gunslinger.tumblr.com/post/48215406921/php-is-meant-to-die-continued

No more configuration of big frameworks.
Code is configuration. No system libraries.
The framework is your app. The app is your framework.

https://github.com/c9s/GenPHP for Generating PHP code

Transformers also enforce the integrity of data by typecasting every possible variable. You can be sure and remind yourself what the types of the data is!

Model entity architecture: https://github.com/laravelbook/ardent (How would it fit in with Verify? BeforeFilter + Validation + AfterFilter (Coercing/Casting/Moulding) rules.) Seems automatic hydration is pretty cool, but it introduces overhead to the architecture.

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

https://github.com/facebook/watchman (use with Symfony Process)

Use psysh and with the rc.php. This allows you make psysh when at the current working directory (getcwd()) of the project, it can use the loader to autoload everything. Allowing you to have REPL for the entire project. This means you can quickly test new code or libraries in the context of your app. No more creating test files or test controllers. Just straight up launch psysh, if the Bootstrap + Autoloader is available, just go and load them up! Then let's say you want test out if some code works in isolation. Then you load your libraries, and away you go. Let's you write a model, and you have a function in that model that don't know if it will work, then go ahead and straight up test it. It's a goldmine! Actually the psysh shell should bring in the bootstrapper. Basically this means any Autoloaders (Composer + Custom autoloaders), and an IOC that allows you to quickly instantiate any class. Also any bootstrapping logic might be good.

Also collections should have metadata, so you acquire information about the collection, but the collection itself. The transformers can embed this metadata. The collection metadata can be on the array itself. Like Object[1, 2...etc] but also Object.metadata ...etc. Arrays are objects in Javascript. Most important thing is that a collection is a array of objects, of which the object would be a single entity if the resource was requested as one GET operation.

Involve EventBus, Hooks, Interceptors and AOP into the framework, allowing you to do things at certain times. Such as hooking to a database update/create and running some other code. Even logging can be intercepted. It also makes the framework pluggable: http://symfony.com/doc/current/components/event_dispatcher/introduction.html  Logging is not part of the logic, so you can inject logging into wherever it's needed.

Client side code should be in a separate repository to the server side code. The server side exposes and API. The client side consumes it. However because a single repository means a single application, the server side repo needs some way of connecting to the client side in order to serve up the initial client side application. There are 3 ways of doing this: Deployment adapter (that brings the 2 together), Git Submodules, Git Subtree or private dependency manager. I believe Git Subtree in the short term will be the most useful. Here is how you do subtree: http://blogs.atlassian.com/2013/05/alternatives-to-git-submodule-git-subtree/
In the future there needs to be a private dependency manager that should be super easy to use.
The server repo is still the master repo though, because the server repo is the one that needs to be deployed.
Bower might be good as a private repo thingy. But I don't want to run a bower registry! So I use simply something that can pull in private projects. But remember the client side repository does not all the dependencies either, so we need to pull in it's bower's dependencies... etc and potentially NPM dependencies. So... maybe we if only have client side dependencies as bower, and testing dependencies can be NPM on the client side.
Build scripts would be part of the server side repository.

We need to integration fault tolerant programming using:

https://github.com/eloquent/asplode
PHP Try type
PHP Option type
Phystrix
Perhaps AOP can help here too.

Auryn DI should use caching: https://github.com/rdlowrey/Auryn/issues/53

Any automated task needs to correctly ascertain if the job is done on a development server. In this way they should conflict with the actual production server. Especially if it's calling external APIs. If external APIs have a testing parameter, then use it. If not, you must mock the response. Otherwise automated jobs such as cron should not be launched on the dev server.

Ideas regarding new framework:

IOC (
    Router (
        Kernel + MW - Content-Negotiation, Main Requests, Sub Requests (see hhvm), Redirect for Sockets, Global Exception Handling, Status Codes based on FSM, FSM can be called by any layer to change the status and morph it to whatever, Request Kill Timeout (
            Controller - Model Management, Transactions, Multithreading, Async, Simultaneous, Forking, Coroutines, Task Scheduler, Promises, Storage Adapter Choice, Initiating SubRequests for Embedded Data/Composition (
                Validator + Filter + Business Rules (
                    Model + Modules + Libraries + Workers (
                        Transformers (
                            LINQ + Business Rules (raw data gets turned into appropriate format)
                        )
                    )
                )
            )
        )
    )
)

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

When adding new resources:

1. Create the Controller and subsequent wrappings.
2. Load it into the IOC (traversal of needed tools)
3. Register it as part of the Router

(Use the Dragoon cli tool to automate this.)