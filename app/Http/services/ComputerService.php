<?php


namespace App\Http\repositories;


use App\Computer;
use App\Http\models\hardwares\Cpu;
use App\Http\models\hardwares\Gpu;
use App\Http\models\hardwares\Ram;

class ComputerService
{
    private $compRepo;

    /**
     * ComputerService constructor.
     * @param $compRepo
     */
    public function __construct($compRepo)
    {
        $this->compRepo = new ComputerRepository();
    }

    /**
     * @param int $id
     * @return Computer
     */
    public function getComputerById(int $id): Computer
    {
        /*$compHwArray = $this->compRepo->getComputerById($id);
        return new Computer($id, new Cpu(), new Gpu(), new Ram(), $comp
        HwArray['storages'], );*/


    }

    /**
     * @param array $storages
     * @return array SSD|HDD
     */
    private function getStorages(array $storages): array
    {

    }


}
