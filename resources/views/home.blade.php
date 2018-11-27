@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(isset($userlist))
                        @foreach($userlist as $value)
                        <p>{{ $value->name }}</p>
                        @endforeach
                        {{ $userlist->links() }}
                    @else
                    <p>No data found!!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
