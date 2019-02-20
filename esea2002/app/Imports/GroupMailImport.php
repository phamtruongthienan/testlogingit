<?php

namespace App\Imports;

use App\Models\MGroupEmail;
use App\Models\MGroupEmailUser;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class GroupMailImport implements ToModel
{
    use Importable;
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function model(array $row)
    {
        return new MGroupEmailUser([
            'group_id' => $this->id,
            'email'    => $row[1],
        ]);
    }

}