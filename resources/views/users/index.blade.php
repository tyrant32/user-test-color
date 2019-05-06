@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-search" aria-hidden="true"></i>&nbsp;Filter
                    </div>

                    <div class="panel-body">

                        @include('users._partials.filter')

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 messages form-group"></div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">

                        @include('users.modals.add-new-user')

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

    <script type="text/javascript">
        var usersModalAjaxUrl = '{{ route('ajax.users.modal') }}';
        var usersListAjaxUrl = '{{ route('ajax.users.list') }}';
        var usersStoreAjaxUrl = '{{ route('ajax.users.store') }}';
    </script>
@endsection
