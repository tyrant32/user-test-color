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
                    <div class="col-md-12 messages form-group"></div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        <a name="add_new_user" id="add_new_user" class="btn btn-success pull-right" href="#" role="button">
                            Add New User
                        </a>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="ajax-users-list-wrapper">
                    @include('users._partials.table-list')
                </div>

            </div>
        </div>
    </div>

    <div class="ajax-modal-wrapper"></div>
@endsection
