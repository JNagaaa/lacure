<form id="createTimeslotForm" method="POST" action="/timeslots/store" style="color: #FFFFFF; padding: 20px; border-radius: 10px;">
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
        <label for="end_time" class="col-md-4 col-form-label text-md-end" style="color: white;">Heure de fin</label>
        <div class="col-md-6 d-flex">
            <input id="end_time" type="text" class="form-control" name="end_time" required>
            @error('end_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="hidden" name="section_id" value="2">
        <div class="text-center mt-2">
            <button type="btn" class="store-btn btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Enregistrer</button>
        </div>
    </div>
</form>
