<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;
use Illuminate\Http\Request;
use App\Services\Filter;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        
        $query = $request->input("q");
        
        
        $brands = FipeCarros::getMarcas();

        if (!$brands) {
            return response()->json([
                'error' => 'Não foi possível obter as marcas.'
            ], 400);
        }

        if($query) {
            $brands = Filter::handler($brands, $query);            
        }       
        
        return $brands;
    }
}