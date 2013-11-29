<?php

//the bootstrap will load the pimple IOC
//Which will bring in all the configuration, and all of the controllers, modules, libraries
//Bootstrap can also bring in any secrets..?
//Since the configuration will be stored inside Pimple's IOC array, this can then be inserted into any controllers that require it

//also pass any the monolog instances here, to classes that will use logging