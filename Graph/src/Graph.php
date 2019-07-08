<?php
declare(strict_types=1);

namespace Graph;

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

    public function __construct(VertexCollection $vertices = null, EdgeCollection $edges = null)
    {
        $this->vertices = $vertices;
        $this->edges = $edges;
    }

    public function addVertex(Vertex $vertex)
    {
        $this->vertices()->add($vertex);

        foreach($vertex->adjacent()->iterator() as $adjacent) {
            $this->edges()->add(new Edge($vertex, $adjacent));
        }
    }

    public function vertices(): VertexCollection
    {
        if (is_null($this->vertices)) {
            $this->vertices = new VertexCollection();
        }

        return $this->vertices;
    }

    public function edges(): EdgeCollection
    {
        if (is_null($this->edges)) {
            $this->edges = new EdgeCollection();
        }

        return $this->edges;
    }
}