<?php
declare(strict_types=1);

namespace Tree;

require './vendor/autoload.php';

$list = [
    68,22,26,97,30,14,9,95,79,52
];

//for ($i = 0; $i < 10; $i++) {
//    $list[] = rand(0, 100);
//}


$heap = Heap::fromArrayNoMap($list, true);

echo "<pre>";
try {
//var_dump($list);
//var_dump($heap->asArray());
//$heap->removeAt(4);
//var_dump($heap->map());
//var_dump($heap->asArray());
var_dump($heap->asArray());
var_dump($heap->has(97));
var_dump($heap->has(87));
var_dump($heap->find(97));
var_dump($heap->find(87));
}
catch(TreeException $exception) {
    echo $exception->getMessage();
}



