<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;
use Illuminate\Http\Request;
use App\Services\Filter;

class YearController extends Controller
{
    public function index($brandId, $ModelId, Request $request)
    {
        $query = $request->input("q");

        $years = FipeCarros::getAnos($brandId, $ModelId);

        if (!$years) {
            return response()->json([
                'error' => 'Não foi possível obter os anos do modelo.'
            ], 400);
        }

        if($query) {
            $years = Filter::handler($years, $query);
        }
        
        return $years;
    }
}