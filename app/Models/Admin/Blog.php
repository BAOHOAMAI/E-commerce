<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

    protected $table='blog';
    
    function getBlog () {

        $blog = DB::select('SELECT * FROM blog');

        return $blog;
    }

    function getAddBlog ($data) {

    DB::insert('INSERT INTO blog (title ,image , description , content) VALUES ( ? , ? , ? , ?)' , $data);

    }

    function getIdBlog ($id) {

        $blog = DB::select('SELECT * FROM blog WHERE id = ? ' , [$id]);

        return $blog;

    }

    function getEditBlog ($id, $data) {

    $data[] = $id;

    DB::update('UPDATE blog SET title = ? ,image =?, description = ? , content = ? WHERE id = ? ' , $data);

    }

    function deleteBlog ($id) {

    DB::delete('DELETE FROM blog WHERE id = ? ' , [$id]);

    }

    // SINGLE BLOG

    function getSingleBlog ($id) {

        $blog = DB::select('SELECT * FROM blog WHERE id = ?' , [$id]);

        return $blog;
    }

}
