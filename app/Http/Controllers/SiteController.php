<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use App\Category;
use App\Product;
use App\Slider;
use App\Cart;

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
        $data['title'] = 'Home';
        $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
        $data['sliders'] = Slider::orderBy('slider_id', 'desc')->get();
        $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->get();
        // $data['product_lists'] = Category::all();
        // dd($data['product_lists']);
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
        $data['title'] = 'About Us';
        $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
        $data['about'] = About::where('is_active', 1)->first();
        return view('pages.about-us', $data);
    }


    public function productList(Request $request)
    {
        if($request->exists('cat_id')){
            $data['title'] = 'Product List';
            $data['categories'] = Category::where('is_active', 1)->get();
            $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
            $data['post_cat_id'] = $request->cat_id;
            if($request->cat_id == 'all'){

                $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
            }else{

                $data['product_lists'] = Product::where('products.cat_id', $request->cat_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
            }
            return view('pages.product-list', $data);

        }else{            
            $data['title'] = 'Product List';
            $data['post_cat_id'] = 'all';
            $data['categories'] = Category::where('is_active', 1)->get();
            $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
            $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
            return view('pages.product-list', $data);
        }
    }

    public function productListSearch(Request $request)
    {
        $data['title'] = 'Home';
        $data['post_cat_id'] = 'all';
        $data['categories'] = Category::where('is_active', 1)->get();
        $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
        if($request->cat_id == 'all'){
            $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
        }else {
            $data['product_lists'] = Product::where('categories.cat_id', $request->cat_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
        }
        return view('pages.product-list', $data);
    }

    public function productListById($cat_id)
    {
        $data['title'] = 'Product by Category';
        $data['post_cat_id'] = 'all';
        $data['categories'] = Category::where('is_active', 1)->get();
        $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
        if($cat_id == 'all'){
            $data['product_lists'] = Product::leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
        }else {
            $data['product_lists'] = Product::where('categories.cat_id', $cat_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
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
        $data['title'] = 'Product Details';
        $data['product_list'] = Product::where('products.product_id', $product_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->first();
        $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
        $data['products'] = Product::where('products.product_id', '!=', $product_id)->leftJoin('categories', 'categories.cat_id', '=', 'products.cat_id')->paginate(6);
        
        return view('pages.product-details', $data);
    }

    public function contactUs()
    {
        // $data['about'] = About::where('is_active', 1)->first();
        $data['title'] = 'Contact Us';
        $data['carts'] = Cart::leftJoin('products', 'products.product_id', '=', 'carts.product_id')->orderBy('.carts.id', 'desc')->get();
        return view('pages.contact-us', $data);
    }


    public function addToCart(Request $request)
    {
        $inputs = array(
            'product_id' => $request->product_id,
            'quantity' => 1,
        );
        Cart::create($inputs);
        return redirect()->back();
    }

    public function viewCart()
    {
        $data['carts'] = Cart::groupBy('carts.product_id')
                        ->selectRaw('carts.id, products.product_id, products.image, products.price, SUM(quantity) AS total')
                        ->leftJoin('products', 'products.product_id', '=', 'carts.product_id')
                        ->orderBy('carts.id', 'desc')
                        ->get();
        $data['title'] = 'Cart List';
        return view('pages.cart', $data);
    }

    public function deleteCart(Request $request)
    {
        Cart::where('id', $request->cart_id)->delete();
    }

}
