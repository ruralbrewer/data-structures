#!/usr/bin/env php

<?php

use Tree\BinaryTree;
use Tree\IntegerNode;
use Tree\TreeException;

require './vendor/autoload.php';

$list = [
    68,22,26,97,30,14,9,95,79,52
];

//for ($i = 0; $i < 10; $i++) {
//    $list[] = rand(0, 100);
//}

$tree = new BinaryTree();

foreach ($list as $value) {
    $node = new IntegerNode($value);
    $tree->insert($node);
}

try {
    $found = $tree->find(new IntegerNode(14));
    echo "Found: " . $found->data() . " at level: " . $found->level() . "\n";

    $notFound = $tree->find(new IntegerNode(99));
}
catch(TreeException $exception) {
    echo $exception->getMessage();
}

var_dump($tree->asArray());

$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "\n\nThis process took $executionTime seconds\n";