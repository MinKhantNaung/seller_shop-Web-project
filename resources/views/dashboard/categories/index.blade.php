@extends('dashboard.layouts.app')

@section('content')
<!-- Start Table -->
<div class="card col-lg-10 col-12">
    <div class="card-header">
        <h5 class="card-title">Categories
            <a href="{{ route('categories.createPage') }}" class="btn btn-sm btn-primary float-end">+ Add Categories</a>
        </h5>
    </div>
    <div class="card-body">
        <!-- success info -->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <!-- success info -->
        <div class="col-12 grid-margin stretch-card table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>No</th>
                        <th>Categories</th>
                        <th>Publish</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                    <tr>
                        <td class="py-1">
                            <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                @csrf
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info"><i class="fa-solid fa-pen"></i></a>
                                <button onclick="return confirm('Are you sure to delete?')" type="submit" class="btn btn-sm btn-danger"><i
                                        class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $index + $categories->firstItem() }}</td>
                        <td>{{ $category->name }}
                            <input type="hidden" value="{{ $category->id }}" id="categoryId">
                        </td>
                        <td>
                            <input type="checkbox" class="toggle-two" data-on="Enabled" data-off="Disabled" @if ($category->status == 1) checked @endif>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $categories->links() }}
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
<!-- jquery -->
<script>
    $(document).ready(function () {
        $('.toggle-two').change(function () {
            let parentNode = $(this).parents('tr');
            let categoryId = parentNode.find('#categoryId').val();

            let checked = '';
            if ($(this).prop('checked')) {
                checked = 'true';
                $.ajax({
                    type: "get",
                    url: "/categories/change-status",
                    data: {'categoryId': categoryId, 'checked': checked},
                    dataType: "json",
                });
            } else {
                checked = 'false';
                $.ajax({
                    type: "get",
                    url: "/categories/change-status",
                    data: {'categoryId': categoryId, 'checked': checked},
                    dataType: "json",
                });
            }
        })
    });
</script>
@endsection
