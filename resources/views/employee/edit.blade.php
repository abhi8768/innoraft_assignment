@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

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
                        <a href="{{ url('/employee') }}" class="btn btn-primary"><i class="fa fa-list"></i> List</a>
                    </div>
                    <div class="card-body">

                    <form method="POST" action="{{ url('employee',$employee->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Company Name</label>
                            <div class="col-md-6">
                                <select name="comapny_id" id="comapny_id" class="form-control @error('name') is-invalid @enderror"">
                                    <option value="">-Select-</option>
                                    @foreach($company as $row)
                                    <option value="{{$row->id}}" @if($row->id == $employee->comp_id) selected @endif >{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autocomplete="first_name" autofocus value="{{ (isset($employee->first_name))?$employee->first_name:'' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" required autocomplete="last_name" autofocus value="{{ (isset($employee->last_name))?$employee->last_name:'' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" value="{{ (isset($employee->email))?$employee->email:'' }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="number" minlength="10" maxlength="10" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone" value="{{ (isset($employee->phone))?$employee->phone:'' }}">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">Update</button>
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
