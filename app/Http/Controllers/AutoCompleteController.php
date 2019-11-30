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
    Public function liveSearch(Request $request)
    {
        $hwRepo = new HardwaresRepository();
        $term = $request->get('term');
        $autocompleteData = $hwRepo->search($term);
        return response()->json($autocompleteData);
    }

}
