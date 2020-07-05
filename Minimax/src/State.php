<?php
declare(strict_types=1);

namespace Minimax;

interface State
{

    public function nodes(): NodeCollection;

    /**
     * Method to determine if this is the end.
     *
     * @return bool
     */
    public function isTermination(): bool;

    /**
     * Method to return the value to be used for a given turn.
     *
     * @return mixed
     */
    public function currentNodeValue(bool $isMaximizing);

    /**
     * Method to return the default (empty) value for a node.
     *
     * @return mixed
     */
    public function emptyNodeValue();

    public function winner(): string;

    public function score(): int;
}