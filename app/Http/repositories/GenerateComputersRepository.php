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

    /**
     * @var
     */
    private $onePart;

    /**
     * @param string $part
     * @param string|null $brand
     * @param string $operator
     * @return array
     */
    public function getPartData(string $part, ?string $brand = null, ?string $operator = '='): array
    {
        $query = DB::table('hardwares')
            ->select(['id', 'score'])
            //->selectRaw('score * (random() / 5 + 0.9) as new_score')
            ->where('part', '=', $part);
        if ($brand) {
            $query->where('brand', $operator, $brand);
        }

        $result = $query->get()->toArray();
        return $result;
    }

    /**
     * @return array
     */
    public function getRandomStorages(): array
    {
        $randomMaxStorageQuantity = rand(1, 5);
        $this->randomStorageList = DB::table('hardwares')
            ->select(['id'])
            ->selectRaw('score * (random() / 5 + 0.9) as new_score')
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

    /**
     * @param array $genCompList
     */
    public function insertGeneratedComputers(array $genCompList)
    {
        foreach ($genCompList as $genComp) {
            $tempStorages = array();
            $pcId = DB::table('computers')->insertGetId(['cpu' => $genComp['cpu'], 'gpu' => $genComp['gpu'], 'ram' => $genComp['ram'],
                    'cpu_score' => $genComp['cpu_score'], 'gpu_score' => $genComp['gpu_score'], 'ram_score' => $genComp['ram_score']
                ]);
            foreach ($genComp['storages'] as $value){
                $tempStorages[] = ['pc_id' => $pcId, 'storage_id' => $value->id, 'storage_score' => $value->new_score];
            }
            DB::table('storages')->insert($tempStorages);
        }
    }
}
