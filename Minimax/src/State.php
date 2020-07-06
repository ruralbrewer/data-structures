<?php
declare(strict_types=1);

namespace Minimax;

interface State
{
    public function setIsMaximizing(bool $isMaximizing): void;

    public function nodes(): NodeCollection;

    /**
     * Method to determine if this is the end.
     *
     * @return bool
     */
    public function isTermination(): bool;

    public function updateState(Node $node): void;

    public function resetState(Node $node): void;

    /**
     * Method to return the default (empty) value for a node.
     *
     * @return mixed
     */
    public function emptyNodeValue();

    public function winner(): string;

    public function score(): int;
}