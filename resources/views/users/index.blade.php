@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Filter</div>

                    <div class="panel-body">

                        @include('users._partials.filter')

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

                        <div class="ajax-users-list-wrapper">
                            @include('users._partials.table-list')
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="ajax-modal-wrapper"></div>
@endsection
