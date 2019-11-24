<?php


namespace App;


use App\Http\models\computerParts\Cpu;
use App\Http\models\computerParts\Gpu;
use App\Http\models\computerParts\Ram;

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
    private $gamerScore;

    /**
     * @var float
     */
    private $workstationScore;

    /**
     * @var float
     */
    private $desktopScore;

    /**
     * Computer constructor.
     * @param int $id
     * @param Cpu $cpu
     * @param Gpu $gpu
     * @param Ram $ram
     * @param array $storages
     * @param float $gamerScore
     * @param float $workstationScore
     * @param float $desktopScore
     */
    public function __construct(int $id, Cpu $cpu, Gpu $gpu, Ram $ram, array $storages,
                                float $gamerScore, float $workstationScore, float $desktopScore)
    {
        $this->id = $id;
        $this->cpu = $cpu;
        $this->gpu = $gpu;
        $this->ram = $ram;
        $this->storages = $storages;
        $this->gamerScore = $gamerScore;
        $this->workstationScore = $workstationScore;
        $this->desktopScore = $desktopScore;
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
    public function getGamerScore(): float
    {
        return $this->gamerScore;
    }

    /**
     * @return float
     */
    public function getWorkstationScore(): float
    {
        return $this->workstationScore;
    }

    /**
     * @return float
     */
    public function getDesktopScore(): float
    {
        return $this->desktopScore;
    }


}
