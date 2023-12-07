<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Models\Frontend\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addToCart(Request $request)
    {
        $idVal = $request->id;

        $data = Product::find($idVal);

        $cart = session()->get('cart' , []);

        if (isset($cart[$idVal])) {
            $cart[$idVal]['quantity']++;
        } else {
            $cart[$idVal] = [
                'id_user' => Auth::id(),
                'name' => $data ->name,
                'image' => json_decode($data->image)[0],
                'price' => $data ->price,
                'quantity' => 1,
            ];
        };

        session()->put('cart', $cart);

        return response()->json(['count'=>count(session()->get('cart')),'success'=>'Thêm vào giỏ hàng thành công']);       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateCart(Request $request)
    {
            $cart = session()->get('cart');

            if(isset($cart[$request->idUp]))
            {
                $cart[$request->idUp]['quantity']+=1;
                $total =  $cart[$request->idUp]['quantity'] *  $cart[$request->idUp]['price'];

            }

            if(isset($cart[$request->idDown]))
            {
                $cart[$request->idDown]['quantity']-=1;
                $total =  $cart[$request->idDown]['quantity'] *  $cart[$request->idDown]['price'];

                if($cart[$request->idDown]['quantity']<1)
                {
                    unset($cart[$request->idDown]);
                }
            }

            session()->put('cart', $cart);
            
            
            return $total;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function removeCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
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
