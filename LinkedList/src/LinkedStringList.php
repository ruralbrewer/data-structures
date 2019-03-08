<?php
declare(strict_types=1);

namespace LinkedList;

class LinkedStringList extends AbstractLinkedList
{

    public function addStringNode(StringNode $value)
    {
        parent::addNode($value);
    }

    public function find($value): Node
    {
        return $this->findString($value);
    }

    /**
     * @throws LinkedListException
     */
    private function findString(string $value)
    {
        if (is_null($this->root)) {
            throw new LinkedListException("No nodes found in list.");
        }

        return $this->root->find($value);
    }
}