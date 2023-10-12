<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;
use Illuminate\Http\Request;
use App\Services\Filter;

class ModelController extends Controller
{
    public function index($brandId, Request $request)
    {
        $query = $request->input("q");

        $models = FipeCarros::getModelos($brandId);

        if (!$models) {
            return response()->json([
                'error' => 'Não foi possível obter os modelos da marca.'
            ], 400);
        }

        if($query) {
            $models['modelos'] = Filter::handler($models['modelos'], $query);
        }
        
        return $models['modelos'];
    }
}