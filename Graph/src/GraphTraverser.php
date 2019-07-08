<?php
declare(strict_types=1);

namespace Graph;

use Graph\VisitationTasks\VisitationTask;

class GraphTraverser
{
    /**
     * @var VisitationTask
     */
    private static $visitationTask;

    public static function depthFirstTraverse(Vertex $vertex)
    {
        $stack = [$vertex];

        while (!empty($stack)) {

            /** @var Vertex $vertex */
            $vertex = array_pop($stack);

            if (!$vertex->visited()) {
                if (!self::visit($vertex)) {
                    break;
                }

                /** @var Vertex $adjacent */
                foreach ($vertex->adjacent()->iterator() as $adjacent) {
                    if (!$adjacent->visited()) {
                        $adjacent->setPathParent($vertex);
                        array_push($stack, $adjacent);
                    }
                }
            }
        }

        self::$visitationTask->result();
    }

    public static function breadthFirstTraverse(Vertex $vertex)
    {
        $queue = [$vertex];

        while (!empty($queue)) {

            /** @var Vertex $vertex */
            $vertex = array_shift($queue);

            if (!$vertex->visited()) {
                if (!self::visit($vertex)) {
                    break;
                }

                /** @var Vertex $adjacent */
                foreach ($vertex->adjacent()->iterator() as $adjacent) {
                    if (!$adjacent->visited()) {
                        $adjacent->setPathParent($vertex);
                        array_push($queue, $adjacent);
                    }
                }
            }
        }

        self::$visitationTask->result();
    }

    /*
     * HELPER FUNCTIONS
     */

    public static function setTask(VisitationTask $visitationTask): GraphTraverser
    {
        self::$visitationTask = $visitationTask;

        return new static;
    }

    private static function visit(Vertex $vertex): bool
    {
        $vertex->setVisited();

        $task = self::$visitationTask;

        if (!is_null($task)) {
            $task->doTask($vertex);
            if ($task->endTraverse()) {
                return false;
            }
        }

        return true;
    }

}