<?php
declare(strict_types=1);

namespace UnionFind;

class Vertex
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;
    /**
     * @var mixed
     */
    private $data;


    public function __construct(int $id, int $x, int $y, $data = null)
    {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;
        $this->data = $data;
    }

    public function id()
    {
        return $this->id;
    }

    public function x()
    {
        return $this->x;
    }

    public function y()
    {
        return $this->y;
    }

    public function data()
    {
        return $this->data;
    }
}