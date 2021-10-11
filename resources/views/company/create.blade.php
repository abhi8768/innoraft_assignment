@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><strong>{{ $error }}</strong></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        <strong> {{ Session::get('error') }} </strong>
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong> {{ Session::get('success') }} </strong>
                    </div>
                    @endif
                    <div class="">
                        <a href="{{ url('/company') }}" class="btn btn-primary"><i class="fa fa-list"></i> List</a>
                    </div>
                    <div class="card-body">

                    <form method="POST" action="{{ url('company') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="website" class="col-md-4 col-form-label text-md-right">Website</label>
                            <div class="col-md-6">
                                <input id="website" type="url" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Logo</label>
                            <div class="col-md-6">
                                <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" required autocomplete="new-logo">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
