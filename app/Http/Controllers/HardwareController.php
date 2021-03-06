<?php

namespace App\Http\Controllers;


use App\Http\services\HardwareService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HardwareController extends Controller
{

    private $hardwareSrv;

    /**
     * HardwareController constructor.
     */
    public function __construct()
    {
        $this->hardwareSrv = new HardwareService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $test = 'From hardware';
        return view('hardwares.index', ['test' => $test]);
    }

    /**
     * @return Factory|View
     */
    public function showCPUAndAvgScoreList()
    {
        $cpuAndAvgScoreList = $this->hardwareSrv->getAllCpuAndAvgScore();

        return view('hardwares.cpu', ['cpuAndAvgScoreList' => $cpuAndAvgScoreList]);
    }

    /**
     * @return Factory|View
     */
    public function showGpuAndAvgScoreList()
    {
        $gpuAndAvgScoreList = $this->hardwareSrv->getAllGpuAndAvgScore();

        return view('hardwares.gpu', ['gpuAndAvgScoreList' => $gpuAndAvgScoreList]);
    }

    /**
     * @return Factory|View
     */
    public function showRAMAndAvgScoreList()
    {
        $ramAndAvgScoreList = $this->hardwareSrv->getAllRamAndAvgScore();

        return view('hardwares.ram', ['ramAndAvgScoreList' => $ramAndAvgScoreList]);
    }

    /**
     * @return Factory|View
     */
    public function showSSDAndAvgScoreList()
    {
        $ssdAndAvgScoreList = $this->hardwareSrv->getAllSSDAndAvgScore();

        return view('hardwares.ssd', ['ssdAndAvgScoreList' => $ssdAndAvgScoreList]);
    }

    /**
     * @return Factory|View
     */
    public function showHDDAndAvgScoreList()
    {
        $hddAndAvgScoreList = $this->hardwareSrv->getAllHDDAndAvgScore();

        return view('hardwares.hdd', ['hddAndAvgScoreList' => $hddAndAvgScoreList]);
    }

    /**
     * @return Factory|View
     * @throws \Exception
     */
    public function showScoreChart()
    {
        $arr = [];
        $scoreList = [];
        $id = request('id');
        $avg_score = request('avg_score');
        $hardware = $this->hardwareSrv->getHardwareById($id);
        $tempScoreList = $this->hardwareSrv->getHardwareListById($id);
        $computerFittedWith = sizeof($tempScoreList);
        for ($i = 0; $i < sizeof($tempScoreList); $i++) {
            $tempScoreList[$i]->y = (float)$tempScoreList[$i]->y;
        }
        $groupCount = 50;
        $minScore = min($tempScoreList)->y;
        $maxScore = max($tempScoreList)->y;
        $step = ($maxScore - $minScore) / $groupCount;
        for ($i = 0; $i <= $groupCount; $i++) {
            $arr[] = (object)[
                "from" => $minScore + ($step * $i),
                "to" => $minScore + ($step * ($i + 1)),
                "count" => 0
            ];
            foreach ($tempScoreList as $value) {
                $score = $value->y;
                if (($arr[$i]->from <= $score) && ($score <= $arr[$i]->to)) {
                    $arr[$i]->count++;
                }
            }
        }
        foreach ($tempScoreList as $value) {
            $score = $value->y;
            for ($i = 0; $i <= $groupCount; $i++) {
                if (($arr[$i]->from <= $score) && ($score <= $arr[$i]->to)) {
                    $scoreList[] = ['x' => $score, 'y' => $arr[$i]->count];
                }
            }
        }
        return view('hardwares.scoreChart', ['scoreList' => $scoreList, 'hardware' => $hardware,
            'computerFittedWith' => $computerFittedWith, 'avg_score' => $avg_score]);
    }
}
