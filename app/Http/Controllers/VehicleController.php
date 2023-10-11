<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

class VehicleController extends Controller
{
    public function index($brandId, $ModelId, $yearCode)
    {
        $vehicles = FipeCarros::getVeiculo($brandId, $ModelId, $yearCode);

        if (!$vehicles) {
            return response()->json([
                'error' => 'Não foi possível obter os dados do veículo.'
            ], 400);
        }
        
        return $vehicles;
    }
}