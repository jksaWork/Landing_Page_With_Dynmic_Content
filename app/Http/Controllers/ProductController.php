<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductFile;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products  = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required',
            'description_ar' => 'required',
            'title_en' => 'required',
            'description_en' => 'required',
            'main_image' => 'required',
            'sub_images' => 'required',
        ]);
        // r $request->all();
        $title = [
            'ar' => $request->title_ar,
            'en' => $request->title_en,
        ];
        $description = [
            'ar' => $request->description_ar,
            'en' => $request->description_ar,
        ];
        // $filename = $request->main_image->getClientOriginalName();
        $name = $request->main_image->store('public/uploads', 'public');
        $product = Product::create([
            'title' => $title,
            'description' => $description,
            'image' => $name,
        ]);
        // dd($request->sub_images);
        foreach ($request->sub_images as $key => $value) {
            // dd('in side Foreach');
            $name = $value->store('public/uploads', 'public');
            ProductFile::create([
                'product_id' => $product->id,
                'image_name' => $name,
            ]);
            // dd('saved');
        }
        // dd($product->load('Iamges'));
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product = $product->load('Iamges');
        // dd($product);
        return view('products.show' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title_ar' => 'required',
            'description_ar' => 'required',
            'title_en' => 'required',
            'description_en' => 'required',
            'main_image' => 'required',
            'sub_images' => 'required',
        ]);
        // r $request->all();
        $title = [
            'ar' => $request->title_ar,
            'en' => $request->title_en,
        ];
        $description = [
            'ar' => $request->description_ar,
            'en' => $request->description_ar,
        ];
        // $filename = $request->main_image->getClientOriginalName();
        $name = $request->main_image->store('public/uploads', 'public');
        $product1 = $product->update([
            'title' => $title,
            'description' => $description,
            'image' => $name,
        ]);
        // dd($request->sub_images);
        foreach ($request->sub_images as $key => $value) {
            // dd('in side Foreach');
            $name = $value->store('public/uploads', 'public');
            ProductFile::create([
                'product_id' => $product->id,
                'image_name' => $name,
            ]);
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if( ! (request()->has('type') && request()->type == 'file') ) $product->delete();
        else ProductFile::where('id' , request()->attach_id)->delete();
        return redirect()->back();
    }
}
