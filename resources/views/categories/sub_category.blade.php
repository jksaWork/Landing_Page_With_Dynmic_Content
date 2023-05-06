@extends('layouts.Edum')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{ __('translation.subcategories') }}</h4>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('translation.home') }}</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0);">{{ __('translation.categories') }}</a></li>
                    <li class="breadcrumb-item active"><a
                            href="javascript:void(0);">{{ __('translation.subcategories') }}</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('translation.subcategories') }}</h4>
                                <a href="#"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">+
                                    {{ __('translation.add_new') }}</a>
                            </div>
                            <div class="card-body">
                                @include('layouts.Edum.includes.sessions')
                                <div class="table-responsive">
                                    <div id="example3_wrapper" class="dataTables_wrapper no-footer">
                                        <div class="dataTables_length" id="example3_length">
                                            <div class="dropdown-menu " role="combobox">
                                                <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                                    <ul class="dropdown-menu inner show"></ul>
                                                </div>
                                            </div>
                                        </div></label>
                                    </div>
                                    {{--  --}}
                                    <table id="example3" class="display dataTable no-footer" style="min-width: 845px"
                                        role="grid" aria-describedby="example3_info">
                                        <th>
                                            <tr role="row" class="odd">
                                                <th>{{ __('translation.no') }}</th>
                                                <th>{{ __('translation.name')}}</th>
                                                <th>{{ __('translation.status') }}</th>
                                                <th>{{ __('translation.main_category') }}</th>
                                                <th>{{ __('translation.option') }}</th>
                                            </tr>
                                        </th>
                                        <tbody>
                                            @forelse ($subcategories as $key =>  $categorie)
                                            {{-- @dd($categorie) --}}
                                                <tr role="row" class="odd">
                                                    <td>{{ $key + 1 }}</td>
                                                    {{-- @dd($categorie->name) --}}
                                                    {{-- <td>{{ $categorie->name }}</td> --}}
                                                    <td>{{ $categorie->name }}</td>
                                                    <td>{!! $categorie->getStatusWithSpan() !!}</td>
                                                    <td>{{$categorie->Category->name }}</td>
                                                    <td>
                                                                <a href='{{ route('admin.subcategories.show' , ['status' => 1 ,'subcategory' => $categorie->id]) }}'
                                                                    class='btn btn-sm btn-outline-info'
                                                                    >

                                                                    {{ __('translation.change_status') }}
                                                                </a>
                                                                @if( $categorie->sub_category_count > 1)
                                                                <a href="{{ route('admin.product.show' , $categorie->id)}}" class="btn btn-sm btn-outline-info"><i
                                                                    > {{ __('translation.show_sub_category') }}
                                                                </a>
                                                                @endif
                                                                @if( $categorie->sub_category_count > 1)
                                                                <a href="{{ route('admin.product.show' , $categorie->id)}}" class="btn btn-sm btn-outline-info"><i
                                                                    > {{ __('translation.show_sub_category') }}
                                                                </a>
                                                                @endif
                                                                <form action="{{ route('admin.product.destroy', $categorie->id) }}"
                                                            method="post" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger">{{ __('translation.delete') }}</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5"></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {!! $subcategories->links()!!}
                                    <div class="dataTables_paginate paging_simple_numbers" id="example3_paginate"><a
                                            class="paginate_button previous disabled" aria-controls="example3"
                                            data-dt-idx="0" tabindex="0" id="example3_previous">Previous</a><span><a
                                                class="paginate_button current" aria-controls="example3" data-dt-idx="1"
                                                tabindex="0">1</a><a class="paginate_button " aria-controls="example3"
                                                data-dt-idx="2" tabindex="0">2</a><a class="paginate_button "
                                                aria-controls="example3" data-dt-idx="3" tabindex="0">3</a></span><a
                                            class="paginate_button next" aria-controls="example3" data-dt-idx="4"
                                            tabindex="0" id="example3_next">Next</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('translation.add_new_categery') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form action='{{ route('admin.subcategories.store') }}' method='post'>
            @csrf

            <div class="form-group">

                <label for="">{{ __('translation.main_category') }}</label>
                  <select class="form-control" name="category_id" id="">
                   @foreach($categories as $key => $cat)
                   <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
                   @endforeach
                  </select>
            </div>
            <div class="form-group">

                <label for="">{{ __('translation.name_ar') }}</label>
                <input type="text"
                  class="form-control" name="name_ar" id="" aria-describedby="helpId" placeholder="">
                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
              </div>

              <div class="form-group">
                   <label for="">{{ __('translation.name_en') }}</label>
                   <input type="text"
                     class="form-control" name="name_en" id="" aria-describedby="helpId" placeholder="">
                   {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                 </div>
             </div>
        <div class="modal-footer">
          <button type="button" type='reset' class="btn btn-secondary" data-dismiss="modal">{{ __('translation.cancel') }}</button>
          <button  class="btn btn-primary">{{ __('translation.save') }}</button>
        </div>
    </form>

    </div>
    </div>
  </div>

  {{-- Update Model  --}}

  <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('translation.edit_categery') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form action='{{ route('admin.categories.store') }}' method='post'>
            @csrf
            <div class="form-group">
                <label for="">{{ __('translation.name_ar') }}</label>
                <input type="text"
                  class="form-control" name="name_ar" id="name_ar" aria-describedby="helpId" placeholder="">
                {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
              </div>

              <div class="form-group">
                   <label for="">{{ __('translation.name_en') }}</label>
                   <input type="text"
                     class="form-control" name="name_en" id="name_en" aria-describedby="helpId" placeholder="">
                   {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                 </div>
             </div>
        <div class="modal-footer">
          <button type="button" type='reset' class="btn btn-secondary" data-dismiss="modal">{{ __('translation.cancel') }}</button>
          <button  class="btn btn-primary">{{ __('translation.update') }}</button>
        </div>
    </form>

    </div>
    </div>
  </div>
    </div>
<script>
    // do
    function fillData(id) {
        // console.log(id);
       let name_ar =  id.dataset.name_ar;
       let name_en =  id.dataset.name_en;
       document.getElementById('name_ar').value = name_ar;
       document.getElementById('name_en').value = name_en;

        // console.log(name_ar)
    }
</script>
    @endsection
