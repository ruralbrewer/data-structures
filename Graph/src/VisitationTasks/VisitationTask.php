<?php
declare(strict_types=1);

namespace Graph\VisitationTasks;

use Graph\Vertex;

interface VisitationTask
{
    public function endTraverse(): bool;

    public function doTask(Vertex $vertex);

    public function result();

}