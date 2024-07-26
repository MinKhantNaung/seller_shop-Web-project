@extends('dashboard.layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">

<!-- Start Table -->
<div class="card col-lg-10 col-12">
    <div class="card-header">
        <h5 class="card-title">Add Categories
        </h5>
    </div>
    <div class="card-body col-12 col-md-6">
        <form action="{{ route('categories.create') }}" method="POST" enctype="multipart/form-data" id="app-form">
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
                <button type="submit" name="form-submit-button" form="app-form" class="btn btn-sm btn-primary float-end px-3 ms-2">Save</button>
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-light text-dark float-end">Cancel</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
<script src="{{ asset('js/form.js') }}"></script>
<script>
    $('button[name="form-submit-button"]').on('click', function (e) {
    e.preventDefault();

    var form = $('#' + $(this).attr('form'));
    var self = $(this);
    ElementHelpers.disableElement(self);
    ElementHelpers.displayOverlay('Saving...<br/>Please wait!');

        $.ajax({
            method: form.attr('method'),
            url: form.attr('action'),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
        }).then(function (response) {

            if ('success' === response.status) {
                if (response.shouldDisplayToast === false) {
                    window.location.href = response.redirectUrl;
                } else if (response.redirectUrl) {
                    ElementHelpers.customToastr(response.msg ? response.msg : 'Successfully Saved.');
                    setTimeout(function () {
                        window.location.href = response.redirectUrl;
                    }, 2000);
                } else {
                    ElementHelpers.enableElement(self);
                    ElementHelpers.hideOverlay();
                    form[0].reset();
                    ElementHelpers.customToastr(response.msg ? response.msg : 'Successfully Saved.');
                }
            } else if ('error' === response.status) {
                ElementHelpers.customToastr(response.msg ? response.msg : 'Some error occuring.', 'error');

                ElementHelpers.enableElement(self);
                ElementHelpers.hideOverlay();
            }

        }).catch(function (err, xhr, text) {
            if (err.status === 422) {

                $(document).find('.ajax-text-danger').remove();

                for (var fieldName in err.responseJSON.errors) {

                    var refineFieldname = fieldName.split('.')[0];

                    if (typeof (err.responseJSON.errors[fieldName][0]) !== 'undefined') {
                        var fileValidationMsgWrapper = $(document).find('#' + refineFieldname).parents('div.file-selection-wrapper').siblings('div.validation-msg');
                        if (fileValidationMsgWrapper.length > 0) {
                            $('<span style="display: block;" class="text-danger ajax-text-danger">' + err.responseJSON.errors[fieldName][0] + '</span>').appendTo(fileValidationMsgWrapper);
                        } else {
                            $('<span style="display: block;" class="text-danger ajax-text-danger">' + err.responseJSON.errors[fieldName][0] + '</span>').appendTo($('[name="' + refineFieldname + '"]').parent('div'));
                        }
                    }
                }

            } else if (err.status === 500) {
                ElementHelpers.customToastr(serverErrorMsg, 'error');
            }

            ElementHelpers.enableElement(self);
            ElementHelpers.hideOverlay();

        });
    });
</script>
@endsection


