<form id="createTimeslotFormHoreca" method="POST" action="/timeslots/store">
    @csrf
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">Heure de début</label>
        <div class="col-md-6 d-flex">
            <input id="start_time" type="text" class="form-control" name="start_time" required>
            @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="hidden" name="section_id" value="1">
        <div class="text-center mt-2">
            <button type="btn" class="store-btHoreca btn btn-primary">Save</button>
        </div>
    </div>
</form>