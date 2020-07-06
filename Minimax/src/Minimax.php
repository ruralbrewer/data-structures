<?php
declare(strict_types=1);

namespace Minimax;

class Minimax
{
    /**
     * @var StateEvaluator
     */
    private $stateEvaluator;

    private $count = 0;


    public function __construct(StateEvaluator $stateEvaluator)
    {
        $this->stateEvaluator = $stateEvaluator;
    }

    public function evaluate(
        State $state,
        int $depth,
        bool $isMaximizing,
        float $alpha = -INF,
        float $beta = INF
    ) {
        $this->count++;

        $bestEvent = null;

        $this->stateEvaluator->setIsMaximizing($isMaximizing);

        if ($state->isTermination()) {

            return [
                'score' => $state->score(),
                'event' => $bestEvent
            ];
        }

        $bestScore = ($isMaximizing) ? -INF : INF;

        foreach ($this->stateEvaluator->getPossibleEvents($state)->iterator() as $event) {

            if ($beta <= $alpha) {
                break;
            }

            $state->doStateChange($event);

            $evaluation = $this->evaluate($state, $depth + 1, !$isMaximizing, $alpha, $beta);

            if ($isMaximizing && $evaluation['score'] > $bestScore) {

                $bestScore = $evaluation['score'];
                $alpha = $bestScore;
                $bestEvent = $event;

            } else if (!$isMaximizing && $evaluation['score'] < $bestScore) {

                $bestScore = $evaluation['score'];
                $beta = $bestScore;
                $bestEvent = $event;

            }

            $state->undoStateChange($event);
        }

        return [
            'score' => $bestScore,
            'event' => $bestEvent
        ];
    }

    public function count(): int
    {
        return $this->count;
    }
}