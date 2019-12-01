<?php

namespace App\Http\Controllers;

use App\Http\repositories\ComputerService;
use App\Http\services\HardwareService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        if (!$request->session()->get('computer')) {
            return view('hardwares.index');
        } else {
            return view('index', ['computer' => $request->session()->get('computer')]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        //$request->session()->put('storages', []);
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

        // get scores of hardwares
        $cpuScore = $computer['cpu']->getScore() ? $computer['cpu']->getScore() : null;
        $gpuScore = $computer['gpu']->getScore() ? $computer['gpu']->getScore() : null;
        $ramScore = $computer['ram']->getScore() ? $computer['ram']->getScore() : null;
        $storages = sizeof($computer['storages']) > 0 ? $computer['storages']: null;
        $scores = $compSrv->getScores($cpuScore, $gpuScore, $ramScore, $storages);

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
                if (sizeof($computer['storages']) < 5){
                    array_push($computer['storages'], $hardware);
                    $request->session()->put('computer', $computer);
                    break;
                } else {
                    break;
                }

            default:
                throw new Exception('The hardware type is incorrect!');
        }
        return view('index', ['computer' => $request->session()->get('computer'),
                                     'scores' => $scores]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function show(Request $request)
    {

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
