#!/usr/bin/env php

<?php

use Tree\BinaryTree;
use Tree\IntegerNode;
use Tree\Node;

require './vendor/autoload.php';

$list = [
    16, 8, 24, 4, 12, 20 , 28, 2, 6, 10, 14, 18, 22, 16, 30, 1,3,5,7,9,11,13,15,17,19,21,23,25,27,29
];

$tree = new BinaryTree();

foreach ($list as $value) {
    $node = new IntegerNode($value);
    $tree->insert($node);
}

class TreeTraverser
{
    public const TRAVERSE_PRE_ORDER = 1;
    public const TRAVERSE_IN_ORDER = 2;
    public const TRAVERSE_POST_ORDER = 3;

    public static function depthFirstTraverse(Node $node, $order = self::TRAVERSE_PRE_ORDER)
    {
        if ($order === self::TRAVERSE_PRE_ORDER) {
            self::visit($node);
        }

        if ($node->hasLeft()) {
            self::depthFirstTraverse($node->left(), $order);
        }

        if ($order === self::TRAVERSE_IN_ORDER) {
            self::visit($node);
        }

        if ($node->hasRight()) {
            self::depthFirstTraverse($node->right(), $order);
        }

        if ($order === self::TRAVERSE_POST_ORDER) {
            self::visit($node);
        }
    }

    private static function visit(Node $node)
    {
        // Here we are simply printing,
        // but visitation could mean many things.
        echo $node->data() . ",";
    }
}

TreeTraverser::depthFirstTraverse($tree->root(), TreeTraverser::TRAVERSE_IN_ORDER);

$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "\n\nThis process took $executionTime seconds\n";