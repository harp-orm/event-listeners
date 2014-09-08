<?php

namespace Harp\EventListeners;

use Closure;

/**
 * Events in the lifecycle of models. Before and After events are separate.
 *
 * @author     Ivan Kerin <ikerin@gmail.com>
 * @copyright  (c) 2014 Clippings Ltd.
 * @license    http://spdx.org/licenses/BSD-3-Clause
 */
class EventListeners
{
    /**
     * @param array  $listeners
     * @param object $target
     * @param string $event
     */
    public static function dispatchEvent($listeners, $target, $event)
    {
        if (isset($listeners[$event])) {
            foreach ($listeners[$event] as $listner) {
                $listner($target);
            }
        }
    }

    /**
     * @var Closure[]
     */
    private $before = [];

    /**
     * @var Closure[]
     */
    private $after = [];

    /**
     * @return Closure[]
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @return Closure[]
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param string  $event
     * @param Closure $listener
     * @return self
     */
    public function addBefore($event, Closure $listener)
    {
        $this->before[$event] []= $listener;

        return $this;
    }

    /**
     * @param string  $event
     * @param Closure $listener
     * @return self
     */
    public function addAfter($event, Closure $listener)
    {
        $this->after[$event] []= $listener;

        return $this;
    }

    /**
     * @param  string $event
     * @return boolean
     */
    public function hasBeforeEvent($event)
    {
        return isset($this->before[$event]);
    }

    /**
     * @param  string $event
     * @return boolean
     */
    public function hasAfterEvent($event)
    {
        return isset($this->after[$event]);
    }

    /**
     * @param object $target
     * @param string $event
     * @return self
     */
    public function dispatchAfterEvent($target, $event)
    {
        self::dispatchEvent($this->after, $target, $event);

        return $this;
    }

    /**
     * @param object $target
     * @param string $event
     * @return self
     */
    public function dispatchBeforeEvent($target, $event)
    {
        self::dispatchEvent($this->before, $target, $event);

        return $this;
    }
}
