<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['abouts'] = About::all();
        return view('admin.about', $data);
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
            'descriptions' => 'required',
            'is_active' => 'required'
        ]);

        $inputs = array(
            'descriptions' => $request->descriptions,
            'is_active' => $request->is_active
        );

        if(About::create($inputs)){
            $request->session()->flash('alert-success', 'Data inserted successfully.');
            return redirect('about');
        }else{
            $request->session()->flash('alert-danger', 'Data inserted failed!!');
            return redirect('about');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data['result'] = About::where('id', $request->id)->first();
        echo json_encode($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
     {
        $inputs = array(
            'descriptions' => $request->descriptions,
            'is_active' => $request->is_active
        );

        if(About::where('id', $request->id)->update($inputs)){
          $request->session()->flash('alert-success', 'Data updated successfully.');
            return redirect('about');
        }else{
            $request->session()->flash('alert-danger', 'Data updated failed!!');
            return redirect('about');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
   {
        $about = About::where('about_id', $request->id)->first();
        if($about){

            if(About::where('about_id', $request->id)->delete()){
                echo 1;
            }else {
                echo 0;
            }
        }
    }

    public function aboutStatus(Request $request)
    {
        $data['is_active'] = ($request->is_active == 1)? 0:1;
        if(About::where('id', $request->about_id)->update($data)){
            echo 1;
        }else {
            echo 0;
        }
    }

    public function checkAlreadyActivated(Request $request)
    {
        $res = About::where('is_active', 1)->get()->count();
        echo $res;
    }
}
