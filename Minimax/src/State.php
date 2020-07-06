<?php
declare(strict_types=1);

namespace Minimax;

interface State
{
    public function setIsMaximizing(bool $isMaximizing): void;

    public function nodes(): NodeCollection;

    public function isTermination(): bool;

    public function doStateChange(StateChangeEvent $event): void;

    public function undoStateChange(StateChangeEvent $event): void;

    public function winner(): string;

    public function score(): int;
}