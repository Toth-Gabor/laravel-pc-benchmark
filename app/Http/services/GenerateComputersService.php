<?php


namespace App\Http\services;


use App\Http\repositories\GenerateComputersRepository;

class GenerateComputersService
{
    /**
     * @var GenerateComputersRepository
     */
    private $gCRepo;

    /**
     * @var array
     */
    private $intelCPUList;

    /**
     * @var array
     */
    private $amdCPUList;

    /**
     * @var array
     */
    private $intelCompatibleGPUList;

    /**
     * @var array
     */
    private $amdCompatibleGPUList;

    /**
     * GenerateComputersService constructor.
     */
    public function __construct()
    {
        $this->gCRepo = new GenerateComputersRepository();

        $this->intelCPUList = $this->gCRepo->getPartData('CPU', 'Intel');
        $this->amdCPUList = $this->gCRepo->getPartData('CPU', 'AMD');
        $this->intelCompatibleGPUList = $this->gCRepo->getPartData('GPU', 'AMD', '!=');
        $this->amdCompatibleGPUList = $this->gCRepo->getPartData('GPU', 'Intel', '!=');
    }

    /**
     * @param int $numOfInsert
     * @param int $numOfComputer
     */
    public function createDBInsert(int $numOfInsert, int $numOfComputer)
    {
        for ($i = 0; $i < $numOfInsert; $i++) {
            $asd = $this->generateComputer($numOfComputer);
            $this->gCRepo->insertGeneratedComputers($asd);
        }
    }

    /**
     * @param int $numOfComputer
     * @return array
     */
    public function generateComputer(int $numOfComputer): array
    {
        $generatedComputer = array();
        $ramList = $this->gCRepo->getPartData('RAM');

        // generate n computer
        for ($i = 0; $i < $numOfComputer; $i++) {
            $compatibleCpuAndGpu = $this->getCompatibleCpuAndGpu();
            $cpu = get_object_vars($compatibleCpuAndGpu['cpu']);
            $gpu = get_object_vars($compatibleCpuAndGpu['gpu']);
            $ram = get_object_vars($ramList[array_rand($ramList)]);
            $storageList = $this->gCRepo->getRandomStorages();
            $cpuScore = $this->getRandomScore($cpu['score']);
            $gpuScore = $this->getRandomScore($gpu['score']);
            $ramScore = $this->getRandomScore($ram['score']);

            // put all data of generated computer into an array
            $generatedComputer[] = ['cpu' => $cpu['id'], 'gpu' => $gpu['id'], 'ram' => $ram['id'], 'storages' => $storageList,
                'cpu_score' => $cpuScore, 'gpu_score' => $gpuScore, 'ram_score' => $ramScore,];
        }
        return $generatedComputer;
    }

    /**
     * @return array
     */
    private function getCompatibleCpuAndGpu()
    {
        $rndNum = rand(0, 1);
        // add Intel and AMD compatible CPU-GPU pair
        if ($rndNum == 0) {
            return array(
                'cpu' => $this->intelCPUList[array_rand($this->intelCPUList, 1)],
                'gpu' => $this->intelCompatibleGPUList[array_rand($this->intelCompatibleGPUList, 1)]);
        } else {
            return array(
                'cpu' => $this->amdCPUList[array_rand($this->amdCPUList, 1)],
                'gpu' => $this->amdCompatibleGPUList[array_rand($this->amdCompatibleGPUList, 1)]);
        }
    }

    /**
     * @param float $score
     * @return float
     */
    private function getRandomScore(float $score): float
    {
        return ((mt_rand(0, 1000000) / 5000000) + 0.9) * $score;
    }
}
