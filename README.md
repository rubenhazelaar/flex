# Flex

Flex is an ultra simple PHP framework, based on PSR-7 and Zend Diactoros. Routing is done by fast-route, although you
are free to change it up.

It also features a basic middleware implementation and template system. And more to come in the future.

## Todo

- Implement FirewallMiddleware
- Implement context (IoC container passed to middleware and controllers)
- Document Middleware & Loader classes
- Test Middleware & Loader & Template classes

## Docker

Getting started with Flex (using Docker) is easy as 1, 2, 3. Just run:

```bash
    docker-compose up #Add '--build' when running for the first time
```