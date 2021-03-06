@extends('layouts.master')

@section('title', 'Users')

@section('header')
    <div class="row mb-2">
        <div class="col-md-6 col-sm-6 col-6">
            <h1 class="m-0 text-dark">{{ trans('header.user_managements') }}</h1>
        </div>
        <div class="col-md-6 col-sm-6 col-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item">
                    @can('create-users')
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary"><i
                                class="fas fa-plus-circle"></i> {{ trans('button.add.user') }}</a>
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
                <table class="table table-sm table-bordered table-hover w-100" id="users_table">
                    <thead>
                    @include('pages.assessments.users.partials.field')
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
            const Table = $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    search: "{{ trans('label.search') }}"
                },
                lengthMenu: [
                    [50, 100, 250, 500],
                    [50, 100, 250, 500]
                ],
                pageLength: 50,
                ajax: {
                    url: '{{ route('get.users') }}',
                    type: "GET"
                },
                columns: [
                    {data: 'name',},
                    {data: 'email',},
                    {data: 'roles', name: 'roles.name', orderable: false},
                    {data: 'created_at', orderable: false, searchable: false},
                    {data: 'action', orderable: false, searchable: false}
                ],
                columnDefs: [
                    {
                        createdCell: function (td) {
                            $(td).attr('nowrap', true);
                        },
                        "targets": [3, 4]
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
