<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::when(request()->category_id, function ($q) {
            // dd('hello');

            $q->where('id', request()->category_id);
        })->get();

        $subcategories = SubCategory::when(request()->category_id, function ($q) {
            $q->where('category_id', request()->category_id);
        })->paginate();
        return view('categories.sub_category', compact('categories', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'category_id' => 'required',
        ]);
        // dd($request->category_id);

        $data = [
            'ar' => $request->name_ar,
            'en' => $request->name_en,
        ];

        SubCategory::create([
            'name' => $data,
            'status' => 1,
            'category_id' => $request->category_id
        ]);

        $request->session()->flash('scuuess', __('translation.categor_inserted'));
        return  redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = SubCategory::find($id);
        if (request()->has('status')) {
            $categories->ChangeStatus();
            session()->flash('sccuess', __('translation.opration_sucess'));
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}