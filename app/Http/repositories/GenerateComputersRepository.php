<?php


namespace App\Http\repositories;


use Illuminate\Support\Facades\DB;

class GenerateComputersRepository
{
    /**
     * @var array int
     */
    private $intelCPUList;

    /**
     * @var array int
     */
    private $amdCPUList;

    /**
     * @var array
     */
    private $intelCompatibleGPUList;

    /**
     * @var array
     */
    private $amdCompatibleGPUList;

    /**
     * @var array
     */
    private $ramList;

    /**
     * @var array
     */
    private $randomStorageList;

    private $onePart;


    /**
     * @return array
     */
    public function getAllIntelCPU(): array
    {
        $this->intelCPUList = DB::table('hardwares')
            ->where('part', '=', 'CPU')
            ->where('brand', '=', 'Intel')->get()->toArray();
        return $this->intelCPUList;
    }

    /**
     * @return array
     */
    public function getAllAmdCPU(): array
    {
        $this->amdCPUList = DB::table('hardwares')
            ->where('part', '=', 'CPU')
            ->where('brand', '=', 'AMD')->get()->toArray();
        return $this->amdCPUList;

    }

    /**
     * @return array
     */
    public function getAllIntelCompatibleGPU(): array
    {
        $this->intelCompatibleGPUList = DB::table('hardwares')
            ->where('part', '=', 'GPU')
            ->where('brand', '!=', 'Intel')->get()->toArray();
        return $this->intelCompatibleGPUList;
    }

    /**
     * @return array
     */
    public function getAllAmdCompatibleGPU(): array
    {
        $this->amdCompatibleGPUList = DB::table('hardwares')
            ->where('part', '=', 'GPU')
            ->where('brand', '!=', 'AMD')->get()->toArray();
        return $this->amdCompatibleGPUList;
    }

    /**
     * @return array
     */
    public function getAllRam(): array
    {
        $this->ramList = DB::table('hardwares')
            ->where('part', '=', 'RAM')->get()->toArray();
        return $this->ramList;
    }

    /**
     * @return array
     */
    public function getRandomStorages(): array
    {
        $randomMaxStorageQuantity = rand(1, 5);
        $this->randomStorageList = DB::table('hardwares')
            ->where('part', '=', 'SSD')
            ->orWhere('part', '=', 'HDD')
            ->inRandomOrder()->limit($randomMaxStorageQuantity)
            ->get()->toArray();
        return $this->randomStorageList;
    }

    /**
     * @param int $partId
     * @return array
     */
    public function getOnePartById(int $partId): array
    {
        $this->onePart = DB::table('hardwares')
            ->where('id', '=', $partId)->get()->toArray();
        return $this->onePart;
    }

}
