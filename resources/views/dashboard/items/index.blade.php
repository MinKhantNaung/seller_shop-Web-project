@extends('dashboard.layouts.app')

@section('content')
<!-- Start Table -->
<div class="card col-lg-10 col-12">
    <div class="card-header">
        <h5 class="card-title">Items List
            <a href="{{ route('items.createPage') }}" class="btn btn-sm btn-primary float-end">+ Add Items</a>
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
                        <th>Item</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Owner</th>
                        <th>Publish</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                    <tr>
                        <td class="py-1">
                            <form action="{{ route('items.delete', $item->id) }}" method="POST">
                                @csrf
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-info"><i
                                        class="fa-solid fa-pen"></i></a>
                                <button onclick="return confirm('Are you sure to delete?')" type="submit"
                                    class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $index + $items->firstItem() }}</td>
                        <td>{{ $item->name }}
                            <input type="hidden" value="{{ $item->id }}" id="itemId">
                        </td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>${{ $item->price }}</td>
                        <td>{{ $item->owner_name }}</td>
                        <td>
                            <input type="checkbox" class="toggle-two" data-on="Enabled" data-off="Disabled"
                                @if($item->is_publish == 1) checked @endif>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $items->links() }}
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
            let itemId = parentNode.find('#itemId').val();

            let checked = '';
            if ($(this).prop('checked')) {
                checked = 'true';
                $.ajax({
                    type: "get",
                    url: "/items/change-status",
                    data: { 'itemId': itemId, 'checked': checked },
                    dataType: "json",
                });
            } else {
                checked = 'false';
                $.ajax({
                    type: "get",
                    url: "/items/change-status",
                    data: { 'itemId': itemId, 'checked': checked },
                    dataType: "json",
                });
            }
        })
    });
</script>
@endsection
