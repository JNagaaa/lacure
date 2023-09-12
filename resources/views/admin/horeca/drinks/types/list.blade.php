<div class="text-center m-2">
    <button id="addNewType" class="btn btn-primary d-flex justify-content-center" style="background-color: #FFA500; border-color: #FFA500; width: 100%;">Nouveau type</button>
</div>
<div id="createType">

</div>

@foreach ($drinkTypes as $drinkType)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="drinkTypeName" style="color: white;">{{ __($drinkType->name) }}</span>
        <div>
            <button type="button" id="edit-btn" class="btn btn-warning active" role="button" data-id="{{ $drinkType->id }}">Modifier</button>
            <a href="{{ url('drinks/types/delete/'.$drinkType->id) }}" class="btn btn-danger active" role="button" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce type de plat?')">Supprimer</a>
        </div>
    </li>
@endforeach
