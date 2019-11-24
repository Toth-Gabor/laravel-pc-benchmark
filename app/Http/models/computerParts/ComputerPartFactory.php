<?php


namespace App\Http\models\computerParts;


use Exception;

class ComputerPartFactory
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
    public static function createPart(int $id, string $partType, string $brand, string $model, int $score)
    {
        switch ($partType) {
            case 'cpu':
                return new Cpu($id, $partType, $brand, $model, $score);
                break;
            case 'gpu':
                return new Gpu($id, $partType, $brand, $model, $score);
                break;
            case 'ram':
                return new Ram($id, $partType, $brand, $model, $score);
                break;
            case 'ssd':
                return new SSD($id, $partType, $brand, $model, $score);
                break;
            case 'hdd':
                return new HDD($id, $partType, $brand, $model, $score);
                break;
            default:
                throw new Exception('The given type is not exist!');
                break;
        }
    }
}
