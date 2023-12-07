<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Blog;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $blogData = Blog::paginate(3);

        return view('admin.blog.blog' , compact('blogData') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getAddBlog()
    {
        return view('admin.blog.addBlog' );
    }

    /**
     * Store a newly created resource in storage.
     */
 public function addBlog(BlogRequest $request)
    {

        $blog = new BLog();

        $title = $request->title;
        $image = $request->image;
        $description = $request->description;
        $content = $request->content;

        $imageName = $image->getClientOriginalName();

        $data = [$title , $imageName , $description , $content];

        $blogData = $blog -> getAddBlog($data);

        // dd($data);

        if(!empty($image)){
            $image->move(public_path('/admin/images/blog'), $image->getClientOriginalName());
        }
        return redirect()->route('blog');
        
    }

    /**
     * Display the specified resource.
     */
    public function editBlog($id)
    {
        $blog = new Blog();

        $blogData = $blog -> getIdBlog($id);

        return view('admin.blog.editBlog' , compact('blogData'));
    }

    public function postEditBlog(BlogRequest $request , $id)
    {

        $blog = new BLog();

        $blogs = Blog::find($id);

        $title = $request->title;
        $image = $request->image;
        $description = $request->description;
        $content = $request->content;



        // dd($data);

        if(!empty($image)){
            $imageName = $image->getClientOriginalName();

            $image->move(public_path('/admin/images/blog'), $image->getClientOriginalName());
        } else {
            $imageName = $blogs->image;
        }
        $data = [$title , $imageName , $description , $content];

        $blogData = $blog -> getEditBLog($id , $data);
        
        return redirect()->route('blog');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function deleteBlog($id)
    {
        $blog = new Blog();

        $blogData = $blog -> deleteBlog($id);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
