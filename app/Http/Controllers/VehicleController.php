<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;
use Illuminate\Http\Request;
use App\Exports\VehiclesExport;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportXlsx(Request $request)
    {
        $content = $request->input("content");

        $export = new VehiclesExport([
           $content
        ]);

        return Excel::download($export, 'vehicles.xlsx');
    }
}