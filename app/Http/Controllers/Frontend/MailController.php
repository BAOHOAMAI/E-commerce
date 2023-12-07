<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\MailNotify;
class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::User();
        $data=[
            'subject'=>'Xác nhận đơn hàng',
            'email' => $user->email,
            'name'=> $user->name,
            'phone'=> $user->phone,
        ];
        try {
            Mail::to('baohoa17112001@gmail.com')->send( new MailNotify($data));
            return response()->json(['Great check your mail box']);
        } catch(Exception $th) {
            return response()->json(['Sorry']);
        }
    }

}
