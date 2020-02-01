@extends('layouts.master')

@section('title', 'Dashboard')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Permission</h1>
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">
                    @can('create-permissions')
                        <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus-circle"></i> Permission</a>
                    @endcan
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

    <div class="table-responsive">
        <table class="table nowrap table-sm table-bordered table-hover w-100" id="users_table">
            <thead>
            @include('pages.permissions.partials.field')
            </thead>
        </table>
    </div>
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
                    {data: 'updated_at', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endpush
