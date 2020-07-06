<?php
declare(strict_types=1);

namespace Minimax\TicTacToe;

use Minimax\NodeCollection;
use Minimax\State;
use Minimax\StateEvaluator;

class TicTacToeStateEvaluator implements StateEvaluator
{
    /**
     * @var NodeCollection
     */
    private $nodes;

    /**
     * @var bool
     */
    private $isMaximizing;


    public function __construct(NodeCollection $nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * Method to assign a (min/max) weight to the current state.
     */
    public function evaluate(State $state): int
    {
        return $state->score();
    }

    public function getPossibleMoves(State $state): NodeCollection
    {
        $this->nodes->clear();

        $value = ($this->isMaximizing) ? 'X' : 'O';

        foreach($state->nodes()->iterator() as $node) {

            if ($node->isEmpty()) {
                $move = clone $node;
                $move->setValue($value);
                $this->nodes->addNode($move);
            }

        }

        return $this->nodes;
    }

    public function setIsMaximizing(bool $isMaximizing): void
    {
        $this->isMaximizing = $isMaximizing;
    }
}