<?php
declare(strict_types=1);

namespace Minimax;

interface StateChangeEvent
{
    public function name(): string;
}