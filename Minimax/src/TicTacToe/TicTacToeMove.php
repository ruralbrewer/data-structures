<?php
declare(strict_types=1);

namespace Minimax\TicTacToe;

use Minimax\State\Event\StateChangeEvent;
use Minimax\State\Node\Node;

class TicTacToeMove implements StateChangeEvent
{
    /**
     * @var Node
     */
    private $node;

    /**
     * @var string
     */
    private $value;


    public function __construct(Node $node, string $value)
    {
        $this->node = $node;
        $this->value = $value;
    }

    public function name(): string
    {
        return 'MoveEvent';
    }

    public function node(): Node
    {
        return $this->node;
    }

    public function value(): string
    {
        return $this->value;
    }
}