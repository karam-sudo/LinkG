@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    {{trans('main_trans.Services') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <strong class="mb-0"> {{trans('main_trans.Services') }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.Services') }}</li>
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
            @can('Add Services')
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('services_trans.add_service') }}
            </button>
            @endcan
            <br><br>

          <div class="table-responsive">
          <table class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('services_trans.Name')}}</th>
                    <th>{{trans('services_trans.description')}}</th>
                    <th>{{trans('services_trans.Processes')}}</th>

                </tr>
            </thead>
            <tbody>
                <?php $i=0 ?>
                @foreach ($Services as $Service)

                <tr>
                    <?php $i++; ?>
                    <td>{{$i}}</td>
                    <td>{{$Service->Name}}</td>
                    <td>{{$Service->Description}}</td>
                    <td>


                        @can('Edit Service')
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $Service->id }}"title="{{ trans('services_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                        @endcan
                        @can('Delete Service')
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"data-target="#delete{{ $Service->id }}" title="{{ trans('services_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                          @endcan

                          @can('Show Service Attachment')
                        <a href="{{route('Services.show', $Service->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-eye"></i></a>
                        @endcan
                    </td>

                </tr>
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $Service->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('services_trans.edit_service') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('Services.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                            class="mr-sm-2">{{ trans('services_trans.service_name_ar') }}
                                                            :</label>
                                                        <input id="Name" type="text" name="Name"
                                                            class="form-control"
                                                            value="{{ $Service->getTranslation('Name', 'ar') }}"
                                                            required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $Service->id }}">
                                                    </div>
                                                    <div class="col">
                                                        <label for="Name_en"
                                                            class="mr-sm-2">{{ trans('services_trans.service_name_en') }}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $Service->getTranslation('Name', 'en') }}"
                                                            name="Name_en" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('services_trans.description_ar') }}
                                                        :</label>
                                                    <textarea class="form-control" name="Description_ar"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $Service->getTranslation('Description', 'ar') }}</textarea>
                                                </div>
                                                <br><br>

                                                <div class="form-group2">
                                                    <label
                                                        for="exampleFormControlTextarea2">{{ trans('services_trans.description_en') }}
                                                        :</label>
                                                    <textarea class="form-control" name="Description_en"
                                                        id="exampleFormControlTextarea2"
                                                        rows="3">{{ $Service->getTranslation('Description', 'en') }}</textarea>
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
                            <div class="modal fade" id="delete{{ $Service->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('services_trans.delete_service') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Services.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('services_trans.Warning_service') }}
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{$Service->id }}">
                                                <input type="hidden" name="Service_name" value="{{Str::slug($Service->getTranslation('Name','en'))}}">
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
                {{ trans('services_trans.add_service') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- add_form -->
            <form action="{{ route('Services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="Name" class="mr-sm-2">{{ trans('services_trans.service_name_ar') }}
                            :</label>
                        <input id="Name" type="text" name="Name" class="form-control">
                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ trans('services_trans.service_name_en') }}
                            :</label>
                        <input type="text" class="form-control" name="Name_en">
                    </div>
                </div>
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
