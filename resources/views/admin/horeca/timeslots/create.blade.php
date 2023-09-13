<form id="createTimeslotFormHoreca" method="POST" action="/timeslots/store" style="color: #FFFFFF; padding: 20px; border-radius: 10px;">
    @csrf
    <div class="row mb-3">
        <label for="start_time" class="col-md-4 col-form-label text-md-end" style="color: white;">Heure de début</label>
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
            <button type="btn" class="store-btHoreca btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Enregistrer</button>
        </div>
    </div>
</form>
