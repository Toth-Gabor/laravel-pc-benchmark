<?php


namespace App\Http\services;


use App\Http\models\hardwares\Cpu;
use App\Http\models\hardwares\Gpu;
use App\Http\models\hardwares\Hardware;
use App\Http\models\hardwares\HDD;
use App\Http\models\hardwares\Ram;
use App\Http\models\hardwares\SSD;
use App\Http\repositories\HardwaresRepository;
use Exception;

class HardwareService
{
    private $hardwareRepo;

    /**
     * HardwareService constructor.
     */
    public function __construct()
    {
        $this->hardwareRepo = new HardwaresRepository();
    }

    /**
     * @return array
     */
    public function getAllCpuAndAvgScore()
    {
        return $this->hardwareRepo->getAllCpuAndAvgScore();
    }

    /**
     * @return array
     */
    public function getAllGpuAndAvgScore()
    {
        return $this->hardwareRepo->getAllGpuAndAvgScore();
    }

    /**
     * @return array
     */
    public function getAllRamAndAvgScore()
    {
        return $this->hardwareRepo->getAllRamAndAvgScore();
    }

    /**
     * @return array
     */
    public function getAllSSDAndAvgScore()
    {
        return $this->hardwareRepo->getAllSSDAndAvgScore();
    }

    /**
     * @return array
     */
    public function getAllHDDAndAvgScore()
    {
        return $this->hardwareRepo->getAllHDDAndAvgScore();
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getHardwareListById(int $id): array
    {
        $hwType = $this->hardwareRepo->getHardwareById($id)[0]->part;
        switch ($hwType) {
            case 'CPU':
                return $this->hardwareRepo->getCpuListById($id);
            case 'GPU':
                return $this->hardwareRepo->getGpuListById($id);
            case 'RAM':
                return $this->hardwareRepo->getRamListById($id);
            case 'SSD':
            case 'HDD':
                return $this->hardwareRepo->getStorageListById($id);
            default:
                throw new Exception("There is'nt any hardware with this id!");
        }
    }

    /**
     * @param int $id
     * @return Cpu|Gpu|Ram|SSD|HDD
     * @throws Exception
     */
    public function getHardwareById(int $id): Hardware
    {
        $tempHw = $this->hardwareRepo->getHardwareById($id)[0];
        $hwType = $tempHw->part;
        $brand = $tempHw->brand;
        $model = $tempHw->model;
        $score = $tempHw->score;
        switch ($hwType) {
            case 'CPU':
                return new Cpu($id, $hwType, $brand, $model, $score);
            case 'GPU':
                return new Gpu($id, $hwType, $brand, $model, $score);
            case 'RAM':
                return new Ram($id, $hwType, $brand, $model, $score);
            case 'SSD':
                return new SSD($id, $hwType, $brand, $model, $score);
            case 'HDD':
                return new HDD($id, $hwType, $brand, $model, $score);
            default:
                throw new Exception("There is'nt any hardware with this id!");
        }
    }
}
