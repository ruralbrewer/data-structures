<?php
declare(strict_types=1);

namespace Minimax\State\Event;

class StateChangeEventCollection
{
    /**
     * @var array
     */
    private $events = [];

    public function addEvent(StateChangeEvent $event)
    {
        $this->events[] = $event;
    }

    public function clear()
    {
        $this->events = [];
    }

    public function iterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->events);
    }


}