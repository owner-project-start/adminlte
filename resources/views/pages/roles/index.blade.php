@extends('layouts.master')

@section('title', 'Dashboard')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Roles</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    @can('create-roles')
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus-circle"></i> Role</a>
                    @endcan
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table table-sm table-hover table-bordered w-100" id="roles_table">
            <thead>
            @include('pages.roles.partials.field')
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
            $('#roles_table').DataTable({
                processing: false,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                pageLength: 10,
                ajax: {
                    url: '{{ route('get.roles') }}',
                    type: "GET"
                },
                columns: [
                    {data: 'name'},
                    {data: 'permissions', name: 'permissions.name'},
                    {data: 'created_at', orderable: false, searchable: false},
                    {data: 'updated_at', orderable: false, searchable: false},
                    {data: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        createdCell: function (td) {
                            $(td).attr('nowrap', true);
                        },
                        "targets": [2, 3, 4]
                    },
                ]
            });
        });
    </script>
@endpush
