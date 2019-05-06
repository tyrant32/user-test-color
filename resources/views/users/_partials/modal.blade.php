<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg user-{{$user->id}}-modal-button hidden" data-toggle="modal" data-target="#modelId">
    Launch
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User: {{ $user->first_name }} {{ $user->last_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>User Favorite Colors:</h4>
                <hr>
                @forelse($user->favoriteColors as $color)
                    <span class="badge badge-primary">
                        <span style="color:{{ $color->name }}">{{ $color->name }}</span>
                    </span>
                @empty
                    --- No Colors ---
                @endforelse
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>