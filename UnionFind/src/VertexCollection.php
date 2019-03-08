<?php
declare(strict_types=1);

namespace UnionFind;

class VertexCollection
{
    /**
     * @var array
     */
    private $elements = [];

    public static function fromArray(array $vertices)
    {
        $collection = new VertexCollection();

        foreach ($vertices as $vertex) {
            $collection->add($vertex);
        }

        return $collection;
    }

    public function add(Vertex $vertex)
    {
        $this->elements[] = $vertex;
    }

    public function iterator()
    {
        return new \ArrayIterator($this->elements);
    }
}