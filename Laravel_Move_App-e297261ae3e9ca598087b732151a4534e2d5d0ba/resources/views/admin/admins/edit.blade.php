@extends('layouts.Edum')

@section('content')

<div class="">
    <div>
        <h2>Admins</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
    <div class="row">
        <form action="{{route('admin.admin.update', $user->id)}}" method="post">
            @csrf
            @method('PUT')
        <div class="col-md-12">
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">name</label>
                            <input type="text" class="form-control" name="name" value="{{$user->name}}" id="" aria-describedby="helpId"
                                placeholder="">
                            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                            @error('name')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="text" class="form-control" name="email" value="{{$user->email}}" id="" aria-describedby="helpId"
                                placeholder="">
                                @error('email')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">password</label>
                            <input type="text" class="form-control" name="password" id="" aria-describedby="helpId"
                                placeholder="">
                                @error('password')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Roles</label>
                            <select class="form-control" name="role_id" id="" >
                                @foreach ($roles as $item)
                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                        </div>
                    </div>
                    <button class="btn-primary btn">
                        Save
                    </button>
                    <a href="javascript::back()" class="btn">
                        Back
                    </a>
                </div>
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </form>
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
        let rolesTable = $('#roles-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.admins.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email', searchable: false},
                {data: 'roles', name: 'roles', searchable: false},
                {data: 'created_at', name: 'created_at', searchable: false},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[3, 'desc']],
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
</script>

@endpush
