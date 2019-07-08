<?php
declare(strict_types=1);

namespace Graph\VisitationTasks;

use Graph\Vertex;

class PrintVisitationTask implements VisitationTask
{

    public function endTraverse(): bool
    {
        return false;
    }

    public function doTask(Vertex $vertex)
    {
        echo $vertex->data() . ", ";
    }

    public function result()
    {
        // nothing
    }
}