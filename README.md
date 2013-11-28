Dragoon
=======

Dragoon is an experimental framework.

Index.php is the FC.
Router.php is a master middleware which calls in the other middleware.
Bootstrap.php is the IOC that bootstraps all modules, libraries and most importantly controllers.

Router
	-> /
		-> Stack(A, B, C, D)->IOC->Stack(X, Y, Z)

