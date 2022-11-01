@extends('layouts.Edum')

@section('content')

<div class="">
    <div>
        <h2>Admins</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">Admin</li>
    </ul>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="tile ">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            @if (auth()->user()->hasPermission('read_roles'))
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>
                                @lang('site.create')</a>
                            @endif @if (auth()->user()->hasPermission('delete_roles'))
                            <form method="post" action="{{ route('admin.user.bulk_delete') }}"
                                style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i
                                        class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                            @endif
                        </div>
                    </div><!-- end of row -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> search </label>
                                <input type="text" id="data-table-search" class="form-control" autofocus
                                    placeholder="@lang('site.search')">
                            </div>
                        </div>

                    </div><!-- end of row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table datatable" id="roles-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="animated-checkbox">
                                                    <label class="m-0">
                                                        <input type="checkbox" id="record__select-all">
                                                        <span class="label-text"></span>
                                                    </label>
                                                </div>
                                            </th>
                                            <th>email</th>
                                            <th>roles</th>
                                            <th>@lang('site.created_at')</th>
                                            <th>@lang('site.action')</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div><!-- end of table responsive -->
                        </div><!-- end of col -->
                    </div><!-- end of row -->
                </div><!-- end of tile -->
            </div><!-- end of col -->
        </div>
    </div><!-- end of row -->

    @endsection

    @push('scripts');
    <script src="{{ asset('admin_assets/js/custom/index.js')}}"></script>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        // alert('worgiing');

        let role;
        let rolesTable = $('#roles-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.user.data') }}',

            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'name', name: 'name' },
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[2, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            rolesTable.search(this.value).draw();
        });
        $('#roles').on('change' , function(){
            role = $(this).val();
            rolesTable.ajax.reload();
        });
    </script>

    @endpush
