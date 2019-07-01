<?php
declare(strict_types=1);

namespace Tree;

class DepthFirstTraverseOrder
{
    /**
     * @var int
     */
    private $traverseOrder;

    public static function preOrder()
    {
        return new self(TreeTraverser::TRAVERSE_PRE_ORDER);
    }

    public static function inOrder()
    {
        return new self(TreeTraverser::TRAVERSE_IN_ORDER);
    }

    public static function postOrder()
    {
        return new self(TreeTraverser::TRAVERSE_POST_ORDER);
    }

    private function __construct(int $traverseOrder)
    {
        $this->traverseOrder = $traverseOrder;
    }

    public function asInt(): int
    {
        return $this->traverseOrder;
    }
}