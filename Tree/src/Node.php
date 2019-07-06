<?php
declare(strict_types=1);

namespace Tree;

interface Node
{
    public function data();


    public function hasLeft(): bool;

    public function setLeft(Node $node);

    public function left(): Node;


    public function hasRight(): bool;

    public function setRight(Node $node);

    public function right(): Node;


    public function greaterThan(Node $other): bool;

    public function lessThan(Node $other): bool;

    public function equals(Node $other): bool;


    public function incrementLevel();

    public function level(): int;


    public function setVisited();

    public function visited(): bool;


    public function asArray(): array;
}