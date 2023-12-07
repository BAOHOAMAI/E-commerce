<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Frontend\Rating;
use App\Models\Frontend\Comment;

class FE_BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $blogData = Blog::paginate(3);

        return view('frontend.blog.blog', compact('blogData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function blogsingle($id)
    {   

        $data = Blog::find($id);
        $rating = Rating::select('vote')->where('id_blog' , $id)->avg('vote');
        $next = Blog::where('id', '>', $id)->orderBy('id','asc')->first();
        $prev = Blog::where('id', '<', $id)->orderBy('id','desc')->first();
        $sao = round($rating);
        $comment = Comment::all();
        return view('frontend.blog.blogsingle', compact('data','next','prev' ,'sao','comment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function rating(Request $request, $id)
    {   
        $rate = new Rating();

        $rate->vote = $request->blogRating;
        $rate->id_blog = $request->id;
        $rate->id_user = Auth::id();

        if ($rate->save()) {
            return 'đánh giá thành công';
        } else {
            return 'đánh giá thất bại';
        }
    }

    /**
     * Display the specified resource.
     */
    public function comment(Request $request, $id)
    {
        $comment = new Comment();

        $comment->comment = $request->comment;
        $comment->id_user = Auth::id();
        $comment->id_blog = $id;
        $comment->name =  Auth::user()->name;
        $comment->avatar =  Auth::user()->avatar;

        if ($request->level) {
            $comment->level = $request->level;
        }
        
        if ($comment->save()) {
            return redirect()->route('blogsingle',$id);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
