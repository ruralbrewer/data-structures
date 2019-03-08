<?php
declare(strict_types=1);

namespace LinkedList;

interface Node
{
    public function id(): Uuid;

    public function setNext(Node $nextNode);

    public function next(): Node;

    public function find($value): Node;

    public function value();

    public function asArray(): array;

    public function equals(Node $other): bool;
}