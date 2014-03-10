CSS
===

- Global Mixins
- Global Modules
App.less - Global CSS


Store your CSS or less or sass files here.

CSS should be based off the OOCSS philosophy. Reusable within the project and reusable between the projects.

css
    -> controllers
        1. Exposes public class API to the HTML
        2. Objects are named based on their semantic use
        3. All directives are public and are not namespaced
        4. All files are StudlyCaps
        5. Controllers being imported must be interpolated. CSS files need to be "com-ported" via (less) keyword.
        6. Not intended to be reusable. Unique or specific to the project.
        7. Follow idiomatic CSS rules
        8. Follow BLOCK ELEMENT MODIFIER rules similar to OOCSS. Flat is sometimes better than nested.
        9. Choose your hierarchy.
        10. Global variables are defined here
    -> mixins
        1. Always namespaced
        2. When imported always (reference)
        3. Mixin functions end with parantheses ()
        4. Can be used as property list function, structural function (allows child selector to be a variable), or calculation function (returns variables into scope)
        5. Do not put media queries into here, it will not work. Instead establish different states for the properties that may change responsively. Media queries do not work well with namespaced (referencing)
        6. There must be no public classes exposed here.
        7. Objects are named based on their namespace
    -> modules
        1. Combination of controllers and mixins, similar to COMMONJS modules. These contain a #Namespaced mixin portion acting as the private functions for the object, and also contains an exposed public API.
        2. Recommend to split the module into controller/mixin.
        3. When importing modules it needs to be interpolated, not referenced.
        4. You can use these are packaged CSS components that can be reusable across projects. However they are not as easily changed, as you get the full package, with the exposed CSS.
        5. Named according to semantics and namespace should relate to semantic use (perhaps suffix or prefix).
    Main.less
        1. Composition point
        2. Compile and compress

Namespace naming scheme:

#NamespaceName {
    
}

Class naming scheme:

(explicit hierarchy, its more rigid but clearer and specific)
.class {
    .mixin();
    .class-subclass {
        .mixin();
    }
}

(implicit hierarchy, allows a bit more flexibility, less specific)

.class{
    
}
.class-subclass{
    
}

The "-" indicates a form of hierarchy.

So this means both are possible:

<e class="class">
    <e class="class-subclass"></e>
</e>

OR

<e class="class">
</e>
<e class="sub-class">
</e>

Associative

.class {
    
}

.classSubclass {
    
}

<e class="class classSubclass"></e>
<e class="classSubclass"></e>

.class {
    .classSubclass{

    }
}

.classSubclass{
    
}

This means classSubclass can be utilised outside of class, as an associative class or as a child.

.class {
    
}
.class.classSubclass{
    
}

//This is purely associative. AND selector

.class {
    //this is intended to be utilised among controllers, and among modules or module to controllers
    //it is not intended to extend mixins
    &:extend(.other-class)
}

MIXINS:

#Namespace.mixinFunction(); (camelcased)

PUBLIC API:

.class-subclass; (hierarchal) (dashcasing)
.class_associative_sub_class; (associative - underscore)
EXAMPLE:
.btn {};
.btn_default {};