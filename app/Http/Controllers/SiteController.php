<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Category;
use App\Product;
use App\Slider;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sliders'] = Slider::orderBy('slider_id', 'desc')->get();
        $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        $data['categories'] = Category::where('is_active', 1)->get();
        return view('pages.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aboutUs()
    {
        $data['about'] = About::where('is_active', 1)->first();
        return view('pages.about-us', $data);
    }


    public function productList()
    {
        $data['categories'] = Category::where('is_active', 1)->get();
        $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        return view('pages.product-list', $data);
    }

    public function productListSearch(Request $request)
    {
        $data['categories'] = Category::where('is_active', 1)->get();
        if($request->cat_id == 'all'){
            $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        }else {
            $data['product_lists'] = Product::where('categories.cat_id', $request->cat_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        }
        return view('pages.product-list', $data);
    }

    public function productListById($cat_id)
    {
        $data['categories'] = Category::where('is_active', 1)->get();
        if($cat_id == 'all'){
            $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        }else {
            $data['product_lists'] = Product::where('categories.cat_id', $cat_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        }
        return view('pages.product-list', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $data['product_list'] = Product::where('products.product_id', $product_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->first();
        $data['products'] = Product::where('products.product_id', '!=', $product_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        
        return view('pages.product-details', $data);
    }

    public function contactUs()
    {
        // $data['about'] = About::where('is_active', 1)->first();
        return view('pages.contact-us');
    }

}
