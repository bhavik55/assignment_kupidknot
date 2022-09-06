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

                    <div class="row">
                        <table id="userlist" class="mt-1 table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Income</th>
                                    <th>Occupation</th>
                                    <th>Family</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>DOB</th>
                                    <th>Gender</th>
                                    <th>Income</th>
                                    <th>Occupation</th>
                                    <th>Family</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
