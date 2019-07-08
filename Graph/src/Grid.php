<?php
declare(strict_types=1);

namespace Graph;

class Grid extends Graph
{
    /**
     * @var array
     */
    private $gridMap = [];

    public static function fromGridPoints(int $x1, int $y1, int $x2, int $y2)
    {
        $grid = new self();

        $vertices = [];

        $vertexIndex = 0;

        for ($i = $x1; $i <= $x2; $i++) {
            $vertices[$i] = [];
            for ($j=$y1; $j <= $y2; $j++) {
                $vertices[$i][$j] = new Vertex($vertexIndex++, $i, $j, "[$i, $j]");
            }
        }

        $grid->setGridMap($vertices);

        for ($i = $x1; $i <= $x2; $i++) {
            for ($j=$y1; $j <= $y2; $j++) {
                /** @var Vertex $vertex */
                $vertex = $vertices[$i][$j];
                if (isset($vertices[$i-1][$j-1])) {
                    $vertex->addAdjacent($vertices[$i-1][$j-1]);
                }
                if (isset($vertices[$i][$j-1])) {
                    $vertex->addAdjacent($vertices[$i][$j-1]);
                }
                if (isset($vertices[$i+1][$j-1])) {
                    $vertex->addAdjacent($vertices[$i+1][$j-1]);
                }
                if (isset($vertices[$i-1][$j])) {
                    $vertex->addAdjacent($vertices[$i-1][$j]);
                }
                if (isset($vertices[$i+1][$j])) {
                    $vertex->addAdjacent($vertices[$i+1][$j]);
                }
                if (isset($vertices[$i-1][$j+1])) {
                    $vertex->addAdjacent($vertices[$i-1][$j+1]);
                }
                if (isset($vertices[$i][$j+1])) {
                    $vertex->addAdjacent($vertices[$i][$j+1]);
                }
                if (isset($vertices[$i+1][$j+1])) {
                    $vertex->addAdjacent($vertices[$i+1][$j+1]);
                }

                $grid->addVertex($vertex);
            }
        }

        return $grid;
    }

    public function setGridMap(array $gridMap)
    {
        $this->gridMap = $gridMap;
    }

    public function hasAtPoint(int $x, int $y): bool
    {
        return isset($this->gridMap[$x][$y]);
    }

    /**
     * @throws GraphException
     */
    public function getAtPoint(int $x, int $y): Vertex
    {
        if (!$this->hasAtPoint($x, $y)) {
            throw new GraphException(
                sprintf("No Vertex found at point [%d, %d]", $x, $y)
            );
        }

        return $this->gridMap[$x][$y];
    }
}