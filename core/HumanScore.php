<?php
namespace HumanAnalytics\Core;

class HumanScore
{
    /**
     * Calculate human confidence score (0–100)
     */
    public function calculate(array $signals): int
    {
        $score = 0;

        // JavaScript execution
        if (!empty($signals['js'])) {
            $score += 25;
        }

        // Interaction signals
        if (!empty($signals['mousemove'])) {
            $score += 15;
        }

        if (!empty($signals['scroll'])) {
            $score += 15;
        }

        if (!empty($signals['keydown'])) {
            $score += 10;
        }

        // Time on page (seconds)
        if (($signals['time'] ?? 0) >= 3) {
            $score += 15;
        }

        // Page visibility
        if (!empty($signals['visible'])) {
            $score += 10;
        }

        return min($score, 100);
    }
}
