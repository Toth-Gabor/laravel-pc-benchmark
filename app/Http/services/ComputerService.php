<?php


namespace App\Http\services;

use Exception;

class ComputerService
{
    /**
     * @param float $cpuScore
     * @param float $gpuScore
     * @param float $ramScore
     * @param array $storageList
     * @return array
     * @throws Exception
     */
    public function getScores(float $cpuScore, float $gpuScore, float $ramScore, array $storageList): array
    {
        $scores = [];
        $storageScore = $this->getMaxStorageScore($storageList);

        if (!(empty($cpuScore) || empty($gpuScore) || empty($ramScore) || empty($storageScore))) {
            $scores['gamer'] = (($cpuScore * 0.3) + ($gpuScore * 0.5) + ($storageScore * 0.1) + ($ramScore * 0.1));
            $scores['work'] = (($cpuScore * 0.5) + ($gpuScore * 0.1) + ($storageScore * 0.2) + ($ramScore * 0.2));
            $scores['desk'] = (($cpuScore * 0.3) + ($gpuScore * 0.1) + ($storageScore * 0.3) + ($ramScore * 0.3));
        } else {
            throw new Exception('Your computer is not complete yet!');
        }
        return $scores;
    }

    /**
     * @param array $storageList
     * @return float
     */
    private function getMaxStorageScore(array $storageList): float
    {
        $tempArr = [];
        foreach ($storageList as $value) {
            $tempArr[] = $value->getScore();
        }
        return max($tempArr);
    }

    /**
     * @param array $computer
     * @return bool
     */
    public function isCompleted(array $computer): bool
    {
        $status = true;
        if (empty($computer['cpu'])) {
            $status = false;
        } elseif (empty($computer['gpu'])) {
            $status = false;
        } elseif (empty($computer['ram'])) {
            $status = false;
        } elseif (empty($computer['storages'])) {
            $status = false;
        }
        return $status;
    }
}
