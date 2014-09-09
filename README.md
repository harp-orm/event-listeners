Event Listeners
===============

[![Build Status](https://travis-ci.org/harp-orm/event-listeners.png?branch=master)](https://travis-ci.org/harp-orm/event-listeners)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/harp-orm/event-listeners/badges/quality-score.png)](https://scrutinizer-ci.com/g/harp-orm/event-listeners/)
[![Code Coverage](https://scrutinizer-ci.com/g/harp-orm/event-listeners/badges/coverage.png)](https://scrutinizer-ci.com/g/harp-orm/event-listeners/)
[![Latest Stable Version](https://poser.pugx.org/harp-orm/event-listeners/v/stable.png)](https://packagist.org/packages/harp-orm/event-listeners)

Simple event listeners with Closures.

Usage
-----

```php
$listeners = new EventListeners();

$listeners->addBefore('save', function ($target) {
    // ...
});

$listeners->addAfter('delete', function ($target) {
    // ...
});

$listeners->dispatchEvent('save', $target);
$listeners->dispatchEvent('delete', $target);
```

A very simple manager object that holds all the appropriate events, and allows you to dispatch these events later.

EventListenersTrait
-------------------

This trait gives you the ability to easily add eventlisteners to another object.

```php
class TestConfig {
    use EventListenersTrait;
}

$config = new TestConfig();

$config
    ->addEventBefore('delete', function () {
        // ...
    })
    ->addEventAfter('validate', function () {

    });

// Return the EventListeners object
$config->getEventListeners();
```

Here are all the methods added by this trait.

Method                              | Description
------------------------------------|--------------------------------------------------
__getEventListeners__()             | Get the EventListeners object
__addEventBefore__($name, $closure) | Add a "before" listener
__addEventAfter__($name, $closure)  | Add a "after" listener

License
-------

Copyright (c) 2014, Clippings Ltd. Developed by Ivan Kerin

Under BSD-3-Clause license, read LICENSE file.
