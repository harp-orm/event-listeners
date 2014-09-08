<?php

namespace Harp\EventListeners\Test;

use Harp\EventListeners\EventListeners;
use stdClass;

/**
 * @coversDefaultClass Harp\EventListeners\EventListeners
 *
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class EventListenersTest extends AbstractTestCase
{
    /**
     * @covers ::dispatchEvent
     */
    public function testDispatchEvent()
    {
        $object = new stdClass();

        $listeners = [
            'save' => [
                function ($object) {
                    $object->callbackSave = true;
                }
            ]
        ];

        EventListeners::dispatchEvent($listeners, $object, 'save');

        $this->assertTrue($object->callbackSave);
    }

    /**
     * @covers ::getBefore
     * @covers ::addBefore
     * @covers ::hasBeforeEvent
     * @covers ::dispatchBeforeEvent
     */
    public function testBefore()
    {
        $object = new stdClass();
        $listeners = new EventListeners();

        $this->assertEmpty($listeners->getBefore());
        $this->assertFalse($listeners->hasBeforeEvent('insert'));

        $listeners->addBefore('insert', function ($object) {
            $object->callbackCalled = true;
        });

        $this->assertTrue($listeners->hasBeforeEvent('insert'));

        $listeners->dispatchBeforeEvent($object, 'insert');

        $this->assertTrue($object->callbackCalled);
    }

    /**
     * @covers ::getAfter
     * @covers ::addAfter
     * @covers ::hasAfterEvent
     * @covers ::dispatchAfterEvent
     */
    public function testAfter()
    {
        $object = new stdClass();
        $listeners = new EventListeners();

        $this->assertEmpty($listeners->getAfter());
        $this->assertFalse($listeners->hasAfterEvent('insert'));

        $listeners->addAfter('insert', function ($object) {
            $object->callbackCalled = true;
        });

        $this->assertTrue($listeners->hasAfterEvent('insert'));

        $listeners->dispatchAfterEvent($object, 'insert');

        $this->assertTrue($object->callbackCalled);
    }
}
