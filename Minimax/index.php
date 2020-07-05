<?php
declare(strict_types=1);

namespace Minimax;

    use Minimax\TicTacToe\TicTacToeState;

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

$nodes = NodeCollection::fromArray($nodeValues);

$state = new TicTacToeState($nodes);

$ai = new Minimax();

while (!$state->isTermination()) {

    $isMaximizing = !$isMaximizing;

    echo "Player: " . (($isMaximizing) ? 0 : 1) . ": " . (($isMaximizing) ? 'Max' : 'Min') . "\n";

    $evaluation = $ai->evaluate($state, 0, $isMaximizing);

    if ($evaluation['move']) {
        ($evaluation['move'])->setValue($state->currentNodeValue($isMaximizing));
    }

    $state->dumpState();

    echo "\n";
}

echo "Total: " . $ai->count() . "\n";






