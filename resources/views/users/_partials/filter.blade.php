{!! Form::open(['url' => null, 'method' => 'get','id'=>'users-list-filter', 'class' => 'form-inline']) !!}

{{ csrf_field() }}

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

<div class="form-group">
    {!! Form::submit('Search', ['class' => 'form-control btn btn-primary']) !!}
    <a href="{{ route('home') }}" class="btn btn-default">Clear</a>
</div>

{!! Form::close() !!}