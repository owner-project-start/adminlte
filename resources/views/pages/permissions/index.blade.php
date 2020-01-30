@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Permission</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table nowrap table-bordered table-hover w-100" id="users_table">
                    <thead>
                    @include('pages.permissions.partials.field')
                    </thead>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#users_table').DataTable({
                processing: false,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
                ajax: {
                    url: '{{ route('get.permissions') }}',
                    type: "GET"
                },
                columns: [
                    {data: 'name'},
                    {data: 'created_at', orderable: false, searchable: false},
                    {data: 'updated_at', orderable: false, searchable: false},
                    {data: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush
