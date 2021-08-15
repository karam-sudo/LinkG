@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('projects_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <strong class="mb-0"> {{trans('main_trans.List_position') }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.List_position') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @can('Add Position')
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">{{ trans('positions_trans.add_position') }}</a>
                    @endcan
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($Services as $Service)

                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{ $Service->Name }}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('positions_trans.Name_position') }}
                                                                    </th>
                                                                    <th>{{ trans('positions_trans.Description') }}</th>
                                                                    <th>{{ trans('positions_trans.Processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($Service->Positions as $list_Positions)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $list_Positions->Name}}</td>
                                                                        <td>{{ $list_Positions->Description}} </td>
                                                                       <td>
                                                                           @can('Edit Position')
                                                                            <a href="#"class="btn btn-info btn-sm"data-toggle="modal"data-target="#edit{{ $list_Positions->id }}"><i class="fa fa-edit"></i></a>
                                                                            @endcan

                                                                            @can('Delete Position')
                                                                            <a href="#"class="btn btn-danger btn-sm" data-toggle="modal"data-target="#delete{{ $list_Positions->id }}"><i class="fa fa-trash"></i></a>
                                                                            @endcan
                                                                
                                                                        </td>

                                                                    </tr>


                                                                    <!--تعديل قسم جديد -->
                                                                    <div class="modal fade"
                                                                         id="edit{{ $list_Positions->id }}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('positions_trans.edit_position') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form
                                                                                        action="{{ route('Positions.update', 'test') }}"
                                                                                        method="POST">
                                                                                        {{ method_field('patch') }}
                                                                                        {{ csrf_field() }}
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_ar"
                                                                                                       class="form-control"
                                                                                                       value="{{ $list_Positions->getTranslation('Name', 'ar') }}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text"
                                                                                                       name="Name_en"
                                                                                                       class="form-control"
                                                                                                       value="{{ $list_Positions->getTranslation('Name', 'en') }}">
                                                                                                <input id="id"
                                                                                                       type="hidden"
                                                                                                       name="id"
                                                                                                       class="form-control"
                                                                                                       value="{{ $list_Positions->id }}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName"
                                                                                                   class="control-label">{{ trans('positions_trans.Name_service') }}</label>
                                                                                            <select name="Service_id"
                                                                                                    class="custom-select">
                                                                                                <!--placeholder-->
                                                                                                <option
                                                                                                    value="{{ $Service->id }}">
                                                                                                    {{ $Service->Name }}
                                                                                                </option>
                                                                                                @foreach ($list_Services as $list_Service)
                                                                                                    <option
                                                                                                        value="{{ $list_Service->id }}">
                                                                                                        {{ $list_Service->Name }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>
                                                                                        
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="exampleFormControlTextarea1">{{ trans('positions_trans.description_ar') }}
                                                                                                    :</label>
                                                                                                <textarea class="form-control" name="Description_ar"
                                                                                                    id="exampleFormControlTextarea1"
                                                                                                    rows="3">{{ $list_Positions->getTranslation('Description', 'ar') }}</textarea>
                                                                                            </div>
                                                                                            <br><br>

                                                                                            <div class="form-group2">
                                                                                                <label
                                                                                                    for="exampleFormControlTextarea2">{{ trans('positions_trans.description_en') }}
                                                                                                    :</label>
                                                                                                <textarea class="form-control" name="Description_en"
                                                                                                    id="exampleFormControlTextarea2"
                                                                                                    rows="3">{{ $list_Positions->getTranslation('Description', 'en') }}</textarea>
                                                                                            </div>

                                                                                        

                                                                                            
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">{{ trans('positions_trans.Close') }}</button>
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger">{{ trans('positions_trans.submit') }}</button>
                                                                                </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- delete_modal_ -->
                                                                    <div class="modal fade"
                                                                         id="delete{{ $list_Positions->id }}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                        class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('positions_trans.delete_position') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form
                                                                                        action="{{ route('Positions.destroy', 'test') }}"
                                                                                        method="post">
                                                                                        {{ method_field('Delete') }}
                                                                                        @csrf
                                                                                        {{ trans('positions_trans.Warning_position') }}
                                                                                        <input id="id" type="hidden"
                                                                                               name="id"
                                                                                               class="form-control"
                                                                                               value="{{$list_Positions->id}}">
                                                                                        <div class="modal-footer">
                                                                                            <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">{{ trans('positions_trans.Close') }}</button>
                                                                                            <button type="submit"
                                                                                                    class="btn btn-danger">{{ trans('positions_trans.submit') }}</button>
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
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    <!--اضافة مشروع جديد -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel"
                         aria-hidden="true" >
                        <div class="modal-dialog" role="document" >
                            <div class="modal-content"  >
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                        id="exampleModalLabel">
                                        {{ trans('positions_trans.add_position') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('Positions.store') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="Name_ar" class="form-control"
                                                       placeholder="{{ trans('positions_trans.position_name_ar') }}">
                                            </div>

                                            <div class="col">
                                                <input type="text" name="Name_en" class="form-control"
                                                       placeholder="{{ trans('positions_trans.position_name_en') }}">
                                            </div>

                                        </div>
                                        <br>
                                        <div class="col">
                                            <label for="inputName"
                                                   class="control-label">{{ trans('positions_trans.Name_service') }}</label>
                                            <select name="Service_id" class="custom-select">
                                                <!--placeholder-->
                                                <option value="" selected
                                                        disabled>{{ trans('positions_trans.Select_service') }}
                                                </option>
                                                @foreach ($list_Services as $list_Service)
                                                    <option value="{{ $list_Service->id }}"> {{ $list_Service->Name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">{{ trans('positions_trans.description_ar') }}
                                                :</label>
                                            <textarea class="form-control" name="Description_ar" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                        </div>
                                        <br><br>
                                        <div class="form-group2">
                                            <label for="exampleFormControlTextarea2">{{ trans('positions_trans.description_en') }}
                                                :</label>
                                            <textarea class="form-control" name="Description_en" id="exampleFormControlTextarea2"
                                                rows="3"></textarea>
                                        </div>
                                        <br>
                                        

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('positions_trans.Close') }}</button>
                                    <button type="submit"
                                            class="btn btn-danger">{{ trans('positions_trans.submit') }}</button>
                                </div>
                                </form>
                            </div>
                        </div>
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