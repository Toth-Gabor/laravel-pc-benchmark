<?php


namespace App\Http\services;


class BenchmarkScoreCounter
{
    /**
     * @param int $cpuScore
     * @param int $gpuScore
     * @param int $ramScore
     * @param int $storageScore
     * @return array int
     */
    public function countScores(int $cpuScore, int $gpuScore, int $ramScore, int $storageScore): array
    {
        $scoreList = array();

        $scoreList['gamer'] = (($cpuScore * 0.3) + ($gpuScore * 0.5) + ($storageScore * 0.1) + ($ramScore * 0.1));
        $scoreList['workstation'] = (($cpuScore * 0.5) + ($gpuScore * 0.1) + ($storageScore * 0.2) + ($ramScore * 0.2));
        $scoreList['desktop'] = (($cpuScore * 0.3) + ($gpuScore * 0.1) + ($storageScore * 0.3) + ($ramScore * 0.3));

        return $scoreList;
    }

}
