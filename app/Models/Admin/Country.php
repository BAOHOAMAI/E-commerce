<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Country extends Model
{
    use HasFactory;

    function getCountry () {

        $country = DB::select('SELECT * FROM country');

        return $country;
    }

    function addCountry ($data) {

       DB::insert('INSERT INTO country (name) VALUES (?) ' , $data);

    }

    function deleteCountry ($id) {

       DB::delete(' DELETE FROM country WHERE id = ? ' , [$id]);

    }
}
