<?php
declare(strict_types=1);

namespace Minimax\TicTacToe;

use Minimax\NodeCollection;
use Minimax\State;
use Minimax\StateChangeEvent;
use Minimax\StateChangeEventCollection;
use Minimax\StateEvaluator;

class TicTacToeStateEvaluator implements StateEvaluator
{
    /**
     * @var StateChangeEventCollection
     */
    private $events;

    /**
     * @var bool
     */
    private $isMaximizing;


    public function __construct(StateChangeEventCollection $nodes)
    {
        $this->events = $nodes;
    }

    public function setIsMaximizing(bool $isMaximizing): void
    {
        $this->isMaximizing = $isMaximizing;
    }

    /**
     * Method to assign a (min/max) weight to the current state.
     */
    public function evaluate(State $state): int
    {
        return $state->score();
    }

    public function getPossibleEvents(State $state): StateChangeEventCollection
    {
        $this->events->clear();

        $value = ($this->isMaximizing) ? 'X' : 'O';

        foreach($state->nodes()->iterator() as $node) {

            if ($node->isEmpty()) {
                $move = new TicTacToeMove($node, $value);
                $this->events->addEvent($move);
            }

        }

        return $this->events;
    }
}