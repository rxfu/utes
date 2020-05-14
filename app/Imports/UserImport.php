<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'username' => $row[0],
            'password' => '123456',
            'name' => $row[1],
            'phone' => $row[2],
            'email' => $row[3],
        ]);
    }
}
