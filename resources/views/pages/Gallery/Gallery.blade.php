@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    {{ trans('gallery_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <strong class="mb-0"> {{ trans('gallery_trans.title_page') }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('gallery_trans.title_page') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12 mb-30">
      <div class="card card-statistics h-100">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('gallery_trans.Add') }}
            </button>

            <br><br>

          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>

                    <th>{{ trans('gallery_trans.description')}}</th>
                    <th>{{ trans('gallery_trans.Processes') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0 ?>
                @foreach ($Galleries as $Gallery)

                <tr>
                    <?php $i++; ?>
                    <td>{{$i}}</td>
                    <td>{{$Gallery->Description}}</td>
                    <td>

                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $Gallery->id }}"title="{{ trans('services_trans.Edit') }}"><i class="fa fa-edit"></i></button>

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"data-target="#delete{{ $Gallery->id }}" title="{{ trans('services_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                        <a href="{{route('Gallery.show', $Gallery->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-eye"></i></a>

                    </td>

                </tr>
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $Gallery->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('gallery_trans.edit_gallery') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('Gallery.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                    <div class="form-group">
                                                        <label
                                                        for="exampleFormControlTextarea1">{{ trans('services_trans.description_ar') }} :</label>
                                                    <textarea class="form-control" name="Description_ar"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $Gallery->getTranslation('Description', 'ar') }}</textarea>

                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $Gallery->id }}">
                                                    </div>
                                                    <div class="form-group2">
                                                        <label
                                                            for="exampleFormControlTextarea2">{{ trans('services_trans.description_en') }}
                                                            :</label>
                                                        <textarea class="form-control" name="Description_en"
                                                            id="exampleFormControlTextarea2"
                                                            rows="3">{{ $Gallery->getTranslation('Description', 'en') }}</textarea>
                                                    </div>








                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('services_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{ trans('services_trans.submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_Grade -->
                            <div class="modal fade" id="delete{{ $Gallery->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('gallery_trans.delete_gallery') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Gallery.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('services_trans.Warning_service') }}
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$Gallery->id }}">
                                                <input type="hidden" name="Gallery_desc" value="{{Str::slug($Gallery->getTranslation('Description','en'))}}">


                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('services_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('services_trans.submit') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                @endforeach
            </tbody>
         </table>
        </div>
        </div>
      </div>
    </div>
    <!-- add_modal_Grade -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('gallery_trans.Add_to_Gallery') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- add_form -->
            <form action="{{ route('Gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('services_trans.description_ar') }}
                            :</label>
                        <textarea class="form-control" name="Description_ar" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
                    <div class="form-group2">
                        <label for="exampleFormControlTextarea2">{{ trans('services_trans.description_en') }}
                            :</label>
                        <textarea class="form-control" name="Description_en" id="exampleFormControlTextarea2"
                            rows="3"></textarea>
                    </div>



             <div class="form-group col-sm-12 col-md-4">

                    <label for="academic_year">{{trans('TeamMembers_trans.Attachments')}} : <span class="text-danger">*</span></label><br>
                    <input type="file" accept="image/*" name="photos[]" multiple>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ trans('services_trans.Close') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('services_trans.submit') }}</button>
        </div>
        </form>

    </div>
</div>
</div>
</div>
@include('layouts.footer')
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
