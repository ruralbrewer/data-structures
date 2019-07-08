<?php
declare(strict_types=1);

namespace Graph;

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

    /**
     * @var VertexCollection
     */
    private $adjacent;

    /**
     * @var bool
     */
    private $visited = false;

    /**
     * @var Vertex
     */
    private $pathParent;


    public function __construct(int $id, int $x, int $y, $data = null, VertexCollection $adjacent = null)
    {
        $this->id = $id;
        $this->x = $x;
        $this->y = $y;
        $this->data = $data;
        $this->adjacent = $adjacent;
    }

    public function addAdjacent(Vertex $vertex)
    {
        $this->adjacent()->add($vertex);
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

    public function setData($data)
    {
        $this->data = $data;
    }

    public function data()
    {
        return $this->data;
    }

    public function setVisited()
    {
        $this->visited = true;
    }

    public function visited()
    {
        return $this->visited;
    }

    public function adjacent(): VertexCollection
    {
        if (is_null($this->adjacent)) {
            $this->adjacent = new VertexCollection();
        }

        return $this->adjacent;
    }

    public function hasPathParent(): bool
    {
        return !is_null($this->pathParent);
    }

    public function setPathParent(Vertex $vertex)
    {
        $this->pathParent = $vertex;
    }

    public function pathParent(): Vertex
    {
        return $this->pathParent;
    }

}