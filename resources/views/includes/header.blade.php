<header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="wrap_header">
                <!-- Logo -->
                <a href="index.html" class="logo">
                    <img src="{{ url('frontend/images/icons/logo.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <li>
                                <a href="{{ url('/') }}">Home</a>
                            </li>

                            <li>
                                <a href="{{ url('product-list') }}">Shop</a>
                            </li>

                            <li>
                                <a href="{{ url('about-us') }}">About</a>
                            </li>

                            <li>
                                <a href="{{ url('contact-us') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Header Icon -->
                <div class="header-icons">

                    <div class="header-wrapicon2">
                        <img src="{{ asset('frontend/images/icons/icon-header-02.png') }}" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">{{ count($carts) }}</span>

                        <!-- Header cart noti -->
                        <div class="header-cart header-dropdown">
                            <ul class="header-cart-wrapitem">
                                @php $total = 0; @endphp
                                @foreach($carts as $cart)
                                @php $total += $cart->price; @endphp
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                        <img src="{{ url('uploads/product/'.$cart->image) }}" alt="IMG">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a href="#" class="header-cart-item-name">
                                            {{ $cart->product_name }}
                                        </a>

                                        <span class="header-cart-item-info">
                                            {{ $cart->price }}
                                        </span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>

                            <div class="header-cart-total">
                                Total: {{ $total }}
                            </div>

                            <div class="header-cart-buttons">
                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="{{ url('view-cart') }}" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        View Cart
                                    </a>
                                </div>

                                <div class="header-cart-wrapbtn">
                                    <!-- Button -->
                                    <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                        Check Out
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>