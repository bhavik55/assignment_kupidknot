@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Personal Detail') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('savepersonaldetail') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <lable for="name">Name</lable>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="fullname" id="fullname" value="{{ $maindata->name }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="email">Email</lable>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" value="{{ $maindata->email }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="dob">Date of Birth</lable>
                        </div>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="dob" id="dob" value="{{ empty($maindata->dob) ? '' : $maindata->dob }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="gender">Gender</lable>
                        </div>
                        <div class="col-sm-9">
                            
                            <input type="radio" class= "mx-2" name="gender" value="male" {{ $maindata->gender == 'male' ? 'checked' : '' }}> Male
                            <input type="radio" class= "mx-2" name="gender" value="female" {{ $maindata->gender == 'female' ? 'checked' : '' }}> FeMale
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-3">
                            <lable for="email">Annul Income</lable>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" value="{{ empty($maindata->income) ? '0' : $maindata->income }}" name="annualincome" id="annualincome">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="occupation">Occupation</lable>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="occupation" id="occupation">
                                <option {{ $maindata->occupation == '' ? 'selected' : ''}}>Select Occupation</option>
                                <option value="private" {{ $maindata->occupation == 'private' ? 'selected' : '' }}>Private Job</option>
                                <option value="goverment" {{ $maindata->occupation == 'goverment' ? 'selected' : '' }}>Goverment Job</option>
                                <option value="business" {{ $maindata->occupation == 'business' ? 'selected' : '' }}>Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="family">Family Type</lable>
                        </div>
                        <div class="col-sm-9">
                            <select  class="form-control" name="family" id="family">
                                <option {{ $maindata->occupation == '' ? 'selected' : ''}}>Select Family Type</option>
                                <option value="joint" {{ $maindata->family == 'joint' ? 'selected' : ''}}>Joint Faamily</option>
                                <option value="nuclear" {{ $maindata->family == 'nuclear' ? 'selected' : ''}}>Nuclear Family</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="manglik">Manglik</lable>
                        </div>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" name="manglik" id="manglik">
                                <option value="1" {{ $maindata->family == 1 ? 'selected' : ''}}>Yes</option>
                                <option value="0" {{ $maindata->family == 0 ? 'selected' : ''}}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-header">{{ __('Partner Prefernce') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <lable for="name">Expected Income</lable>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="p_expectedincome" id="p_expectedincome">
                            <div id="slider-range" class="mt-2"></div>
    
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="occupation">Occupation</lable>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" multiple name="p_occupation[]" id="p_occupation">
                                
                                <option value="private">Private Job</option>
                                <option value="goverment">Goverment Job</option>
                                <option value="business">Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="familytype">Family Type</lable>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" multiple name="p_family[]" id="p_family">
                                <option value="joint">Joint Faamily</option>
                                <option value="nuclear">Nuclear Family</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-3">
                            <lable for="manglik">Manglik</lable>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-control" name="p_manglik" id="p_manglik">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-success btn-lg float-end" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
