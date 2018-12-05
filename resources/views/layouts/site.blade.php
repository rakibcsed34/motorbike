<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ url('frontend/images/icons/favicon.png"') }}"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/fonts/themify/themify-icons.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/fonts/elegant-font/html-css/style.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/slick/slick.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/lightbox2/css/lightbox.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/vendor/noui/nouislider.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/main.css') }}">
<!--===============================================================================================-->
<script type="text/javascript" src="{{ url('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript">
    var base_url = '{{ url('') }}';
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
</script>
</head>
<body class="animsition">

    <!-- Header -->
    
    @include('includes.header')


        @yield('content')


    <!-- Footer -->
    @include('includes.footer')



    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-angle-double-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>



<!--===============================================================================================-->
    
<!--===============================================================================================-->
    <script type="text/javascript" src="{{ url('frontend/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{ url('frontend/vendor/bootstrap/js/popper.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script type="text/javascript" src="{{ url('frontend/vendor/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });

        $(".selection-2").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect2')
        });
    </script>

    <script type="text/javascript" src="{{ url('frontend/vendor/daterangepicker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/vendor/daterangepicker/daterangepicker.js') }}"></script>

<!--===============================================================================================-->
    <script type="text/javascript" src="{{ url('frontend/vendor/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('frontend/js/slick-custom.js') }}"></script>

<!--===============================================================================================-->
    <script type="text/javascript" src="{{ url('frontend/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script type="text/javascript">
        /*$('.block2-btn-addcart').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to cart !", "success");
                $(".header-icons-noti").html(5);
            });
        });

        $('.block2-btn-addwishlist').each(function(){
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function(){
                swal(nameProduct, "is added to wishlist !", "success");
            });
        });*/
    </script>

<!--===============================================================================================-->
<script type="text/javascript" src="{{ url('frontend/vendor/noui/nouislider.min.js') }}"></script>

    <script type="text/javascript">

        /*[ No ui ]
        ===========================================================*/
        var filterBar = document.getElementById('filter-bar');

        noUiSlider.create(filterBar, {
            start: [ 50, 200 ],
            connect: true,
            range: {
                'min': 50,
                'max': 200
            }
        });

        var skipValues = [
        document.getElementById('value-lower'),
        document.getElementById('value-upper')
        ];

        filterBar.noUiSlider.on('update', function( values, handle ) {
            skipValues[handle].innerHTML = Math.round(values[handle]) ;
        });
    </script>



    <script src="{{ url('frontend/js/main.js') }}"></script>
<!--===============================================================================================-->
    {{-- <script type="text/javascript" src="{{ url('frontend/vendor/countdowntime/countdowntime.js') }}"></script> --}}
<!--===============================================================================================-->
    {{-- <script type="text/javascript" src="{{ url('frontend/vendor/lightbox2/js/lightbox.min.js') }}"></script> --}}
</body>
</html>
