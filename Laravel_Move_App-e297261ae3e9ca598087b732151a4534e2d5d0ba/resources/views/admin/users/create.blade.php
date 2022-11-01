@extends('layouts.Edum')
@section('content')
<div class="">
    <div>
        <h2>Admins</h2>
    </div>
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">Admin</li>
        <li class="breadcrumb-item">Create</li>
    </ul>
    <div class="row">
        <form action="{{route('admin.user.store')}}" method="post" class="w-100">
            @csrf
        <div class="col-md-12">
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">name</label>
                            <input type="text" class="form-control" name="name" id="" aria-describedby="helpId"
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
                            <label for="">password confirm</label>
                            <input type="text" class="form-control" name="password_confirmation" id="" aria-describedby="helpId"
                                placeholder="">
                                @error('password_confirmation')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
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
