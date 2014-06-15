PUBLIC
======

Public files should be accessible through the webserver to be downloaded. It is also possible point all downloads through a downloads controller.

Any files here that starts with a dot is a hidden file. These hidden files MUST NOT be accessible publicly even though they are ironically in the Public folder. Use your web server directives to prevent access to these files. Now why are these files here? Well in certain server configurations, such as Apache or the usage of per directory php.ini files, this is where they expect them, in the DOCUMENT_ROOT.