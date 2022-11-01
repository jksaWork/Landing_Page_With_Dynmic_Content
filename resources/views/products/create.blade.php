@extends('layouts.Edum')
@section('content')
<div class="container-fluid">
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
                <h4>{{ __('translation.Products') }}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">{{ __('translation.home') }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);">{{ __('translation.Products') }}</a></li>
                <li class="breadcrumb-item active"><a
                        href="javascript:void(0);">{{ __('translation.all_products') }}</a></li>
            </ol>
        </div>
    </div>



    <div class="row">
        <div class="col-lg-12">
            <div class="row tab-content">
                <div id="list-view" class="tab-pane fade active show col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Product  </h4>
                            <a href="{{ route('admin.product.index')}}" class="btn btn-primary">Go Back</a>
                        </div>
                        <div class="card-body">
                                <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                                            {{-- <div> --}}
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">{{__('translation.title_ar')}}</label>
                                                            <input type="text"
                                                            class="form-control" name="title_ar" id="" aria-describedby="helpId" placeholder="">
                                                            @error('title_ar')
                                                            <span class="danger-text" style='color:red'">
                                                                {{$message}}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{__('translation.description_ar')}}</label>
                                                            <textarea type="text"
                                                            class="form-control" name="description_ar" id="" aria-describedby="helpId" placeholder=""></textarea>
                                                            @error('description_ar')
                                                            <span class="danger-text" style='color:red'">
                                                                {{$message}}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">{{__('translation.title_en')}}</label>
                                                            <input type="text"
                                                            class="form-control" name="title_en" id="" aria-describedby="helpId" placeholder="">
                                                            @error('title_ar')
                                                            <span class="danger-text" style='color:red'">
                                                                {{$message}}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">{{__('translation.description_en')}}</label>
                                                            <textarea type="text"
                                                            class="form-control" name="description_en" id="" aria-describedby="helpId" placeholder=""></textarea>
                                                            @error('description_en')
                                                            <span class="danger-text" style='color:red'">
                                                                {{$message}}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="">{{__('translation.main_image')}}</label>
                                                        <input type="file"
                                                        class="form-control" name="main_image" id="" aria-describedby="helpId" placeholder="">
                                                        @error('main_image')
                                                        <span class="danger-text" style='color:red'">
                                                            {{$message}}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="">{{__('translation.sub_images')}}</label>
                                                        <input type="file" multiple
                                                        class="form-control" name="sub_images[]" id="" aria-describedby="helpId" placeholder="">
                                                        @error('sub_images')
                                                        <span class="danger-text" style='color:red'">
                                                            {{$message}}
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row p-3">
                                                    <button class='btn btn-primary '> Save</button>
                                                    <button class='btn btn-outline-danger mx-3'> cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
