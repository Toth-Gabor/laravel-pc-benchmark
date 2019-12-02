<?php


namespace App;


use App\Http\models\hardwares\Cpu;
use App\Http\models\hardwares\Gpu;
use App\Http\models\hardwares\Ram;

class Computer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Cpu
     */
    private $cpu;

    /**
     * @var Gpu
     */
    private $gpu;

    /**
     * @var Ram
     */
    private $ram;

    /**
     * @var array HDD|SSD
     */
    private $storages;

    /**
     * @var float
     */
    private $cpuScore;

    /**
     * @var float
     */
    private $gpuScore;

    /**
     * @var float
     */
    private $ramScore;

    /**
     * @var float
     */
    private $storageScore;

    /**
     * Computer constructor.
     * @param int $id
     * @param Cpu $cpu
     * @param Gpu $gpu
     * @param Ram $ram
     * @param array $storages
     * @param float $cpuScore
     * @param float $gpuScore
     * @param float $ramScore
     */
    public function __construct(int $id, Cpu $cpu, Gpu $gpu, Ram $ram, array $storages,
                                float $cpuScore, float $gpuScore, float $ramScore)
    {
        $this->id = $id;
        $this->cpu = $cpu;
        $this->gpu = $gpu;
        $this->ram = $ram;
        $this->storages = $storages;
        $this->cpuScore = $cpuScore;
        $this->gpuScore = $gpuScore;
        $this->ramScore = $ramScore;
        $this->storageScore = $this->getFastestSSDOrHDDScore($storages);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Cpu
     */
    public function getCpu(): Cpu
    {
        return $this->cpu;
    }

    /**
     * @return Gpu
     */
    public function getGpu(): Gpu
    {
        return $this->gpu;
    }

    /**
     * @return Ram
     */
    public function getRam(): Ram
    {
        return $this->ram;
    }

    /**
     * @return array HDD|SSD
     */
    public function getStorages(): array
    {
        return $this->storages;
    }

    /**
     * @return float
     */
    public function getCpuScore(): float
    {
        return $this->cpuScore;
    }

    /**
     * @return float
     */
    public function getGpuScore(): float
    {
        return $this->gpuScore;
    }

    /**
     * @return float
     */
    public function getRamScore(): float
    {
        return $this->ramScore;
    }

    /**
     * @return float
     */
    public function getStorageScore(): float
    {
        return $this->storageScore;
    }

}
