<form id="createTypeForm" method="POST" action="/drinks/types/store">
    @csrf
    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">Type</label>
        <div class="col-md-6 d-flex">
            <div class="input-group">
                <input id="name" type="text" class="form-control" name="name" required>
                <button type="submit" class="btn btn-primary" style="background-color: #FFA500; border-color: #FFA500;">Enregistrer</button>
            </div>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</form>
