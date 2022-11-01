@extends('layouts.Edum')
@section('content')
<div class="">
    <div>
        <h2>Admins</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item">Edit</li>
    </ul>
    <div class="row">
        <form action="{{route('admin.user.update', $user->id)}}" method="post" class="w-100">
            @csrf
            @method('PUT')
        <div class="col-md-12">
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">name</label>
                            <input type="text" class="form-control" value="{{$user->name}}" name="name" id="" aria-describedby="helpId"
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
                            <input type="text" class="form-control" name="email" id="" aria-describedby="helpId"
                                placeholder="" value="{{ $user->email }}">
                                @error('email')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                        </div>
                    </div>

                    </div>
                    <div class="d-felx">
                        <button class="btn-primary btn">
                            Save
                        </button>
                        <a href="javascript::back()" class="btn">
                            Back
                        </a>
                    </div>
                </div>
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </form>
    </div>
</div><!-- end of row -->
@endsection
