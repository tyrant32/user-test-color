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