<?php

namespace App\Http\Controllers;

use App\Http\services\ComputerService;
use App\Http\services\HardwareService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $compSrv = new ComputerService();

        if (!$request->session()->get('computer')) {
            return view('hardwares.index');
        } else {
            $computer = $request->session()->get('computer');
            $status = $compSrv->isCompleted($computer);
            $scores = '';
            // get scores of hardwares
            if ($status) {
                $scores = $this->countScores($request);
            }
            return view('index', ['computer' => $computer, 'status' => $status, 'scores' => $scores]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public
    function remove(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $computer = $request->session()->get('storages');

        switch ($type) {
            case 'CPU':
                $request->session()->forget('cpu');
                break;
            case 'GPU':
                $request->session()->forget('gpu');
                break;
            case 'RAM':
                $request->session()->forget('ram');
                break;
            case 'SSD':
            case 'HDD':
                for ($i = 0; $i < sizeof($computer['storages']); $i++) {
                    if ($computer['storages'][$i]->getId == $id) {
                        break;
                    }
                }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function store(Request $request)
    {
        $hwRepo = new HardwareService();
        $compSrv = new ComputerService();

        if (!$request->session()->get('computer')) {
            $request->session()->put('computer', []);
            $computer = $request->session()->get('computer');
            $computer['storages'] = [];
            $request->session()->put('computer', $computer);
        }
        $computer = $request->session()->get('computer');
        $status = $compSrv->isCompleted($computer);

        $scores = '';
        // get scores of hardwares
        if ($status) {
            $scores = $this->countScores($request);
        }


        $id = (request('id')) ? request('id') : 2;
        $hardware = $hwRepo->getHardwareById($id);
        $avg_score = request('avg_score');
        $hardware->setScore($avg_score);

        switch ($hardware->getPartType()) {
            case 'CPU':
                $computer['cpu'] = $hardware;
                $request->session()->put('computer', $computer);

                break;
            case 'GPU':
                $computer['gpu'] = $hardware;
                $request->session()->put('computer', $computer);

                break;
            case 'RAM':
                $computer['ram'] = $hardware;
                $request->session()->put('computer', $computer);

                break;
            case 'HDD':
            case 'SSD':
                if (sizeof($computer['storages']) < 5) {
                    array_push($computer['storages'], $hardware);
                    $request->session()->put('computer', $computer);

                    break;
                } else {
                    break;
                }

            default:
                throw new Exception('The hardware type is incorrect!');
        }
        return view('index', ['computer' => $computer, 'status' => $status, 'scores' => $scores]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return array
     * @throws Exception
     */
    private function countScores(Request $request): array
    {
        $compSrv = new ComputerService();
        $computer = $request->session()->get('computer');
        $cpuScore = $computer['cpu']->getScore();
        $gpuScore = $computer['gpu']->getScore();
        $ramScore = $computer['ram']->getScore();
        $storageList = $computer['storages'];
        return $compSrv->getScores($cpuScore, $gpuScore, $ramScore, $storageList);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
