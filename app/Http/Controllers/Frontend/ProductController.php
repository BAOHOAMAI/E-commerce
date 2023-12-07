<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Frontend\Product;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myproduct()
    {
         $data = Product::where('id_user',Auth::id())->get();
         return view('frontend.product.myproduct' , compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addproduct()
    {
         return view('frontend.product.addproduct');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postadd(ProductRequest $request)
    {
        $product = new Product();
        $id_user = Auth::id();
        $product->id_user = $id_user;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->sale;

        if (!$request->saleproduct) {
            $product->sale = 0 ;
        } else {
            $product->sale = $request->saleproduct;
        }

        $product->company = $request->company;

        if($request->hasfile('image'))
        {

            $data = $this->handleFile($request->file('image'));

        }

        // dd($data);

        $product->image = json_encode($data);

        if ($product->save()) {
            return redirect()->route('myproduct');
        }
    }

    public function handleFile ($data) {

        $id_user = Auth::id();

        foreach($data as $image)
        {

            $name = $image->getClientOriginalName();
            $name_2 = "hinh_85".$image->getClientOriginalName();
            $name_3 = "hinh_329".$image->getClientOriginalName();

            if (!is_dir('frontend/images/products/'.$id_user)) {
                mkdir('frontend/images/products/'.$id_user);
            }

            //$image->move('upload/product/', $name);
            $path = public_path('frontend/images/products/'.$id_user.'/'.$name);
            $path2 = public_path('frontend/images/products/'.$id_user.'/'.$name_2);
            $path3 = public_path('frontend/images/products/'.$id_user.'/'.$name_3);


            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(84, 85)->save($path2);
            Image::make($image->getRealPath())->resize(328, 378)->save($path3);
            
            $dataImage[] = $name;
        }

        return $dataImage;
    }

    /**
     * Display the specified resource.
     */
    public function getEdit($id)
    {
        $data = Product::where('id',$id)->get();

        return view('frontend.product.editproduct' , compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function postEditProduct(ProductRequest $request, $id)
    {   
        $product = Product::find($id);
        $id_user = Auth::id();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->id_category = $request->category;
        $product->id_brand = $request->brand;
        $product->status = $request->sale;
        $deleteImg = $request->checkbox;

        if (!$request->saleproduct) {
            $product->sale = 0 ;
        } else {
            $product->sale = $request->saleproduct;
        }

        $product->company = $request->company;

        $dataImg = json_decode($product->image);

        // dd($dataImg);
        if ($deleteImg) {
            foreach ($dataImg as $key => $value) {
                if (in_array($value,$deleteImg)) {
                    unset($dataImg[$key]);
                }
            }
        }

        if($request->file('image'))
        {
            if (count($request->file('image')) + count($dataImg) > 3) {
                return redirect()->back()->withErrors('Số lượng hình ảnh không được lớn hơn 3');
            } else {
                 $dataImage = $this->handleFile($request->file('image'));
                 $merge = array_merge($dataImage,$dataImg);
                // dd($merge);
                $product->image = json_encode($merge);
            } 
        } else {
             $product->image = json_encode(array_values($dataImg));
        }


        if ($product->save()) {
            return redirect()->route('myproduct');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteProduct($id)
    {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('myproduct');
    }
}
