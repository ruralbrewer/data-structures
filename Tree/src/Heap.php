<?php
declare(strict_types=1);

namespace Tree;

class Heap
{
    /**
     * @var array
     */
    private $map = [];

    /**
     * @var array
     */
    private $heap = [];

    /**
     * @var int
     */
    private $size = 0;

    /**
     * @var bool
     */
    private $isMax;

    /**
     * @var bool
     */
    private $withMap;

    public static function fromArrayNoMap(array $nodes, $isMax = true)
    {
        $heap = new self($nodes, $isMax, false);
        for ($i = max(0, (count($nodes)/2) - 1); $i >= 0; $i--) {
            $heap->sink($i);
        }
        return $heap;
    }

    public static function fromArrayWithMap(array $nodes = [], $isMax = true)
    {
        $heap = new self([], $isMax);
        foreach ($nodes as $integer) {
            $heap->add($integer);
        }
        return $heap;
    }

    public function __construct(array $nodes = [], bool $isMax = true, $withMap = true)
    {
        $this->heap = $nodes;
        $this->size = count($nodes);
        $this->isMax = $isMax;
        $this->withMap = $withMap;
    }

    public function size()
    {
        return $this->size;
    }

    public function peek()
    {
        return $this->heap[0];
    }

    /**
     * @throws TreeException
     */
    public function poll()
    {
        if ($this->isEmpty()) {
            throw new TreeException("Heap is empty.");
        }
        return $this->removeAt(0);
    }

    public function has(int $integer): bool
    {
        if ($this->withMap) {
            return isset($this->map[$integer]);
        }

        return in_array($integer, $this->heap);
    }

    /**
     * @throws TreeException
     */
    public function find(int $integer)
    {
        if (!$this->has($integer)) {
            throw new TreeException(sprintf("%d does not exist in heap.", $integer));
        }

        if ($this->withMap) {
            return $this->heap[$this->map[$integer][0]];
        }

        $index = array_search($integer, $this->heap);

        return $this->heap[$index];
    }

    public function isEmpty()
    {
        return $this->size === 0;
    }

    private function compare($node1, $node2): bool
    {
        if ($this->isMax) {
            return ($this->heap[$node1] < $this->heap[$node2]);
        }
        return ($this->heap[$node1] > $this->heap[$node2]);
    }

    public function sink(int $index)
    {
        while (true) {

            $left = ((2 * $index) + 1);
            $right = ((2 * $index) + 2);
            $smallest = $left;

            if (($right < $this->size) && $this->compare($right, $left)) {
                $smallest = $right;
            }

            if (($left >= $this->size) || $this->compare($index, $smallest)) {
                break;
            }

            $this->swap($smallest, $index);

            $index = $smallest;
        }
    }

    public function swim($index)
    {
        $parent = intval(($index - 1) / 2);

        while (($index > 0) && $this->compare($index, $parent)) {
            $this->swap($parent, $index);
            $index = $parent;
            $parent = intval(($index - 1) / 2);
        }
    }

    private function swap($node1, $node2)
    {
        $value1 = $this->heap[$node1];
        $value2 = $this->heap[$node2];

        $this->heap[$node1] = $value2;
        $this->heap[$node2] = $value1;

        if ($this->withMap) {
            $this->updateMap($value1, $node2, $node1);
            $this->updateMap($value2, $node1, $node2);
        }
    }

    private function addToMap($key, $indexValue) {
        $this->map[$key] = [$indexValue];
    }

    private function removeFromMap($key) {
        unset($this->map[$key]);
    }

    private function updateMap($key, $newValue, $oldValue)
    {
        $this->map[$key] = array_diff($this->map[$key], [$oldValue]);
        $this->map[$key][] = $newValue;
    }

    public function asArray()
    {
        return $this->heap;
    }

    public function add(int $integer)
    {
        array_push($this->heap, $integer);
        if ($this->withMap) {
            $this->addToMap($integer, $this->size);
        }
        $this->swim($this->size);
        $this->size++;
    }

    /**
     * @throws TreeException
     */
    public function removeAt(int $index)
    {
        if ($this->isEmpty() || $index > $this->size || $index < 0) {
            throw new TreeException("Invalid index given.");
        }

        $this->size--;

        $this->swap($index, $this->size);

        $value = array_pop($this->heap);

        if ($this->withMap) {
            $this->removeFromMap($value);
        }

        if (isset($this->heap[$index])) {

            $node = $this->heap[$index];

            $this->sink($index);

            if ($node == $this->heap[$index]) {
                $this->swim($index);
            }
        }

        return $value;
    }

    public function map()
    {
        return $this->map;
    }
}