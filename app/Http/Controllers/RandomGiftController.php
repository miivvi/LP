<?php


namespace App\Http\Controllers;


final class RandomGiftController
{
    /**
     * @param array $data
     * @return mixed
     */
    public function random(array $data)
    {
        $values = array_keys($data);
        list($lookup, $totalWeight) = $this->calc(array_values($data));
        $randTotalWeight = mt_rand(1, $totalWeight);

        return $values[$this->search($randTotalWeight, $lookup)];
    }

    /**
     * @param array $weights
     * @return array
     */
    protected function calc(array $weights): array
    {
        $lookup = [];
        $total_weight = 0;

        for ($i = 0; $i < count($weights); $i++) {
            $total_weight += $weights[$i];
            $lookup[$i] = $total_weight;
        }

        return [$lookup, $total_weight];
    }

    /**
     * @param int $needle
     * @param array $haystack
     * @return int
     */
    protected function search($needle, $haystack): int
    {
        $high = count($haystack) - 1;
        $low = 0;

        while ($low < $high) {
            $probe = (int)(($high + $low) / 2);
            if ($haystack[$probe] < $needle) {
                $low = $probe + 1;
            } elseif ($haystack[$probe] > $needle) {
                $high = $probe - 1;
            } else {
                return $probe;
            }
        }

        if ($low != $high) {
            return $probe;
        } else {
            return ($haystack[$low] >= $needle) ? $low : $low + 1;
        }
    }

}
