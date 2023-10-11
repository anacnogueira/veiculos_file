<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

class BrandController extends Controller
{
    public function index()
    {
        $brands = FipeCarros::getMarcas();

        if (!$brands) {
            return response()->json([
                'error' => 'Não foi possível obter as marcas.'
            ], 400);
        }
        
        return $brands;
    }
}