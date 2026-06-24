<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $products = product::all();
        return view('backend.product.index',['items'=>$products]);

        // echo "hellow";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'name'=>'required|max:50|min:4',
            'description'=>'max:250|min:10',
            'category'=>'required',
            'price'=>'required',
            'status'=>'required',
            
        ]);

        $filename = time().'.'.$request->photo->extension();

        // dd($filename);

        $request->photo->move(public_path('images'),$filename);

        $product = new product;
       $product->name = $request->name;
       $product->category = $request->category;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->status = $request->status;
       $product->image = 'images/'.$filename;

    //    dd($subjects);

       $product->save();

       return redirect('/admin/product')->with('success', 'Successfully product Created');

    
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        //
    }
}
