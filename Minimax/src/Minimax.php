<?php
declare(strict_types=1);

namespace Minimax;

class Minimax
{
    private $count = 0;

    public function evaluate(
        State $state,
        int $depth,
        bool $isMaximizing,
        float $alpha = -INF,
        float $beta = INF
    ) {
        $this->count++;

        $move = null;

        if ($state->isTermination()) {

            $modifier = ($isMaximizing) ? -$depth : $depth;
            $score = $state->score() + $modifier;

            return [
                'score' => $score,
                'move' => $move
            ];
        }

        $best = ($isMaximizing) ? -INF : INF;

        foreach ($state->nodes()->iterator() as $index => $node) {

            if (empty($node->value())) {

                if ($beta <= $alpha) {
                    break;
                }

                $node->setValue($state->currentNodeValue($isMaximizing));
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

                $node->setValue($state->emptyNodeValue());
            }
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