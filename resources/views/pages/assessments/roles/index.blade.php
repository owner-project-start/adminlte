@extends('layouts.master')

@section('title', 'Roles')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            <h1 class="m-0 text-dark">Role Managements</h1>
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
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
    <div class="card b-t-green">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered w-100" id="roles_table">
                    <thead>
                    @include('pages.assessments.roles.partials.field')
                    </thead>
                </table>
            </div>
        </div>
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
            const Table = $('#roles_table').DataTable({
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
                    {data: 'code', orderable: false, searchable: false},
                    {data: 'permissions', name: 'permissions.name', orderable: false, searchable: false},
                    {data: 'created_at', orderable: false, searchable: false},
                    {data: 'updated_at', orderable: false, searchable: false},
                    {data: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        createdCell: function (td) {
                            $(td).attr('nowrap', true);
                        },
                        "targets": [0, 1, 5]
                    },
                ]
            });

            $(document).on('click', '#delete', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this imaginary file!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "DELETE",
                            url: $(this).attr('data-remote'),
                            success: function (response) {
                                if (response.code === 202) {
                                    Table.draw('page');
                                    Swal.fire(
                                        'Deleted!',
                                        'Your imaginary file has been deleted.',
                                        'success'
                                    );
                                }
                            }
                        })
                    } else {
                        Swal.fire(
                            'Cancelled',
                            'Your imaginary file is safe :)',
                            'error'
                        )
                    }
                })
            });
        });
    </script>
@endpush
