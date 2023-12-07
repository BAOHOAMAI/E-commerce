<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Member extends Model
{
    use HasFactory;

    function getRegister ($data) {
        DB::insert('INSERT INTO member ( name, email , password ) VALUES ( ? , ? , ? )' ,$data);
    }

}
