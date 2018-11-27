<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::all();
        $data['categories'] = Category::where('is_active', 1)->get();
        return view('admin.product', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // form validation
        $this->validate($request, [
            'product_name' => 'required',
            'cat_id' => 'required',
            'model_number' => 'required',
            'engine' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'top_speed' => 'required',
            'mileage' => 'required',
            'price' => 'required',
            'descriptions' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        // upload image and save information
        if($request->hasFile('image')){

            $path = public_path('/uploads/product');
            if(!File::exists($path)){
                File::makeDirectory($path, $mode=0777, true, true);
            }

            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/product');
            $image->move($destinationPath, $name);

            $inputs = array(
                    'product_name' => $request->product_name,
                    'cat_id' => $request->cat_id,
                    'model_number' => $request->model_number,
                    'engine' => $request->engine,
                    'color' => $request->color,
                    'weight' => $request->weight,
                    'top_speed' => $request->top_speed,
                    'mileage' => $request->mileage,
                    'price' => $request->price,
                    'image' => $name,
                    'descriptions' => $request->descriptions
            );

            if(Product::create($inputs)){
                $request->session()->flash('alert-success', 'Data inserted successfully.');
                return redirect('product');
            }else{
                $request->session()->flash('alert-danger', 'Data inserted failed!!');
                return redirect('product');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $data['product'] = Product::where('product_id', $product_id)->first();
        $data['categories'] = Category::where('is_active', 1)->get();
        return view('admin.edit-product', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        // form validation
        $this->validate($request, [
            'product_name' => 'required',
            'cat_id' => 'required',
            'model_number' => 'required',
            'engine' => 'required',
            'color' => 'required',
            'weight' => 'required',
            'top_speed' => 'required',
            'mileage' => 'required',
            'price' => 'required',
            'descriptions' => 'required',
        ]);

        // upload image and save information
        if($request->hasFile('image')){

            $oldlink = Product::where('product_id', $request->product_id)->first();
            if(isset($oldlink)){
                unlink('uploads/product/'.$oldlink->image);                
            }

            $path = public_path('/uploads/product');
            if(!File::exists($path)){
                File::makeDirectory($path, $mode=0777, true, true);
            }

            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/product');
            $image->move($destinationPath, $name);

            $inputs = array(
                    'product_name' => $request->product_name,
                    'cat_id' => $request->cat_id,
                    'model_number' => $request->model_number,
                    'engine' => $request->engine,
                    'color' => $request->color,
                    'weight' => $request->weight,
                    'top_speed' => $request->top_speed,
                    'mileage' => $request->mileage,
                    'price' => $request->price,
                    'image' => $name,
                    'descriptions' => $request->descriptions
            );

            if(Product::where('product_id', $request->product_id)->update($inputs)){
                $request->session()->flash('alert-success', 'Data inserted successfully.');
                return redirect('product');
            }else{
                $request->session()->flash('alert-danger', 'Data inserted failed!!');
                return redirect('product');
            }
        }else{

            $inputs = array(
                    'product_name' => $request->product_name,
                    'cat_id' => $request->cat_id,
                    'model_number' => $request->model_number,
                    'engine' => $request->engine,
                    'color' => $request->color,
                    'weight' => $request->weight,
                    'top_speed' => $request->top_speed,
                    'mileage' => $request->mileage,
                    'price' => $request->price,
                    'image' => $request->product_image_old,
                    'descriptions' => $request->descriptions
            );

            if(Product::where('product_id', $request->product_id)->update($inputs)){
                $request->session()->flash('alert-success', 'Data inserted successfully.');
                return redirect('product');
            }else{
                $request->session()->flash('alert-danger', 'Data inserted failed!!');
                return redirect('product');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(Product::where('product_id', $request->product_id)->delete()){
            echo 1;
        }else {
            echo 0;
        }
    }
}
