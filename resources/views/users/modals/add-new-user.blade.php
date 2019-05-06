<!-- Button trigger modal -->
<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add_new_user">
    Add New User
</button>

<!-- Modal -->
<div class="modal fade" id="add_new_user" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['route' => 'ajax.users.store', 'method' => 'post','id' => 'add_new_user_form']) !!}

            <div class="modal-header">
                <h5 class="modal-title">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('users._partials.form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>