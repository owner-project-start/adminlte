@extends('layouts.master')

@section('title', 'Dashboard')

@section('header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Users</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i> User</a>
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="table-responsive">
        <table class="table nowrap table-bordered table-hover w-100" id="users_table">
            <thead>
            @include('pages.users.partials.field')
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
            const Table = $('#users_table').DataTable({
                processing: false,
                serverSide: true,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                order: [[3, 'desc']],
                pageLength: 10,
                ajax: {
                    url: '{{ route('get.users') }}',
                    type: "GET"
                },
                columns: [
                    {data: 'name',},
                    {data: 'email',},
                    {data: 'roles', name: 'roles.name'},
                    {data: 'created_at', orderable: false, searchable: false},
                    {data: 'updated_at', orderable: false, searchable: false},
                    {data: 'action', orderable: false, searchable: false}
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