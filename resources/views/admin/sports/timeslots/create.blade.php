<form id="createTimeslotForm" method="POST" action="/timeslots/store">
    @csrf
    <div class="row mb-3">
        <label for="start_time" class="col-md-4 col-form-label text-md-end">Heure de début</label>
        <div class="col-md-6 d-flex">
            <input id="start_time" type="text" class="form-control" name="start_time" required>
            @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <label for="end_time" class="col-md-4 col-form-label text-md-end">Heure de fin</label>
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
            <button type="btn" class="store-btn btn btn-primary">Save</button>
        </div>
    </div>
</form>