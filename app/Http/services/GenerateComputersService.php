<?php


namespace App\Http\services;


use App\Computer;
use App\Http\repositories\ComputerPartService;
use App\Http\repositories\GenerateComputersRepository;

class GenerateComputersService
{
    /**
     * @var GenerateComputersRepository
     */
    private $gCRepo;

    /**
     * @var BenchmarkScoreCounter
     */
    private $bSCounter;

    /**
     * GenerateComputersService constructor.
     */
    public function __construct()
    {
        $this->gCRepo = new GenerateComputersRepository();
        $this->bSCounter = new BenchmarkScoreCounter();
    }

    /**
     * @param int $numOfInsert
     * @param int $numOfComputer
     * @return array
     */
    public function createDBInsert(int $numOfInsert, int $numOfComputer): array
    {
        $insertValuesList = array();
        for ($i = 0; $i < $numOfInsert; $i++) {
            $insertValuesList = $this->generateComputer($numOfComputer);
        }
        return $insertValuesList;
    }

    /**
     * @param int $numOfComputer
     * @return array
     */
    public function generateComputer(int $numOfComputer): array
    {
        $generatedComputer = array();
        $compatibleCpuAndGpu = $this->getCompatibleCpuAndGpu();
        $ramList = $this->gCRepo->getAllRam();


        // generate n computer
        for ($i = 0; $i < $numOfComputer; $i++) {
            $cpu = get_object_vars($compatibleCpuAndGpu['cpu']);
            $gpu = get_object_vars($compatibleCpuAndGpu['gpu']);
            $ram = get_object_vars($ramList[array_rand($ramList)]);
            $storageList = $this->gCRepo->getRandomStorages();
            $scoreList = $this->bSCounter->countScores($cpu['score'], $gpu['score'], $ram['score'],
                $this->bSCounter->getFastestSSDOrHDDScore($storageList));
            // put all data of generated computer into an array
            $generatedComputer[] = ['cpu'=>$cpu['id'], 'gpu'=>$gpu['id'], 'ram'=>$ram['id'], 'storages'=>$storageList,
                'gScore'=>$scoreList['gamer'], 'wScore'=>$scoreList['workstation'], 'dScore'=>$scoreList['desktop']];
        }
        return $generatedComputer;
    }

    private function getCompatibleCpuAndGpu(): array
    {
        $rndIndex = rand(0, 1);

        // get CPU and GPU lists
        $intelCPUList = $this->gCRepo->getAllIntelCPU();
        $amdCPUList = $this->gCRepo->getAllAmdCPU();
        $intelCompatibleGPUList = $this->gCRepo->getAllIntelCompatibleGPU();
        $amdCompatibleGPUList = $this->gCRepo->getAllAmdCompatibleGPU();

        // add Intel and AMD compatible CPU-GPU pair
        $compatibleCpuAndGpu[] = array('cpu'=>$intelCPUList[array_rand($intelCPUList)], 'gpu'=>$intelCompatibleGPUList[array_rand($intelCompatibleGPUList)]);
        $compatibleCpuAndGpu[] = array('cpu'=>$amdCPUList[array_rand($amdCPUList)], 'gpu'=>$amdCompatibleGPUList[array_rand($amdCompatibleGPUList)]);

        // return one of pair of them

        return $compatibleCpuAndGpu[$rndIndex];
    }


}
