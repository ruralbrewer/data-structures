<?php
declare(strict_types=1);

namespace Graph;

class Edge
{
    /**
     * @var int
     */
    private $source;

    /**
     * @var int
     */
    private $destination;

    public function __construct(Vertex $source, Vertex $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
    }

    /**
     * @return int
     */
    public function source(): Vertex
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function destination(): Vertex
    {
        return $this->destination;
    }

    public function length()
    {
        return abs($this->source->x() - $this->destination->x()) +
                abs($this->source->y() - $this->destination->y());
    }

    public function asString()
    {
        return sprintf("[%d, %d] -> [%d, %d]",
            $this->source()->x(),
            $this->source()->y(),
            $this->destination()->x(),
            $this->destination()->y()
        );
    }
}