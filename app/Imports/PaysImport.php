<?php

namespace App\Imports;

use App\Models\Pays;
use App\Models\Ville;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PaysImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {


        foreach ($collection as $key => $row)
        {
            if($key < 231){
                Ville::create([
                    'libelle' => $row[1],
                    'fk_pays' => $row[0],
                ]);
            }
        }

    }
}
