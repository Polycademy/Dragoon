TEMPLATES
=========

Templates are stored here.

These will be publicly available and downloaded asynchronously from AngularJS or any other JS framework.

This means these are files.

One of these templates needs to be main template that will load up the main view. This template is not loaded by the front end javascript. But the initial load by PHP.

They can be straight PHP, or whatever. But you need to load the templates through a templates controller. The templates controller can bundle up all the templates, or it can send the templates one by one which can be downloaded asynchronously.

Or the templates can have no server side variables at all.

It's also possible to have the index.html to be loaded as a PHP template, and be inserted with any variables from the server, but all the other templates have no PHP at all.

All of these templates could actually be precompiled (inlined) into the javascript. Or they can asynchronously loaded. Both have advantages and disadvantages. index.php will always be used!