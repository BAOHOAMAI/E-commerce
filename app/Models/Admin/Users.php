<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class User extends Model
{
    use HasFactory;
    

    public function getUser () {
        $user = DB::select('SELECT * FROM users');

        return $user;
    }


}

