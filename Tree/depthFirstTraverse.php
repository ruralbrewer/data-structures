#!/usr/bin/env php

<?php

use Tree\BinaryTree;
use Tree\DepthFirstTraverseOrder;
use Tree\IntegerNode;
use Tree\TreeTraverser;

require './vendor/autoload.php';

$list = [
    16, 8, 24, 4, 12, 20 , 28, 2, 6, 10, 14, 18, 22, 16, 30, 1,3,5,7,9,11,13,15,17,19,21,23,25,27,29
];

$tree = new BinaryTree();

foreach ($list as $value) {
    $node = new IntegerNode($value);
    $tree->insert($node);
}

TreeTraverser::depthFirstTraverse($tree->root(), DepthFirstTraverseOrder::inOrder());

$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "\n\nThis process took $executionTime seconds\n";