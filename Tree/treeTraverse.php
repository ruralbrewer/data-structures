#!/usr/bin/env php

<?php

use Tree\BinaryTree;
use Tree\IntegerNode;
use Tree\TreeTraverser;

require './vendor/autoload.php';

function getTree(): BinaryTree
{
    $list = [
        16, 8, 24, 4, 12, 20 , 28, 2, 6, 10, 14, 18, 22, 26, 30, 1,3,5,7,9,11,13,15,17,19,21,23,25,27,29, 31
    ];

    $tree = new BinaryTree();

    foreach ($list as $value) {
        $node = new IntegerNode($value);
        $tree->insert($node);
    }

    return $tree;
}

echo "\n\nRecursive Pre Order Depth First Traversal\n";
TreeTraverser::depthFirstPreOrderRecursiveTraverse(getTree()->root());

echo "\n\nIterative Pre Order Depth First Traversal\n";
TreeTraverser::depthFirstPreOrderIterativeTraverse(getTree()->root());

echo "\n\nRecursive In Order Depth First Traversal\n";
TreeTraverser::depthFirstInOrderRecursiveTraverse(getTree()->root());

echo "\n\nIterative In Order Depth First Traversal\n";
TreeTraverser::depthFirstInOrderIterativeTraverse(getTree()->root());

echo "\n\nRecursive Post Order Depth First Traversal\n";
TreeTraverser::depthFirstPostOrderRecursiveTraverse(getTree()->root());

echo "\n\nIterative Post Order Depth First Traversal\n";
TreeTraverser::depthFirstPostOrderIterativeTraverse(getTree()->root());

echo "\n\nBreadth First Traversal\n";
TreeTraverser::breadthFirstTraverse(getTree()->root());

$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "\n\nThis process took $executionTime seconds\n";