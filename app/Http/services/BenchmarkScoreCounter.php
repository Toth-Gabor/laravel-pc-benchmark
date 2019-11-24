<?php


namespace App\Http\services;


class BenchmarkScoreCounter
{
    /**
     * @param float $cpuScore
     * @param float $gpuScore
     * @param float $ramScore
     * @param float $storageScore
     * @return array float
     */
    public function countScores(float $cpuScore, float $gpuScore, float $ramScore, float $storageScore): array
    {
        $scoreList = array();

        $scoreList['gamer'] = (($cpuScore * 0.3) + ($gpuScore * 0.5) + ($storageScore * 0.1) + ($ramScore * 0.1));
        $scoreList['workstation'] = (($cpuScore * 0.5) + ($gpuScore * 0.1) + ($storageScore * 0.2) + ($ramScore * 0.2));
        $scoreList['desktop'] = (($cpuScore * 0.3) + ($gpuScore * 0.1) + ($storageScore * 0.3) + ($ramScore * 0.3));

        return $scoreList;
    }

    /**
     * @param array $storageList
     * @return float
     */
    public function getFastestSSDOrHDDScore(array $storageList): float
    {
        $ssdScores = array();
        $hddScores = array();
        foreach ($storageList as $key=>$value){
            $storage = get_object_vars($value);

            if ($storage['part'] == 'SSD'){
                array_push($ssdScores, $storage['score']);
            } else {
                array_push($hddScores, $storage['score']);
            }
        }
        if (!empty($ssdScores)){
            return max($ssdScores);
        } else {
            return max($hddScores);
        }

    }

}
