<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FoodCategory;
use Response;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ids = \DB::table('tblfoodcategory')
            ->select('strFoodCateCode')
            ->orderBy('strFoodCateCode', 'desc')
            ->first();

        if ($ids == null) {
          $newID = $this->smartCounter("FOODCATE0000");
        }else{
          $newID = $this->smartCounter($ids->strFoodCateCode);
        }

        $foodCategories = FoodCategory::all();
        return view('maintenance/foodCategory')
          ->with('foodCategories', $foodCategories)
          ->with('newID', $newID);
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
        //
        $rules = ['category_name' => 'required | max:100',
                  'category_code' => 'required'];

        $this->validate($request, $rules);
        $foodCategory = new FoodCategory;
        $foodCategory->strFoodCateCode = $request->category_code;
        $foodCategory->strFoodCateName = $request->category_name;
        $foodCategory->txtFoodCateDesc = $request->category_description;
        $foodCategory->save();

        return redirect('foodCategory')
          ->with('alert-success', 'Food Category was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $foodCategory = FoodCategory::find($id);
        $name = $foodCategory->strFoodCateName;
        $foodCategory->delete();

        return redirect('foodCategory')->with('alert-success', 'Food Category '. $name .' was successfully deleted.');
    }

    public function foodCategory_update(Request $request)
    {
      $rules = ['category_name' => 'required | max:100'];
      $id = $request->category_code;

      $this->validate($request, $rules);
      $foodCategory = foodCategory::find($id);
      $foodCategory->strFoodCateName = $request->category_name;
      $foodCategory->txtFoodCateDesc = $request->category_description;
      $foodCategory->save();

      return redirect('foodCategory')->with('alert-success', 'Food Category ' . $id . ' was successfully updated.');
    }

    public function foodCategory_restore(Request $request)
    {
      $id = $request->category_code;
      $foodCategory = FoodCategory::onlyTrashed()->where('strFoodCateCode', '=', $id)->firstOrFail();
      $foodCategory->restore();

      return redirect('foodCategory')->with('alert-success', 'Food Category ' . $id . ' was successfully restored.');
    }
}
