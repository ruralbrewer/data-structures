<?php
declare(strict_types=1);

namespace Minimax\TicTacToe;

use Minimax\Node;
use Minimax\NodeCollection;
use Minimax\State;
use Minimax\StateChangeEvent;

class TicTacToeState implements State
{
    /**
     * @var array
     */
    private $nodes = [];

    /**
     * @var array
     */
    private $rows = [];

    /**
     * @var array
     */
    private $columns = [];

    /**
     * @var array
     */
    private $diagonals = [];

    /**
     * @var string
     */
    private $winner;

    /**
     * @var bool
     */
    private $isMaximizing;


    public function __construct(NodeCollection $nodes)
    {
        $this->nodes = $nodes;

        $this->setGrid($nodes);
    }


    public function setIsMaximizing(bool $isMaximizing): void
    {
        $this->isMaximizing = $isMaximizing;
    }

    /**
     * @return array
     */
    public function nodes(): NodeCollection
    {
        return $this->nodes;
    }

    /**
     * Method to determine if this is the end.
     *
     * @return bool
     */
    public function isTermination(): bool
    {
        $this->winner = '';

        foreach ($this->rows as $index => $row) {
            if ($this->checkForWinner($row, 'row', $index)) {
                return true;
            }
        }

        foreach ($this->columns as $index => $column) {
            if ($this->checkForWinner($column, 'column', $index)) {
                return true;
            }
        }

        foreach ($this->diagonals as $index => $diagonal) {
            if ($this->checkForWinner($diagonal, 'diagonal', $index)) {
                return true;
            }
        }

        foreach ($this->nodes->iterator() as $node) {
            if (empty($node->value())) {
                return false;
            }
        }

        return true;
    }

    public function doStateChange(StateChangeEvent $event): void
    {
        /**
         * @var TicTacToeMove $event
         */
        $this->nodes->nodeAtKey($event->node()->name())->setValue($event->value());
    }


    public function undoStateChange(StateChangeEvent $event): void
    {
        /**
         * @var TicTacToeMove $event
         */
        $this->nodes->nodeAtKey($event->node()->name())->setValue('');
    }

    public function rows(): array
    {
        return $this->rows;
    }

    public function columns(): array
    {
        return $this->columns;
    }

    public function diagonals(): array
    {
        return $this->diagonals;
    }

    public function winner(): string
    {
        return (empty($this->winner)) ? 'Tie' : $this->winner;
    }

    public function score(): int
    {
        switch($this->winner) {
            case 'X':
                return 10;
            case 'O':
                return -10;
            default:
                return 0;
        }
    }

    private function checkForWinner(array $nodes): bool
    {
        $winner = $nodes[0]->value();

        foreach ($nodes as $node) {
            if (empty($node->value()) || $node->value() != $winner) {
                return false;
            }
        }

        $this->winner = $winner;

        return true;
    }

    private function setGrid(NodeCollection $nodes): void
    {
        $row = 0;

        foreach ($nodes->iterator() as $index => $node) {

            $this->rows[$row][] = $node;

            if (($index + 1) % 3 === 0) {
                $row++;
            }

            $column = ($index % 3) + 1;

            $this->columns[$column][] = $node;

            if ($index % 4 === 0) {
                $this->diagonals[0][] = $node;
            }

            if ($index % 2 === 0 && $index != 0 && $index != 8) {
                $this->diagonals[1][] = $node;
            }

        }
    }

    public function dumpState()
    {
        foreach ($this->nodes->iterator() as $index => $node) {
            echo ": " . ((!empty($node->value())) ? $node->value() : ' ') . " :";
            if (($index + 1) % 3 === 0) {
                echo "\n";
            }
        }
    }
}