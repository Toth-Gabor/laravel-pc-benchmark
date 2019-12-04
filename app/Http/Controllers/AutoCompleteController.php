<?php


namespace App\Http\Controllers;


use App\Http\repositories\HardwaresRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutoCompleteController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $hwRepo = new HardwaresRepository();
        $term = $request->get('term');
        $data = $hwRepo->search($term);
        $tempArr = [];
        foreach ($data as $hardware){
            $tempArr[] = $hardware->model;
            //$tempArr[] = '<a href=" '. route('show-score-chart', ['id'=> $hardware->id, 'avg_score' => $hardware->model]). '" class="nav-item nav-link">'. $hardware->model .'</a>';
        }
        return response()->json($tempArr);
    }

}
