<?php
declare(strict_types=1);

namespace Minimax;

interface StateEvaluator
{
    public function setIsMaximizing(bool $isMaximizing): void;

    public function evaluate(State $state): int;

    public function getPossibleEvents(State $state): StateChangeEventCollection;
}