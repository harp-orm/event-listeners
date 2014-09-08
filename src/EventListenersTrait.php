<?php

namespace Harp\EventListeners;

use Closure;

/**
 * Add this trait to your object to allow adding various "before" and "after" events
 *
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
trait EventListenersTrait
{
    /**
     * @var EventListeners
     */
    private $eventListeners;

    /**
     * Get EventListeners
     *
     * @return EventListeners
     */
    public function getEventListeners()
    {
        if (! $this->eventListeners) {
            $this->eventListeners = new EventListeners();
        }

        return $this->eventListeners;
    }

    /**
     * @return self
     */
    public function addEventBefore($event, Closure $listener)
    {
        $this->getEventListeners()->addBefore($event, $listener);

        return $this;
    }

    /**
     * @return self
     */
    public function addEventAfter($event, Closure $listener)
    {
        $this->getEventListeners()->addAfter($event, $listener);

        return $this;
    }
}
