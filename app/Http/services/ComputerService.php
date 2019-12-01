<?php


namespace App\Http\repositories;


use App\Computer;
use App\Http\models\hardwares\Cpu;
use App\Http\models\hardwares\Gpu;
use App\Http\models\hardwares\Ram;
use function Composer\Autoload\includeFile;

class ComputerService
{
    private $compRepo;

    /**
     * ComputerService constructor.
     */
    public function __construct()
    {
        $this->compRepo = new ComputerRepository();
    }

    /**
     * @param float $cpuScore
     * @param float $gpuScore
     * @param float $ramScore
     * @param array $storages
     * @return array
     */
    public function getScores(float $cpuScore, float $gpuScore, float $ramScore, array $storages): array
    {
        $scores = [];
        $warning = 'Your computer is not complete yet!';
        $storageScore = $this->getMaxStorageScore($storages);
        if (empty($cpuScore) || empty($gpuScore) || empty($ramScore) || empty($storageScore)) {
            $scores['gamer'] = $warning;
            $scores['work'] = $warning;
            $scores['desk'] = $warning;
        } else {
            $scores['gamer'] = (($cpuScore * 0.3) + ($gpuScore * 0.5) + ($storageScore * 0.1) + ($ramScore * 0.1));
            $scores['work'] = (($cpuScore * 0.5) + ($gpuScore * 0.1) + ($storageScore * 0.2) + ($ramScore * 0.2));
            $scores['desk'] = (($cpuScore * 0.3) + ($gpuScore * 0.1) + ($storageScore * 0.3) + ($ramScore * 0.3));
        }
        return $scores;
    }

    /**
     * @param array $storages
     * @return float
     */
    private function getMaxStorageScore(array $storages): float
    {
        return max(array_column($storages, 'score'));
    }


}
