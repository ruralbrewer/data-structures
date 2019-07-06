<?php
declare(strict_types=1);

namespace Tree;

class TreeTraverser
{
    /*
     * BREADTH FIRST TRAVERSAL
     */

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

    /*
     * BREADTH FIRST RECURSIVE TRAVERSAL
     */

    public static function depthFirstPreOrderRecursiveTraverse(Node $node)
    {
        treeTraverser::visit($node);

        if ($node->hasLeft()) {
            treeTraverser::depthFirstPreOrderRecursiveTraverse($node->left());
        }

        if ($node->hasRight()) {
            treeTraverser::depthFirstPreOrderRecursiveTraverse($node->right());
        }
    }

    public static function depthFirstInOrderRecursiveTraverse(Node $node)
    {
        if ($node->hasLeft()) {
            treeTraverser::depthFirstInOrderRecursiveTraverse($node->left());
        }

        treeTraverser::visit($node);

        if ($node->hasRight()) {
            treeTraverser::depthFirstInOrderRecursiveTraverse($node->right());
        }
    }

    public static function depthFirstPostOrderRecursiveTraverse(Node $node)
    {
        if ($node->hasLeft()) {
            treeTraverser::depthFirstPostOrderRecursiveTraverse($node->left());
        }

        if ($node->hasRight()) {
            treeTraverser::depthFirstPostOrderRecursiveTraverse($node->right());
        }

        treeTraverser::visit($node);
    }

    /*
     * BREADTH FIRST ITERATIVE TRAVERSAL
     */

    public static function depthFirstPreOrderIterativeTraverse(Node $node)
    {
        $stack = [$node];

        while(!empty($stack)) {

            /** @var Node $currentNode */
            $currentNode = end($stack);

            self::visit($currentNode);
            array_pop($stack);

            if ($currentNode->hasRight()) {
                array_push($stack, $currentNode->right());
            }

            if ($currentNode->hasLeft()) {
                array_push($stack, $currentNode->left());
            }

        }
    }

    public static function depthFirstInOrderIterativeTraverse(Node $node)
    {
        $stack = [$node];

        while(!empty($stack)) {

            /** @var Node $currentNode */
            $currentNode = end($stack);

            if ($currentNode->hasLeft() && !$currentNode->left()->visited()) {
                array_push($stack, $currentNode->left());
                continue;
            }
            else {
                self::visit($currentNode);
                array_pop($stack);
            }

            if ($currentNode->hasRight() && !$currentNode->right()->visited()) {
                array_push($stack, $currentNode->right());
                continue;
            }
        }
    }

    public static function depthFirstPostOrderIterativeTraverse(Node $node)
    {
        $stack = [$node];

        while(!empty($stack)) {

            /** @var Node $currentNode */
            $currentNode = end($stack);

            if ($currentNode->hasLeft() && !$currentNode->left()->visited()) {
                array_push($stack, $currentNode->left());
                continue;
            }

            if ($currentNode->hasRight() && !$currentNode->right()->visited()) {
                array_push($stack, $currentNode->right());
                continue;
            }
            else {
                self::visit($currentNode);
                array_pop($stack);
            }

        }
    }

    /*
     * HELPER FUNCTIONS
     */

    private static function visit(Node $node)
    {
        // Here we are simply printing,
        // but visitation could mean many things.
        echo $node->data() . ",";
        $node->setVisited();
    }

    private static function nextLevel(Node $currentNode)
    {
        // And again. Silly, I know.
        echo "\n";
    }
}