<button id="addNewType">Nouveau type</button>
<div id="createType">

</div>

@foreach ($drinkTypes as $drinkType)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="drinkTypeName">{{ __($drinkType->name) }}</span>
        <div>
            <button type="button" id="edit-btn" class="btn btn-warning active" role="button" data-id="{{ $drinkType->id }}">Modifier</button>
            <a href="{{ url('drinks/types/delete/'.$drinkType->id) }}" class="btn btn-danger active" role="button" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce type de boisson?')">Supprimer</a>
        </div>
    </li>
@endforeach

