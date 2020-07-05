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

        foreach ($nodeValues as $value) {
            $collection->addNode(new Node($value));
        }

        return $collection;
    }

    public function addNode(Node $node)
    {
        $this->nodes[] = $node;
    }


    public function iterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->nodes);
    }


}