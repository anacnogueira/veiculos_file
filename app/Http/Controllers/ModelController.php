<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;
use Illuminate\Http\Request;

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
            $models['modelos'] = array_filter($models['modelos'], function($model) use($query){
                return str_contains($model["nome"], $query);
            });
        }
        
        return $models['modelos'];
    }
}