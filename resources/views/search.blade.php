@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Form Search</div>
                    <div class="card-body">
                        <form action="{{ route('form.search') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">User ID</label>
                                <input type="text" class="form-control" id="user_id" name="user_id">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="role_name">Role Name</label>
                                <input type="text" class="form-control" id="role_name" name="role_name">
                            </div>
                            <button type="submit" class="btn btn-outline-danger">Search</button>
                        </form>
                    </div>
                </div>
                @if(isset($users))
                    <div class="card mt-3">
                        <div class="card-header">Result</div>
                        <div class="card-body">
                            @if(count($users) > 0)
                                <table class="table table-dark">
                                    <thead>
                                    <tr>
                                        <td>User ID</td>
                                        <td>Name</td>
                                        <td>Phone</td>
                                        <td>Role</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phone->number }}</td>
                                                <td>
                                                    @foreach($user->roles as $role)
                                                        {{ $role->name.', ' }}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h3 class="text-danger text-center">No Data</h3>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
