MIDDLEWARE
==========

Middleware is separated into advisors and decorators. The advisors advise upon the request. The decorators decorate the responses.

The router would also handle 404s or 500 errors or any invalid kind of request. It's perfectly possible here to actually establish mini function controllers, and act like a Slim or Silex application.