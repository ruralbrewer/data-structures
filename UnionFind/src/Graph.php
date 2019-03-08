<?php
declare(strict_types=1);

namespace UnionFind;

class Graph
{
    /**
     * @var VertexCollection
     */
    private $vertices;

    /**
     * @var EdgeCollection
     */
    private $edges;

    public function __construct(VertexCollection $vertices, EdgeCollection $edges = null)
    {
        $this->vertices = $vertices;
        $this->edges = $edges;
    }

    public function vertices(): VertexCollection
    {
        return $this->vertices;
    }

    public function edges(): EdgeCollection
    {
        return $this->edges;
    }
}