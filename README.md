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

Gruntfile should optimise autoload

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
File Management - https://github.com/KnpLabs/Gaufrette
Payment - https://github.com/adrianmacneil/omnipay
API Billing & Throttling - https://github.com/adrianmacneil/omnipay
Uploads - https://github.com/codeguy/Upload & Downloads - Download Controller
XSS - https://github.com/ezyang/htmlpurifier
Shell Manipulation - https://github.com/MrRio/shellwrap
Geolocation - https://github.com/mjaschen/phpgeo
Colour Manipulation - https://github.com/mikeemoo/ColorJizz-PHP
Data Generator - https://github.com/fzaninotto/Faker
HTTP Requests - https://github.com/rmccue/Requests OR Guzzle OR Artax (for non curl)
Utility - https://github.com/Anahkiasen/underscore-php OR http://brianhaveri.github.com/Underscore.php/
ORM - Propel or Doctrine! Proper transaction and nested transactions support are a must. Transactions begin from the Controller and Models. If you're using Propel or Doctrine, they bundle migrations directly. Using Propel use getConnection() to extract PDO connection: https://github.com/propelorm/Propel2/issues/509
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

Character Encoding Issue
------------------------

There is a big problem with UTF-8 and PHP:

http://www.phpwact.org/php/i18n/charsets
http://stackoverflow.com/questions/279170/utf-8-all-the-way-through
http://kunststube.net/encoding/

Need to solve this for portability.

Use composer install --no-dev during production!