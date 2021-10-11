@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="">
                        <a href="{{ url('/company/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    </div>
                    <div class="table-head">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Logo</th>
                              <th scope="col">Company Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Website</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(isset($company) && count($company)>0)
                            @foreach($company as $row)
                            <tr>
                              <td>
                                <?php
                                $imgpath = storage_path('app/public/company_logo/'.$row->logo);
                                ?>
                                @if(!file_exists($imgpath))
                                <img src="{{ URL::asset('frontend/image/default.png') }}" width="50px" height="50px" alt="logo">                                  
                                @else                                
                                <img src="{{ env('APP_URL').'storage/app/public/company_logo/'.$row->logo }}" width="50px" height="50px" alt="logo">
                                @endif
                              </td>
                              <td>{{ (isset($row->name))?$row->name:'' }}</td>
                              <td>{{ (isset($row->email))?$row->email:'' }}</td>
                              <td>{{ (isset($row->website))?$row->website:'' }}</td>
                              <td>

                                  <a href="{{ url('company/'.$row->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
                                  <form action="{{ url('company',$row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                                  </form>
                                  
                              </td>
                            </tr>
                            @endforeach
                            @endif
                          </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
