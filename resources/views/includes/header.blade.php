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
            </div>
        </div>
    </header>