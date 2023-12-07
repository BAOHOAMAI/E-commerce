<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.account.account');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateprofile(Request $request)
    {

        $idUser = Auth::id();

        $user = User::findOrFail($idUser);

        $data = $request->all();

        $file = $request->avatar;

        // dd($data);
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password']) {
            $data['password'] =  bcrypt($data['password']);
        } else {
            $data['password'] = $user->password ;
        }

        if ($user->update($data)) {
            if(!empty($file)){
                $file->move('admin/images/users', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function myproduct()
    {
        return view('frontend.product.myproduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
