<?php


namespace App\Http\models\hardwares;


use Exception;

class HardwareFactory
{
    /**
     * @param int $id
     * @param string $partType
     * @param string $brand
     * @param string $model
     * @param int $score
     * @return HDD|Cpu|Gpu|Ram|SSD
     * @throws Exception
     */
    public static function createHardware(int $id, string $partType, string $brand, string $model, int $score)
    {
        switch ($partType) {
            case 'CPU':
                return new Cpu($id, $partType, $brand, $model, $score);
                break;
            case 'GPU':
                return new Gpu($id, $partType, $brand, $model, $score);
                break;
            case 'RAM':
                return new Ram($id, $partType, $brand, $model, $score);
                break;
            case 'SSD':
                return new SSD($id, $partType, $brand, $model, $score);
                break;
            case 'HDD':
                return new HDD($id, $partType, $brand, $model, $score);
                break;
            default:
                throw new Exception('The given type is not exist!');
                break;
        }
    }
}
