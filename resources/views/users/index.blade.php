@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Filter</div>

                    <div class="panel-body">

                        <form class="form-inline">

                            <div class="form-group">
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" aria-describedby="helpId">
                            </div>

                            <div class="form-group">
                                <label for="">Favorite Color</label>
                                <select multiple class="form-control" name="" id="">
                                    <option>Red</option>
                                    <option>Black</option>
                                    <option>Yellow</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>

                        </form>

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users List

                        <div class="pull-right">
                            Total Users: <strong>{{ $users->total() }}</strong>
                            Showing: <strong>{{ $users->count() }}</strong>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Favorite Colors</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->favoriteColors as $color)
                                            {{ $color->name }},&nbsp;
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">{{$users->links()}}</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
