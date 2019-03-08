<?php
declare(strict_types=1);

namespace LinkedList;

require './vendor/autoload.php';

$stringList = new LinkedStringList();

$strings = [
    'This',
    'is',
    'a',
    'test',
    'of',
    'the',
    'Linked',
    'String',
    'List'
];

foreach($strings as $string) {
    $stringList->addStringNode(new StringNode(new StringId(), $string));
}

var_dump($stringList->asArray());
echo "<br>";

$stringToFind = 'is';

try {
    $foundNode = $stringList->find($stringToFind);
    echo "The id of the found node is : " . $foundNode->id()->asString();
}
catch(\Exception $exception) {
    echo $exception->getMessage();
}