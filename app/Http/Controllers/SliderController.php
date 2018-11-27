<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sliders'] = Slider::orderBy('slider_id', 'desc')->get();
        return view('admin.slider', $data);
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
            'slider_title' => 'required',
            'slider_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        // upload image and save information
        if($request->hasFile('slider_image')){

            $path = public_path('/uploads/slider');
            if(!File::exists($path)){
                File::makeDirectory($path, $mode=0777, true, true);
            }

            $image = $request->file('slider_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/slider');
            $image->move($destinationPath, $name);

            $inputs = array(
                    'slider_title' => $request->slider_title,
                    'slider_image' => $name
            );

            if(Slider::create($inputs)){
                $request->session()->flash('alert-success', 'Data inserted successfully.');
                return redirect('slider');
            }else{
                $request->session()->flash('alert-danger', 'Data inserted failed!!');
                return redirect('slider');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    //edit slider
    public function edit($slider_id)
    {
        $data['slider'] = Slider::where('slider_id', $slider_id)->first(); 
        return view('admin.edit-slider', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    //update slider
    public function update(Request $request, Slider $slider)
    {
         $inputs = array(
            'slider_title' => $request->slider_title            
        );

         // upload image and save information
        if($request->hasFile('slider_image')){

            $oldlink = Slider::where('slider_id', $request->slider_id)->first();
            if(isset($oldlink)){
                unlink('uploads/slider/'.$oldlink->slider_image);                
            }

            $path = public_path('/uploads/slider');
            if(!File::exists($path)){
                File::makeDirectory($path, $mode=0777, true, true);
            }

            $image = $request->file('slider_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/slider');
            $image->move($destinationPath, $name);

            $inputs = array(
                    'slider_title' => $request->slider_title,
                    'slider_image' => $name
            );

            if(Slider::where('slider_id', $request->slider_id)->update($inputs)){
                $request->session()->flash('alert-success', 'Data updated successfully.');
                return redirect('slider');
            }else{
                $request->session()->flash('alert-danger', 'Data updated failed!!');
                return redirect('slider');
            }
        }else{

            $inputs = array(
                    'slider_title' => $request->slider_title,
                    'slider_image' => $request->slider_image_old
            );

            if(Slider::where('slider_id', $request->slider_id)->update($inputs)){
                $request->session()->flash('alert-success', 'Data updated successfully.');
                return redirect('slider');
            }else{
                $request->session()->flash('alert-danger', 'Data updated failed!!');
                return redirect('slider');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slider = Slider::where('slider_id', $request->slider_id)->first();
        if($slider){
            File::delete('uploads/slider/'.$slider->slider_image);

            if(Slider::where('slider_id', $request->slider_id)->delete()){
                echo 1;
            }else {
                echo 0;
            }
        }
    }
}
