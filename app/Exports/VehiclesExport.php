<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class VehiclesExport implements FromArray
{
    protected $vehicles;

    public function __construct(array $vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function array(): array
    {
        return $this->vehicles;
    }
}
