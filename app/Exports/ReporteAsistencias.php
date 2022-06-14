<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteAsistencias implements FromArray, WithHeadings
{
    protected $invoices;

    public function __construct(array $invoices)
    {
        $this->invoices = $invoices;
    }

    public function array(): array
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return [
            ['ASIGNATURA','GRUPO','LINEA','SESIONES PROGRAMADAS ','SESIONES  CALIFICADAS'
            ]
            
        ];
    }
}