<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
        <div class="flex-w p-b-90">
            <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    GET IN TOUCH
                </h4>

                <div>
                    <p class="s-text7 w-size27">
                        Any questions? Let us know in store at _____________, NY 10018 or call us on +00******
                    </p>

                    <div class="flex-m p-t-30">
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-facebook"></a>
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-instagram"></a>
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-pinterest-p"></a>
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-snapchat-ghost"></a>
                        <a href="#" class="fs-18 color1 p-r-20 fa fa-youtube-play"></a>
                    </div>
                </div>
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Categories
                </h4>
                @if(isset($categories))
                @foreach($categories as $category)

                <ul>
                    <li class="p-b-9">
                        <a href="{{ url('product-search').'/'.$category->cat_id }}" class="s-text7">
                            {{ $category->category_name }}
                        </a>
                    </li>
                </ul>
                @endforeach
                @endif
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Links
                </h4>

                <ul>
                    <li class="p-b-9">
                        <a href="{{ url('/') }}" class="s-text7">
                            Home
                        </a>
                    </li>

                     <li class="p-b-9">
                        <a href="{{ url('product-list') }}" class="s-text7">
                            Shop
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="{{ url('about-us') }}" class="s-text7">
                            About
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="{{ url('contact-us') }}" class="s-text7">
                            Contact
                        </a>
                    </li>

                </ul>
            </div>

            <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
                <h4 class="s-text12 p-b-30">
                    Help
                </h4>

                <ul>
                    <li class="p-b-9">
                        <a href="#" class="s-text7">
                            Track Order
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="#" class="s-text7">
                            Returns
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="#" class="s-text7">
                            Shipping
                        </a>
                    </li>

                    <li class="p-b-9">
                        <a href="#" class="s-text7">
                            FAQs
                        </a>
                    </li>
                </ul>
            </div>

            <div class="w-size8 p-t-30 p-l-15 p-r-15 respon3">
                <h4 class="s-text12 p-b-30">
                    Newsletter
                </h4>

                <form>
                    <div class="effect1 w-size9">
                        <input class="s-text7 bg6 w-full p-b-5" type="text" name="email" placeholder="email@example.com">
                        <span class="effect1-line"></span>
                    </div>

                    <div class="w-size2 p-t-20">
                        <!-- Button -->
                        <button class="flex-c-m size2 bg4 bo-rad-23 hov1 m-text3 trans-0-4">
                            Subscribe
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="t-center p-l-15 p-r-15">
            <a href="#">
                <img class="h-size2" src="{{ url('frontend/images/icons/paypal.png') }}" alt="IMG-PAYPAL">
            </a>

            <a href="#">
                <img class="h-size2" src="{{ url('frontend/images/icons/visa.png') }}" alt="IMG-VISA">
            </a>

            <a href="#">
                <img class="h-size2" src="{{ url('frontend/images/icons/mastercard.png') }}" alt="IMG-MASTERCARD">
            </a>

            <a href="#">
                <img class="h-size2" src="{{ url('frontend/images/icons/express.png') }}" alt="IMG-EXPRESS">
            </a>

            <a href="#">
                <img class="h-size2" src="{{ url('frontend/images/icons/discover.png') }}" alt="IMG-DISCOVER">
            </a>

            <div class="t-center s-text8 p-t-20">
                Copyright © {{ Date('Y') }} All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Rakib</a>
            </div>
        </div>
    </footer>