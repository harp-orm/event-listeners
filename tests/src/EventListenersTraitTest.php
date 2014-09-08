<?php

namespace Harp\EventListeners\Test;

/**
 * @coversDefaultClass Harp\EventListeners\EventListenersTrait
 */
class EventListenersTraitTest extends AbstractTestCase
{
    /**
     * @covers ::getEventListeners
     * @covers ::addEventBefore
     * @covers ::addEventAfter
     */
    public function testConstruct()
    {
        $config = new TestConfig();

        $event1 = function($object) {
            return true;
        };

        $event2 = function($object) {
            return true;
        };

        $listeners = $config->getEventListeners();

        $this->assertInstanceOf('Harp\EventListeners\EventListeners', $listeners);
        $this->assertCount(0, $listeners->getBefore());
        $this->assertCount(0, $listeners->getAfter());

        $config->addEventBefore('insert', $event1);
        $config->addEventAfter('delete', $event2);

        $this->assertSame(
            ['insert' => [$event1]],
            $config->getEventListeners()->getBefore()
        );

        $this->assertSame(
            ['delete' => [$event2]],
            $config->getEventListeners()->getAfter()
        );
    }
}
