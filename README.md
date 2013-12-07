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