<?php
declare(strict_types=1);

namespace Graph\VisitationTasks;

use Graph\Vertex;

class FindWinnerVisitationTask implements VisitationTask
{

    /**
     * @var bool
     */
    private $endTraverse = false;

    /**
     * @var Vertex
     */
    private $winner;


    public function endTraverse(): bool
    {
        return $this->endTraverse;
    }

    public function doTask(Vertex $vertex)
    {
        if ($vertex->data() == "Winner winner, chicken dinner!") {
            $this->winner = $vertex;
            $this->endTraverse = true;
        }
    }

    public function result()
    {
        if (!is_null($this->winner)) {
            $this->printPath($this->winner);
            echo  "\n";
            echo $this->winner->data() . "\n";
            echo "[{$this->winner->x()}, {$this->winner->y()}]\n";
        }
        else {
            echo "No Winner Found\n";
        }
    }

    private function printPath(Vertex $vertex)
    {
        if ($vertex->hasPathParent()) {
            $this->printPath($vertex->pathParent());
        }

        echo "[{$vertex->x()}, {$vertex->y()}], ";
    }
}