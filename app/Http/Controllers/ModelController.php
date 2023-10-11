<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

class ModelController extends Controller
{
    public function index($brandId)
    {
        $models = FipeCarros::getModelos($brandId);

        if (!$models) {
            return response()->json([
                'error' => 'Não foi possível obter os modelos da marca.'
            ], 400);
        }
        
        return $models['modelos'];
    }
}