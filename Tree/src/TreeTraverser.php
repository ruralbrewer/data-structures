<?php
declare(strict_types=1);

namespace Tree;

class TreeTraverser
{
    public const TRAVERSE_PRE_ORDER = 1;
    public const TRAVERSE_IN_ORDER = 2;
    public const TRAVERSE_POST_ORDER = 3;

    public static function depthFirstTraverse(Node $node, DepthFirstTraverseOrder $order)
    {
        if ($order->asInt() === self::TRAVERSE_PRE_ORDER) {
            treeTraverser::visit($node);
        }

        if ($node->hasLeft()) {
            treeTraverser::depthFirstTraverse($node->left(), $order);
        }

        if ($order->asInt() === self::TRAVERSE_IN_ORDER) {
            treeTraverser::visit($node);
        }

        if ($node->hasRight()) {
            treeTraverser::depthFirstTraverse($node->right(), $order);
        }

        if ($order->asInt() === self::TRAVERSE_POST_ORDER) {
            treeTraverser::visit($node);
        }
    }

    public static function breadthFirstTraverse(Node $node)
    {
        $currentLevel = 1;
        $queue = [$node];

        while (!empty($queue)) {
            /** @var Node $currentNode */
            $currentNode = array_shift($queue);

            if ($currentNode->level() != $currentLevel) {
                $currentLevel++;
                treeTraverser::nextLevel($currentNode);
            }

            treeTraverser::visit($currentNode);

            if ($currentNode->hasLeft()) {
                array_push($queue, $currentNode->left());
            }

            if ($currentNode->hasRight()) {
                array_push($queue, $currentNode->right());
            }
        }
    }

    private static function visit(Node $node)
    {
        // Here we are simply printing,
        // but visitation could mean many things.
        echo $node->data() . ",";
    }

    private static function nextLevel(Node $currentNode)
    {
        // And again. Silly, I know.
        echo "\n";
    }
}