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

        $move = null;

        $this->stateEvaluator->setIsMaximizing($isMaximizing);

        if ($state->isTermination()) {

            $modifier = ($isMaximizing) ? -$depth : $depth;
            $score = $state->score() + $modifier;

            return [
                'score' => $score,
                'move' => $move
            ];
        }

        $best = ($isMaximizing) ? -INF : INF;

        foreach ($this->stateEvaluator->getPossibleMoves($state)->iterator() as $node) {

            if ($beta <= $alpha) {
                break;
            }

            $state->updateState($node);

            $evaluation = $this->evaluate($state, $depth + 1, !$isMaximizing, $alpha, $beta);

            if ($isMaximizing && $evaluation['score'] > $best) {

                $best = $evaluation['score'];
                $alpha = $best;
                $move = $node;

            } else if (!$isMaximizing && $evaluation['score'] < $best) {

                $best = $evaluation['score'];
                $beta = $best;
                $move = $node;

            }

            $state->resetState($node);
        }

        return [
            'score' => $best,
            'move' => $move
        ];
    }

    public function count(): int
    {
        return $this->count;
    }
}