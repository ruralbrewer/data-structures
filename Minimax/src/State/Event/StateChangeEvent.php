<?php
declare(strict_types=1);

namespace Minimax\State\Event;

interface StateChangeEvent
{
    public function name(): string;
}