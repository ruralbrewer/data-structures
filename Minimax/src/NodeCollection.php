<?php
declare(strict_types=1);

namespace Minimax;

class NodeCollection
{
    /**
     * @var array
     */
    private $nodes = [];


    public static function fromArray(array $nodeValues)
    {
        $collection = new self;

        foreach ($nodeValues as $key => $value) {
            $collection->addNode(new Node($key, $value));
        }

        return $collection;
    }

    public function addNode(Node $node)
    {
        $this->nodes[$node->name()] = $node;
    }

    public function hasNodeAtKey($key)
    {
        return isset($this->nodes[$key]);
    }

    public function nodeAtKey($key): Node
    {
        if (!$this->hasNodeAtKey($key)) {
            throw new \OutOfBoundsException('Key does not exist');
        }

        return $this->nodes[$key];
    }

    public function clear()
    {
        $this->nodes = [];
    }

    public function iterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->nodes);
    }


}