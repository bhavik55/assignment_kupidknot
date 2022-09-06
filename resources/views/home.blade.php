@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-header">Match Profile (Base On Peference)</div>
                    <div class="row">
                        @foreach($maindata as $user)
                        <div class="col-sm-4  text-center">
                            <div id= "profile">{{ substr($user->name, 0, 1) }}</div>
                            <h6>{{ $user->name }}</h6>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
