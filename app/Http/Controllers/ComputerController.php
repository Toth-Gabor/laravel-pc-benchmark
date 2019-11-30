<?php

namespace App\Http\Controllers;

use App\Http\services\HardwareService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $hwRepo = new HardwareService();
        $id = (request('id')) ? request('id') : 2;
        $computer = isset($_SESSION['computer']) ? $_SESSION['computer'] : $_SESSION['computer'] = [];
        $hardware = $hwRepo->getHardwareById($id);
        $avg_score = request('avg_score');
        $hardware->setScore($avg_score);
        switch ($hardware->getPartType()) {
            case 'CPU':
                $computer['cpu'] = $hardware;
                break;
            case 'GPU':
                $computer['gpu'] = $hardware;
                break;
            case 'RAM':
                $computer['ram'] = $hardware;
                break;
            case 'HDD':
            case 'SDD':
                $computer['storages'] = $hardware;
                break;
        }


        $testVar = 'From ComputerController index';
        return view('index', ['testVar' => $testVar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        $testVar = 'From ComputerController show';
        return view('index', ['testVar' => $testVar]);
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
