@extends('layouts.site')

@section('content')


    <!-- Content page -->
    <section class="bgwhite p-t-55 p-b-65">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                    <div class="leftbar p-r-20 p-r-0-sm">
                        <!--  -->
                        <h4 class="m-text14 p-b-7">
                            Categories
                        </h4>

                        <ul class="p-b-54">
                            <a href="{{ url('product-search').'/all' }}" class="s-text13 active1">
                                    All Category
                                </a>
                            @if(isset($categories))
                            @foreach($categories as $category)
                            <li class="p-t-4">
                                <a href="{{ url('product-search').'/'.$category->cat_id }}" class="s-text13 active1">
                                    {{ $category->category_name }}
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                    <!--  -->
                    <div class="flex-sb-m flex-w p-b-35">
                        <div class="flex-w">
                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                @if(isset($categories))
                                    <select class="form-control" name="sorting">
                                        <option>Default Sorting</option>
                                        @foreach($categories as $category)

                                        <option value="{{ $category->cat_id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                            <div class="rs2-select2 bo4 of-hidden w-size12 m-t-5 m-b-5 m-r-10">
                                <select class="form-control" name="sorting">
                                    <option>Price</option>
                                    <option value="1">0.00 - 50000.00</option>
                                    <option value="2">50000.00 - 100000.00</option>
                                    <option value="3">100000.00 - 150000.00</option>
                                    <option value="4">150000.00 - 200000.00</option>
                                    <option value="5">200000.00+</option>

                                </select>
                            </div>

                            <input class="btn btn-primary" type="submit" name="btnSearch" value="Search">
                        </div>

                        <span class="s-text8 p-t-5 p-b-5">
                            Showing 1–12 of 16 results
                        </span>
                    </div>

                    <!-- Product -->
                    <div class="row">
                        @if(isset($product_lists))
                        @foreach($product_lists as $product_list)
                        <div class="col-sm-12 col-md-6 col-lg-4 p-b-50">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                                    <img class="img-thumbnail" src="{{url('uploads/product/'.$product_list->image)}}" alt="IMG-PRODUCT">

                                    <div class="block2-overlay trans-0-4">
                                        <a href="{{ url('product-details/'.$product_list->product_id) }}" class="block2-btn-addwishlist hov-pointer trans-0-4">
                                            <i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
                                            <i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
                                        </a>

                                        <div class="block2-btn-addcart w-size1 trans-0-4">
                                            <!-- Button -->
                                            <button class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="block2-txt p-t-20">
                                    <a href="{{ url('product-details/'.$product_list->product_id) }}" class="block2-name dis-block s-text3 p-b-5">
                                        {{ $product_list->product_name }}
                                    </a>

                                    <span class="block2-price m-text6 p-r-5">
                                        {{ $product_list->price }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    {{ $product_lists->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection