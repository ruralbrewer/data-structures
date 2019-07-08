<?php
declare(strict_types=1);

namespace Graph;

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

    /**
     * @throws GraphException
     */
    public function atIndex(int $index): Vertex
    {
        if (!isset($this->elements[$index])) {
            throw new GraphException(
                sprintf("No Vertex found at index %d", $index)
            );
        }

        return $this->elements[$index];
    }

    public function iterator()
    {
        return new \ArrayIterator($this->elements);
    }
}