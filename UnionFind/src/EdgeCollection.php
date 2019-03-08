<?php
declare(strict_types=1);

namespace UnionFind;

class EdgeCollection
{
    /**
     * @var array
     */
    private $elements = [];

    public static function fromArray(array $edges)
    {
        $collection = new EdgeCollection();

        foreach ($edges as $edge) {
            $collection->add($edge);
        }

        return $collection;
    }

    public function add(Edge $edge)
    {
        $this->elements[] = $edge;
    }

    public function iterator()
    {
        return new \ArrayIterator($this->elements);
    }

    public function asArray()
    {
        return $this->elements;
    }
}