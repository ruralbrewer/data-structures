<?php
declare(strict_types=1);

namespace Minimax;

interface StateEvaluator
{
    public function setIsMaximizing(bool $isMaximizing): void;

    /**
     * Method to assign a (min/max) weight to the current state.
     */
    public function evaluate(State $state): int;

    public function getPossibleMoves(State $state): NodeCollection;
}