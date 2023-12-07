<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Country;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = new Country();

        $countryData = $country -> getCountry();

        return view('admin.user.user' , compact('countryData'));
    }

    /**
     * Show the form for creating a new resource.
     */
      public function logout()
    {   
        Auth::logout();
        return redirect('/login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateProfile(ProfileRequest $request)
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
