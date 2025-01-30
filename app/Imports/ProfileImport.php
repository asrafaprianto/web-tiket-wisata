<?php

namespace App\Imports;

use App\Models\Profile;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProfileImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // start from row 2
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(empty($row[0])) {
            return null;
        }

        return new Profile([{{fieldNameWithRow}}]);
    }
}
