<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Member;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('frontend.member.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function login()
    {
        return view('frontend.member.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $data = $request->all();

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'phone'=>$data['phone'],
            'level'=>0,

        ]);

        return redirect()->route('memberlogin');
    }

    /**
     * Display the specified resource.
     */
    public function getlogin(Request $request)
    {

        $password = $request->password;

        $loginData = [
            'email'=>$request->email,
            'password'=>$password,
            'level'=>0,
        ];

        if (Auth::attempt($loginData)) {
            return redirect()->route('account');
        } else {
            return redirect()->back()->withErrors('Login error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
      public function logout(Request $request)
    {   
        Auth::logout();
        $request->session()->flush();
        return redirect('/member/login');
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
