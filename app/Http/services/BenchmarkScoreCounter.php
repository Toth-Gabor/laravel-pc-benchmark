<?php


namespace App\Http\services;


class BenchmarkScoreCounter
{
    /**
     * @param float $cpuScore
     * @param float $gpuScore
     * @param float $ramScore
     * @param float $storageScore
     * @return array float
     */
    public function countScores(float $cpuScore, float $gpuScore, float $ramScore, float $storageScore): array
    {
        $scoreList = array();

        $scoreList['gamer'] = (($cpuScore * 0.3) + ($gpuScore * 0.5) + ($storageScore * 0.1) + ($ramScore * 0.1));
        $scoreList['workstation'] = (($cpuScore * 0.5) + ($gpuScore * 0.1) + ($storageScore * 0.2) + ($ramScore * 0.2));
        $scoreList['desktop'] = (($cpuScore * 0.3) + ($gpuScore * 0.1) + ($storageScore * 0.3) + ($ramScore * 0.3));

        return $scoreList;
    }



    /**
     * @param int $hardwareId
     * @return float
     */
    public function getHardwareScore(int $hardwareId): float
    {
        $score = 0;
        return $score;
    }

}
