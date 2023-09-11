<button id="addNewType" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Nouveau type</button>
<div id="createType">

</div>

@foreach ($dishTypes as $dishType)
    <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: #333333;">
        <span class="dishTypeName" style="color: #FFA500;">{{ __($dishType->name) }}</span>
        <div>
            <button type="button" id="edit-btn" class="btn btn-warning active" role="button" data-id="{{ $dishType->id }}">Modifier</button>
            <a href="{{ url('dishes/types/delete/'.$dishType->id) }}" class="btn btn-danger active" role="button" onclick="return confirm('Etes-vous sûr de vouloir supprimer ce type de plat?')">Supprimer</a>
        </div>
    </li>
@endforeach
