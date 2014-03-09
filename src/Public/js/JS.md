JS
==

JS folder for the single page application.

When using AngularJS you should implement directive templates.

These are directives that are paired up with a template. Each should be quite generic and reusable.
Perhaps they are folders like this:

Elements refer to Directive Templates. These are directives that are bound to a specific template.

Refer to https://github.com/mgechev/angularjs-style-guide

js/
	app/
		controllers
		directives
		elements/
			SearchForm.Element.js
			SearchForm.html
		filters
		services
	lib/
		manually installed external libraries

AngularJS Inheritance:

http://badwing.com/angularjs-service-inheritance/
https://github.com/mgechev/angular-aop
http://blog.mgechev.com/2013/12/18/inheritance-services-controllers-in-angularjs/
http://digital-drive.com/?p=188
https://github.com/exratione/angularjs-controller-inheritance
https://www.exratione.com/2013/10/two-approaches-to-angularjs-controller-inheritance/