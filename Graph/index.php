#!/usr/bin/env php

<?php

use Graph\Graph;
use Graph\GraphException;
use Graph\GraphTraverser;
use Graph\Grid;
use Graph\Vertex;
use Graph\VisitationTasks\FindWinnerVisitationTask;
use Graph\VisitationTasks\PrintVisitationTask;

require './vendor/autoload.php';

function getGraph(): Graph
{
    $points = [
        [1,1],
        [2,6],
        [3,5],
        [4,2],
        [5,1],
        [2,3]
    ];

    $graph = new Graph();

    $vertices = [];

    foreach ($points as $index => $coordinates) {
        $vertices[] = new Vertex($index, $coordinates[0], $coordinates[1], "[{$coordinates[0]}, {$coordinates[1]}]");
    }

    $edgeMap = [
        [3, 5],
        [],
        [1],
        [2,4],
        []
    ];

    /** @var Vertex $vertex */
    foreach($vertices as $key => $vertex) {

        foreach ($edgeMap[$key] as $adjacent) {
            $vertex->addAdjacent($vertices[$adjacent]);
        }

        $graph->addVertex($vertex);
    }

    return $graph;
}

try
{
    $x1 = 0; $y1 = 0;
    $x2 = 5; $y2 = 5;

    $grid = Grid::fromGridPoints($x1, $y1, $x2, $y2);
    $root = $grid->getAtPoint(3, 3);

    $x = rand($x1, $x2);
    $y =  rand($y1, $y2);

    $prizeVertex = $grid->getAtPoint($x, $y);
    $prizeVertex->setData("Winner winner, chicken dinner!");

    echo "Setting the winner at [$x, $y]\n";

    GraphTraverser::setTask(new PrintVisitationTask())::breadthFirstTraverse($root);
//    GraphTraverser::setTask(new FindWinnerVisitationTask())::breadthFirstTraverse($root);
}
catch(GraphException $exception) {
    echo $exception->getMessage();
}

$executionTime = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
echo "\n\nThis process took $executionTime seconds\n";