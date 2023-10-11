<?php

namespace App\Http\Controllers;

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

class ModelController extends Controller
{
    public function index($brandId)
    {
        $models = FipeCarros::getModelos($brandId);
        
        return $models['modelos'];
    }
}