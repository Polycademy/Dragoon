ASPECTS
=======

Aspects refer to AOP's Aspects.

Aspects contain cross-cutting concerns such as:

1. Logging
2. Security (capability authorisation)
3. Transactions
4. Notifications
5. Error Handling
6. Caching (maybe like caching after something has been done)
7. Localisation
8. Event driven stuff

This directory should contain global aspects. But aspects related to a particular module can be created in the module specific directory. Although if that module is related to the aspect, then you probably should not be using an aspect for that...