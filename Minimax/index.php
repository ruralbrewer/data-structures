<?php
declare(strict_types=1);

namespace Minimax;

    use Minimax\TicTacToe\TicTacToeState;
    use Minimax\TicTacToe\TicTacToeStateEvaluator;

    require './vendor/autoload.php';

$nodeValues = [
    '', '', '',
    '', 'X', '',
    '', '', ''
];

$emptyValues = 0;

foreach ($nodeValues as $value) {
    if (empty($value)) {
        $emptyValues++;
    }
}

$isMaximizing = ($emptyValues % 2 === 0);

$start = microtime(true);

$nodes = NodeCollection::fromArray($nodeValues);

$state = new TicTacToeState($nodes);

$stateEvaluator = new TicTacToeStateEvaluator(new NodeCollection());

$ai = new Minimax($stateEvaluator);

while (!$state->isTermination()) {

    $isMaximizing = !$isMaximizing;

    echo "Player: " . (($isMaximizing) ? 0 : 1) . ": " . (($isMaximizing) ? 'Max' : 'Min') . "\n";

    $evaluation = $ai->evaluate($state, 0, $isMaximizing);

    if ($evaluation['move']) {
        $state->updateState($evaluation['move']);
    }

    $state->dumpState();

    echo "\n";
}

echo "Winner: " . $state->winner() . "\n";
echo "Total: " . $ai->count() . "\n";
echo "Total Time : " . (microtime(true) - $start) . "\n";






