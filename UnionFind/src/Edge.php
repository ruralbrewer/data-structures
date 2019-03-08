<?php
declare(strict_types=1);

namespace UnionFind;

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
    public function source()
    {
        return $this->source;
    }

    /**
     * @return int
     */
    public function destination()
    {
        return $this->destination;
    }

    public function length()
    {
        return abs($this->source->x() - $this->destination->x()) +
                abs($this->source->y() - $this->destination->y());
    }
}