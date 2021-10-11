@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="">
                        <a href="{{ url('/employee/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
                    </div>
                    <div class="table-head">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Company Name</th>
                              <th scope="col">First Name</th>
                              <th scope="col">Last Name</th>
                              <th scope="col">Email</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(isset($employee))
                            @foreach($employee as $row)
                            <tr>
                              <td>{{ (isset($row->name))?$row->name:'' }}</td>
                              <td>{{ (isset($row->first_name))?$row->first_name:'' }}</td>
                              <td>{{ (isset($row->last_name))?$row->last_name:'' }}</td>
                              <td>{{ (isset($row->email))?$row->email:'' }}</td>
                              <td>{{ (isset($row->phone))?$row->phone:'' }}</td>
                              <td>

                                  <a href="{{ url('employee/'.$row->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
                                  <form action="{{ url('employee',$row->id) }}" method="POST">
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
