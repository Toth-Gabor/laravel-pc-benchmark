<?php


namespace App;


use App\Http\models\computerParts\Cpu;
use App\Http\models\computerParts\Gpu;
use App\Http\models\computerParts\Ram;
use App\Http\models\computerParts\SSD;

abstract class ComputerPart
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $partType;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $model;

    /**
     * @var int
     */
    private $score;

    /**
     * ComputerPart constructor.
     * @param int $id
     * @param string $partType
     * @param string $brand
     * @param string $model
     * @param int $score
     */
    public function __construct(int $id, string $partType, string $brand, string $model, int $score)
    {
        $this->id = $id;
        $this->partType = $partType;
        $this->brand = $brand;
        $this->model = $model;
        $this->score = $score;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPartType(): string
    {
        return $this->partType;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }


}
