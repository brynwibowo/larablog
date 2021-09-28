<?php

namespace App\Exports;

use App\Models\Profil;
use Maatwebsite\Excel\Concerns\FromCollection;

class PersonalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Profil::all();
    }
}
