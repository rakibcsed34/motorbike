<?php

namespace App\Http\Controllers;

use App\Category;
use Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['categories'] = Category::paginate(2);
        $data['categories'] = Category::all();
        return view('admin.category', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'is_active' => 'required'
        ]);

        $inputs = array(
            'category_name' => $request->category_name,
            'is_active' => $request->is_active
        );

        if(Category::create($inputs)){
            $request->session()->flash('alert-success', 'Data inserted successfully.');
            return redirect('category');
        }else{
            $request->session()->flash('alert-danger', 'Data inserted failed!!');
            return redirect('category');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    //edit category
    public function edit($cat_id)
    {
      $data['category'] = Category::where('cat_id', $cat_id)->first(); 
      return view('admin.edit-category', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    //update category
    public function update(Request $request)
    {
        $inputs = array(
            'category_name' => $request->category_name,
            'is_active'     => $request->is_active
        );

        if(Category::where('cat_id', $request->cat_id)->update($inputs)){
          $request->session()->flash('alert-success', 'Data updated successfully.');
            return redirect('category');
        }else{
            $request->session()->flash('alert-danger', 'Data updated failed!!');
            return redirect('category');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Category::where('cat_id', $request->category_id)->delete()){
            echo 1;
        }else {
            echo 0;
        }
    }

    public function categoryStatus(Request $request)
    {
        $data['is_active'] = ($request->is_active == 1)? 0:1;
        if(Category::where('cat_id', $request->cat_id)->update($data)){
            echo 1;
        }else {
            echo 0;
        }
    }
}
