Dragoon
=======

Dragoon is an experimental framework.

Index.php is the FC.
Router.php is a master middleware which calls in the other middleware.
Bootstrap.php is the IOC that bootstraps all modules, libraries and most importantly controllers.

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

Dragoon should use the PSR4 Autoloading standard. Because there's really no need for a Dragoon folder inside the src folder. However PSR4 hasn't arrived to Composer yet, but when it does, we'll need to register Dragoon. And move everything to the src folder.
PSR4 will be safe, as all of the code in projects will come from Dragoon, but PSR-0 wildcard namespace will allow people to specify Modules.. etc without Dragoon namespace.