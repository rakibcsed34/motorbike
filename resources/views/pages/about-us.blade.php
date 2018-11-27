@extends('layouts.site')

@section('content')
<!-- Title Page -->
    <section class="bg-title-page p-t-40 p-b-50 flex-col-c-m" style="background-image: url({{ url('frontend/images/heading-pages-06.jpg') }});">
        <h2 class="l-text2 t-center">
            About
        </h2>
    </section>

    <!-- content page -->
    <section class="bgwhite p-t-66 p-b-38">
        <div class="container">
            <div class="row">

                <div class="col-md-12 p-b-30">
                    <h3 class="m-text26 p-t-15 p-b-16">
                        Our story
                    </h3>

                    <p class="p-b-28">
                        @if(isset($about))
                            {!! $about->descriptions !!}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection