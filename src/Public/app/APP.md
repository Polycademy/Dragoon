APP
===

In order to achieve this in browserify:

We need:

debowerify
deglobalify
brfs + insert-css OR node-lessify (compile less and insert css) + stringify (text files)


In order to achieve this WebPack

We need a loader that can load from Bower. Not just NPM. Also componentify sounds good too.



JS folder for the single page application.

When using AngularJS you should implement directive templates.

These are directives that are paired up with a template. Each should be quite generic and reusable.
Perhaps they are folders like this:

Elements refer to Directive Templates. These are directives that are bound to a specific template.

Refer to https://github.com/mgechev/angularjs-style-guide


Public
->app
    -> states (first state is always the layout state)
        -> root
            HeaderCtrl.coffee
            FooterCtrl.coffee
            RootCtrl.coffee
            Root.coffee - Imports Root controllers, Root templates, Root less files, and all child states. Exports Root state.
            Root.jade - Headers and Footers
            Root.less (LESS module)
                -> home
                    HomeCtrl.coffee
                    Home.coffee
                    Home.jade
                    Home.less - (LESS module)
                -> header
                -> footer
        -> admin
        -> dashboard
        -> squeeze
        -> management
        -> administration
        -> landing
        -> control_panel
    -> directives
    -> elements (widgets) (atoms)
    -> filters
    -> services
    -> libraries
    -> mixins
        Centering.less - Common Mixins
    App.less - Common CSS code (common across al states)
    Common.coffee - Exports all major external dependencies.
    App.coffee - Imports App less files and all child states. Establishes Routing and External Dependencies. Exports the application!
    Config.coffee - Angular Config
    Run.coffee - Angular Front Controller
    Settings.coffee - Generic Settings
    App.html Entry point - Server side code loads this file, which loads App.js

App.html should just be

<html>
    <head>
        App.js
    </head>
    <body>
        <ui-view />
    </body>
</html>

Root.jade should just be

    <header></header>
        <ui-view />
    <footer></footer>