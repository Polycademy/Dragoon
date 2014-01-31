MIDDLEWARE
==========

Middleware are like onion layers. A request and response goes through them all.

( Outer Layer Entry ( Middle Layer Entry ( Inner Layer Entry & Exit ) Middle Layer Exit ) Outer Layer Exit )

Each layer accepts another layer as a dependency.

The inner layer is the controller and this does not accept a middleware dependency. Every layer above it accepts a middleware dependency.

Every layer has the opportunity to preprocess the request, and post process the response.

The Kernel needs to build up an onion stack of this middleware for each controller. This means the Router associated a particular controller instance with a particular route. It passes the controller's instance into Kernel. The Kernel wraps the onion around the controller. The Router than executes it by calling `handle` and passing in the Request object.