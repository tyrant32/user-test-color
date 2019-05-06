<div class="add_new_user_form_wrapper">

    <div class="alert alert-info hidden" role="alert">
        <strong>Something is wrong check messages bellow.</strong>
    </div>
    <div class="alert alert-danger hidden" role="alert"></div>

    <div class="form-group">
        {!! Form::text('first_name', null, ['id' => 'first_name','placeholder' => 'First Name', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::text('last_name', null, ['id' => 'last_name','placeholder' => 'Last Name', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::email('email', null, ['id' => 'email','placeholder' => 'Email', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label for="">Favorite Colors</label>
        {!! Form::select('favorite_colors[]', $favoriteColors , null , ['multiple' => true,'class' => 'form-control']) !!}
    </div>

</div>