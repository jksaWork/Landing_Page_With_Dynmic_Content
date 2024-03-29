@extends('layouts.Edum')
@section('content')
    <div>
        <h2>@lang('translation.settings')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('translation.home')</a></li>
        <li class="breadcrumb-item">@lang('translation.general_settings')</li>
    </ul>
<div class="card p-5">
    <div class="row">
        <div class="col-md-12">
            <div class="tile ">
                <form method="post" action="{{ route('admin.setting.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    {{--logo--}}
                    <div class="form-group">
                        <label>@lang('translation.logo_ar')</label>
                        <input type="file" name="logo_ar" class="form-control load-image">
                        <img src="{{ Storage::url('uploads/' . setting('logo_ar')) }}" class="loaded-image" alt="" style="display: {{ setting('logo') ? 'block' : 'none' }}; width: 100px; margin: 10px 0;">
                    </div>

                    <div class="form-group">
                        <label>@lang('translation.logo_en')</label>
                        <input type="file" name="logo_en" class="form-control load-image">
                        <img src="{{ Storage::url('uploads/' . setting('logo_en')) }}" class="loaded-image" alt="" style="display: {{ setting('logo') ? 'block' : 'none' }}; width: 100px; margin: 10px 0;">
                    </div>
                    {{--fav_icon--}}
                    <div class="form-group">
                        <label>@lang('translation.fav_icon')</label>
                        <input type="file" name="fav_icon" class="form-control load-image">
                        <img src="{{ Storage::url('uploads/' . setting('fav_icon')) }}" class="loaded-image" alt="" style="display: {{ setting('fav_icon') ? 'block' : 'none' }}; width: 50px; margin: 10px 0;">
                    </div>
                    {{--title--}}
                    <div class="form-group">
                        <label>@lang('translation.title')</label>
                        <input type="text" name="title" class="form-control" value="{{ setting('title') }}">
                    </div>
                    {{--description--}}
                    <div class="form-group">
                        <label>@lang('translation.description')</label>
                        <textarea name="description" class="form-control">{{ setting('description') }}</textarea>
                    </div>
                    {{--submit--}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('translation.update')</button>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
@endsection
@push('scripts')
    <script>
        $(function(){
            $('input[name="logo"]').on('change' ,function(e){
                // alert('jksa');
                let that = $(this);
                reader = new FileReader();
                reader.onload = function(){
                    console.log(reader.result);
                    that.parent().find('.loaded-image').attr('src' , reader.result);
                    that.parent().find('.loaded-image').css('display' , 'block');
                }
                // console.log(e.target.files[0]);
                // that.parent().find('.loaded-image').attr('src' , e.target.files[0]);
                reader.readAsDataURL(e.target.files[0]);
                // that.parent().find('.loaded-image').attr('src' , e.target.files[0]);

                // reader.onlaod();
            });

            $('input[name="fav_icon"]').on('change' ,function(e){
                // alert('jksa');
                let that = $(this);
                reader = new FileReader();
                reader.onload = function(){
                    console.log(reader.result);
                    that.parent().find('.loaded-image').attr('src' , reader.result);
                    that.parent().find('.loaded-image').css('display' , 'block');
                }
                // console.log(e.target.files[0]);
                // that.parent().find('.loaded-image').attr('src' , e.target.files[0]);
                reader.readAsDataURL(e.target.files[0]);
                // that.parent().find('.loaded-image').attr('src' , e.target.files[0]);

                // reader.onlaod();
            });
        })
    </script>
@endpush
