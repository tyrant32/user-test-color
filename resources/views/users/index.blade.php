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

                <div class="row">
                    <div class="col-md-12 messages"></div>
                </div>

                <div class="ajax-users-list-wrapper">
                    @include('users._partials.table-list')
                </div>

            </div>
        </div>
    </div>

    <div class="ajax-modal-wrapper"></div>
@endsection
