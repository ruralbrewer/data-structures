<?php
declare(strict_types=1);

namespace UnionFind;

class UnionFind
{
    /**
     * @var int
     */
    private $size = 0;

    /**
     * @var int
     */
    private $totalElements = 0;

    /**
     * @var array
     */
    private $parents = [];

    /**
     * @throws UnionFindException
     */
    public function __construct(int $size)
    {
        $this->ensureValidSize($size);
        $this->size = $size;
        $this->totalElements = $size;

        for ($i = 0; $i < $size; $i++) {
            $this->parents[$i] = -1;
        }
    }

    public function union(int $node1, int $node2)
    {
        $root1 = $this->find($node1);
        $root2 = $this->find($node2);
        $this->parents[$root1] = $root2;
        $this->size--;
    }

    public function find(int $node, $children = [])
    {
        $parent = $this->parents[$node];

        if ($parent  === -1) {
            array_pop($children);
            foreach($children as $child) {
                $this->parents[$child] = $node;
            }
            return $node;
        }

        $children[] = $node;

        return $this->find($parent, $children);
    }

    public function connected(int $node1, int $node2): bool
    {
        return $this->find($node1) == $this->find($node2);
    }

    public function size(): int
    {
        return $this->size;
    }

    public function totalElements(): int
    {
        return $this->totalElements;
    }

    /**
     * @throws UnionFindException
     */
    private function ensureValidSize(int $size)
    {
        if ($size <= 0) {
            throw new UnionFindException("Size <= 0 is not allowed");
        }
    }
}

