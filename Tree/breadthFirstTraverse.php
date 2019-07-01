#!/usr/bin/env php

<?php

use Tree\BinaryTree;
use Tree\IntegerNode;
use Tree\Node;

require './vendor/autoload.php';

//$list = [
//    16, 8, 24, 4, 12, 20 , 28, 2, 6, 10, 14, 18, 22, 16, 30, 1,3,5,7,9,11,13,15,17,19,21,23,25,27,29
//];

for ($i = 0; $i < 10; $i++) {
    $list[] = rand(0, 100);
}

$tree = new BinaryTree();

foreach ($list as $value) {
    $node = new IntegerNode($value);
    $tree->insert($node);
}

function breadthFirstPrint(Node $node)
{
    $currentLevel = 1;
    $queue = [$node];

    while (!empty($queue)) {
        /** @var Node $currentNode */
        $currentNode = array_shift($queue);
        if ($currentNode->level() != $currentLevel) {
            $currentLevel++;
            echo "\n";
        }
        echo $currentNode->data() . ",";

        if ($currentNode->hasLeft()) {
            array_push($queue, $currentNode->left());
        }

        if ($currentNode->hasRight()) {
            array_push($queue, $currentNode->right());
        }
    }
}

depthFirstPreOrderPrint($tree->root());

$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "\n\nThis process took $executionTime seconds\n";