COMMANDS
========

You will store the application specific cli tools here. This is separated from the bin folder since you could get overwritten!

You can even just put general bash scripts here.

//This Dragoon script will create a new Dragoon framework will create a new project using a custom namespace.
//It also needs to modify the composer.json for the autoload parameter and change Dragoon to the relevant namespace
//it then needs to call Composer and hit dump-autoload --optimize