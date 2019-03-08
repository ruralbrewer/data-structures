<?php
declare(strict_types=1);

namespace Tree;

class IntegerNode implements Node
{
    public $data;

    /**
     * @var Node
     */
    public $leftChild = null;

    /**
     * @var Node
     */
    public $rightChild = null;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function data()
    {
        return $this->data;
    }

    public function hasLeft(): bool
    {
        return !is_null($this->leftChild);
    }

    public function setLeft(Node $node): IntegerNode
    {
        $this->leftChild = $node;
        return $this;
    }

    public function left(): Node
    {
        return $this->leftChild;
    }

    public function hasRight(): bool
    {
        return !is_null($this->rightChild);
    }

    public function setRight(Node $node): IntegerNode
    {
        $this->rightChild = $node;
        return $this;
    }

    public function right(): Node
    {
        return $this->rightChild;
    }

    public function greaterThan(Node $other): bool
    {
        return ($this->data() > $other->data());
    }

    public function lessThan(Node $other): bool
    {
        return ($this->data() < $other->data());
    }

    public function equals(Node $other): bool
    {
        return ($this->data() === $other->data());
    }

    public function asArray(): array
    {
        $treeArray = [$this->data];
        $left = ($this->hasLeft()) ? $this->left()->asArray() : [];
        $right = ($this->hasRight()) ? $this->right()->asArray() : [];
        $treeArray = array_merge($treeArray, $left, $right);

        return $treeArray;
    }
}