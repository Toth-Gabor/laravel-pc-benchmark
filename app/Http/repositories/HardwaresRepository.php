<?php


namespace App\Http\repositories;


use Illuminate\Support\Facades\DB;

class HardwaresRepository
{
    /**
     * @return array
     */
    public function getAllCpuAndAvgScore(): array
    {
        $cpuAndAvgScoreList = DB::select(
            'SELECT cpu_id, model, avg(cpu_score) AS avg_score
                    FROM (SELECT cpu AS cpu_id, cpu_score, h.model
                        FROM computers
	                        INNER JOIN hardwares h ON computers.cpu = h.id) list
                    GROUP BY cpu_id, model
                    ORDER BY avg_score DESC');
        return $cpuAndAvgScoreList;
    }

    /**
     * @return array
     */
    public function getAllGpuAndAvgScore(): array
    {
        $gpuAndAvgScoreList = DB::select(
            'SELECT gpu_id, model, avg(gpu_score) AS avg_score
                    FROM (SELECT gpu AS gpu_id, gpu_score, h.model
                        FROM computers
	                        INNER JOIN hardwares h ON computers.gpu = h.id) list
                    GROUP BY gpu_id, model
                    ORDER BY avg_score DESC');
        return $gpuAndAvgScoreList;
    }

    /**
     * @return array
     */
    public function getAllRamAndAvgScore(): array
    {
        $ramAndAvgScoreList = DB::select(
            'SELECT ram_id, model, avg(ram_score) AS avg_score
                    FROM (SELECT ram AS ram_id, ram_score, h.model
                        FROM computers
	                        INNER JOIN hardwares h ON computers.ram = h.id) list
                    GROUP BY ram_id, model
                    ORDER BY avg_score DESC');
        return $ramAndAvgScoreList;
    }

    /**
     * @return array
     */
    public function getAllSSDAndAvgScore(): array
    {
        $ssdAndAvgScoreList = DB::select(
            "SELECT ssd_id, model, avg(storage_score) AS avg_score
                    FROM (SELECT storage_id AS ssd_id,storage_score, h.model
                          FROM storages
                                   INNER JOIN hardwares h ON storages.storage_id = h.id
                          WHERE part = 'SSD') list
                    GROUP BY ssd_id, model
                    ORDER BY avg_score DESC;");
        return $ssdAndAvgScoreList;
    }

    /**
     * @return array
     */
    public function getAllHDDAndAvgScore(): array
    {
        $hddAndAvgScoreList = DB::select(
            "SELECT hdd_id, model, avg(storage_score) AS avg_score
                    FROM (SELECT storage_id AS hdd_id,storage_score, h.model
                          FROM storages
                                   INNER JOIN hardwares h ON storages.storage_id = h.id
                          WHERE part = 'HDD') list
                    GROUP BY hdd_id, model
                    ORDER BY avg_score DESC;");
        return $hddAndAvgScoreList;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getCpuListById(int $id): array
    {
        $sameCpuScoreList = DB::select(
            'SELECT cpu_score AS y
                    FROM computers
                    	     LEFT JOIN hardwares h ON computers.cpu = h.id
                    WHERE cpu = ?
                    ORDER BY cpu_score ;', [$id]);
        return $sameCpuScoreList;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getGpuListById(int $id): array
    {
        $sameGpuScoreList = DB::select(
            'SELECT gpu_score AS y
                    FROM computers
                    	     LEFT JOIN hardwares h ON computers.gpu = h.id
                    WHERE gpu = ?
                    ORDER BY gpu_score ;', [$id]);
        return $sameGpuScoreList;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getRamListById(int $id): array
    {
        $sameRamScoreList = DB::select(
            'SELECT ram_score AS y
                    FROM computers
                    	     LEFT JOIN hardwares h ON computers.ram = h.id
                    WHERE ram = ?
                    ORDER BY ram_score ;', [$id]);
        return $sameRamScoreList;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getStorageListById(int $id): array
    {
        $sameRamScoreList = DB::select(
            'SELECT storage_score AS y
                    FROM storages
                    	     LEFT JOIN hardwares h ON storages.storage_id = h.id
                    WHERE storage_id = ?
                    ORDER BY storage_score ;', [$id]);
        return $sameRamScoreList;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getHardwareById(int $id): array
    {
        $hardware = DB::select(
            'SELECT id, part, brand, model, score
                FROM hardwares
                WHERE id = ?;', [$id]);
        return $hardware;
    }

}
