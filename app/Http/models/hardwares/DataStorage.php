<?php


namespace App\Http\models\hardwares;


abstract class DataStorage extends Hardware
{
    public function __construct(int $id, string $partType, string $brand, string $model, int $score)
    {
        parent::__construct($id, $partType, $brand, $model, $score);
    }
}
