<?php


namespace App\Http\repositories;


use Illuminate\Support\Facades\DB;

class ComputerRepository
{
    private $computer;
    private $storages;

    /**
     * @param int $id
     * @return array
     */
    public function getComputerById(int $id): array
    {
        $this->computer = DB::table('computers')
            ->where('id', '=', $id)->first()->toArray();
        // add hard drives
        $this->computer['storages'] = $this->getStoragesByCompId($id);
        return $this->computer;

    }

    /**
     * @param int $compId
     * @return array
     */
    private function getStoragesByCompId(int $compId): array
    {
        $this->storages = DB::table('storages')
            ->where('pc_id', '=', $compId)->get()->toArray();
        return $this->storages;
    }
}
