<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

class YearController extends Controller
{
    public function index($brandId, $ModelId)
    {
        $years = FipeCarros::getAnos($brandId, $ModelId);

        if (!$years) {
            return response()->json([
                'error' => 'Não foi possível obter os anos do modelo.'
            ], 400);
        }
        
        return $years;
    }
}