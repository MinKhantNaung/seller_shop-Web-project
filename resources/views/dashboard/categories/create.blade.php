@extends('dashboard.layouts.app')

@section('content')
<!-- Start Table -->
<div class="card col-lg-10 col-12">
    <div class="card-header">
        <h5 class="card-title">Add Categories
        </h5>
    </div>
    <div class="card-body col-12 col-md-6">
        <form action="{{ route('categories.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name">Category*</label>
                <input type="text" name="name" id="name" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Input Name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image">Category Photo*</label> <br>
                <small class="text-muted">Recommended Size 400 x 200</small>
                <input type="file" name="image" id="image" class="form-control mt-2 @error('image') is-invalid @enderror" required>
                @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label>Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" id="status">
                    <label class="form-check-label user-select-none ms-0" for="status">
                      Publish
                    </label>
                  </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-sm btn-primary float-end px-3 ms-2">Save</button>
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-light text-dark float-end">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection


