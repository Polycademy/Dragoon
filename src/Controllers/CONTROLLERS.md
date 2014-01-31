CONTROLLERS
===========

These represent the hierarchies of the API url. All class functions are mapped to HTTP methods.

All Query Parameters and Payload and Headers are passed via the Request Object
GET ($id = false)
POST
PUT ($id = false)
PATCH ($id = false)
DELETE ($id = false)
OPTIONS

get / (all or specific)
get /1 (specific)
get /res/2/res/1 (subresource)
post / (create all or specific)
put / (all or specific)
put /1 (specific)
patch / (all or specific)
patch /1 (specific)
delete / (all or specific)
delete /1 (specific)
options / (all available http methods at this url point)

If a resource is located inside a folder. That folder itself can also be a resource if there is a file named in the same way. Example:

http://dragoon.com/groups/meta/1 -> \Dragoon\Controllers\Groups\Meta.php
http://dragoon.com/groups -> \Dragoon\Controllers\Groups.php