<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

class BrandController extends Controller
{
    public function index()
    {
        $brands = FipeCarros::getMarcas();
        
        return $brands;
    }
}