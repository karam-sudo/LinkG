@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    {{trans('main_trans.Employees') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <strong class="mb-0"> {{trans('main_trans.Employees') }}</strong>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.Employees') }}</li>
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

            @can('Add Employee')
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">{{ trans('Employees_trans.Add_Employee') }}</button>
            @endcan
            <br><br>

          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('Employees_trans.name')}}</th>
                    <th>{{trans('Employees_trans.Service')}}</th>
                    <th>{{trans('Employees_trans.Positions')}}</th>
                    <th>{{trans('Employees_trans.About')}}</th>
                    <th>{{trans('services_trans.Processes')}}</th>
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach ($Employees as $Employee)
                
                <tr>
                    
                    <td>{{$loop->index+1}}</td>
                    <td>{{$Employee->Name}}</td>
                    <td>{{$Employee->services->Name}}</td>
                    <td>{{$Employee->positions->Name}}</td>
                    <td>{{$Employee->About}}</td>
                    
                    <td>
                        @can('Edit Employee')
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"data-target="#edit{{ $Employee->id }}"title="{{ trans('services_trans.Edit') }}"> <i class="fa fa-edit"></i></button>
                        @endcan
                        @can('Delete Employee')
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$Employee->id}}"title="{{ trans('services_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                        @endcan
                        @can('Show Employee Attachment')
                        <a href="{{route('Employees.show', $Employee->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-eye"></i></a>
                        @endcan
                    </td>
               
                </tr>
                            <!-- edit_modal_Grade -->
                            <div class="modal fade" id="edit{{ $Employee->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Employees_trans.edit_Employee') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{route('Employees.update','test')}}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="Name"
                                                            class="mr-sm-2">{{trans('Employees_trans.name_ar')}}
                                                            :</label>
                                                        <input id="Name" type="text" name="Name_ar"
                                                            class="form-control"
                                                            value="{{$Employee->getTranslation('Name', 'ar')}}"
                                                            required>
                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                            value="{{ $Employee->id }}">
                                                    </div>

                                                    <div class="col">
                                                        <label for="Name_en"
                                                            class="mr-sm-2">{{trans('Employees_trans.name_en')}}
                                                            :</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $Employee->getTranslation('Name', 'en') }}"
                                                            name="Name_en" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-sm-12 col-md-4">
                                                        <label for="service_id">{{trans('TeamMembers_trans.Service')}} : <span class="text-danger">*</span></label>
                                                        <select class="custom-select mr-sm-2" name="service_id">
                                                            <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                                                            @foreach($list_Services as $list_Service)
                                                            <option value="{{ $list_Service->id }}" {{$list_Service->id == $Employee->service_id ? 'selected' : ""}}>{{ $list_Service->Name }}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                               
                    
                                                    <div class="form-group col-sm-12 col-md-4">
                                                        <label for="position_id">{{trans('TeamMembers_trans.Positions')}} : <span class="text-danger">*</span></label>
                                                        <select class="custom-select mr-sm-2" name="position_id">
                                                            <option value="{{$Employee->position_id}}">{{$Employee->positions->Name}}</option>
                                                        </select>
                                                    </div>
                                                </div>




                                                <div class="form-group">
                                                    <label
                                                        for="exampleFormControlTextarea1">{{ trans('Employees_trans.About_ar') }}
                                                        :</label>
                                                    <textarea class="form-control" name="About_ar"
                                                        id="exampleFormControlTextarea1"
                                                        rows="3">{{ $Employee->getTranslation('About', 'ar') }}</textarea>
                                                </div>
                                                <br><br>

                                                <div class="form-group2">
                                                    <label
                                                        for="exampleFormControlTextarea2">{{ trans('Employees_trans.About_en') }}
                                                        :</label>
                                                    <textarea class="form-control" name="About_en"
                                                        id="exampleFormControlTextarea2"
                                                        rows="3">{{ $Employee->getTranslation('About', 'en') }}</textarea>
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
                            <div class="modal fade" id="delete{{$Employee->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('Employees_trans.delete_Employee') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('Employees.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('Employees_trans.Deleted_Employee_tilte') }}
                                                <input id="id" type="hidden" name="id" class="form-control"  value="{{$Employee->id}}">
                                                <input type="hidden" name="Employee_name" value="{{Str::slug($Employee->getTranslation('Name','en'))}}">
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
                {{ trans('Employees_trans.Add_Employee') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- add_form -->
            <form action="{{route('Employees.store')}}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="Name" class="mr-sm-2">{{ trans('Employees_trans.name_ar') }}
                            :</label>
                        <input id="Name" type="text" name="Name_ar" class="form-control">
                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ trans('Employees_trans.name_en') }}
                            :</label>
                        <input type="text" class="form-control" name="Name_en">
                    </div>
                </div>

                <div class="row">
                   
                    <div class="form-group col-sm-12 col-md-4">
                        <label for="service_id">{{trans('TeamMembers_trans.Service')}} : <span class="text-danger">*</span></label>
                        <select class="custom-select mr-sm-2" name="service_id">
                            <option selected disabled>{{trans('TeamMembers_trans.Choose')}}...</option>
                        @foreach($list_Services as $list_Service)
                            <option  value="{{ $list_Service->id }}">{{ $list_Service->Name }}</option>
                        @endforeach
                    </select>
                    </div>
               

                    <div class="form-group col-sm-12 col-md-4">
                        <label for="position_id">{{trans('TeamMembers_trans.Positions')}} : <span class="text-danger">*</span></label>
                        <select class="custom-select mr-sm-2" name="position_id">

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ trans('Employees_trans.About_ar') }}
                        :</label>
                    <textarea class="form-control" name="About_ar" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                </div>
                <br><br>
                <div class="form-group2">
                    <label for="exampleFormControlTextarea2">{{ trans('Employees_trans.About_en') }}
                        :</label>
                    <textarea class="form-control" name="About_en" id="exampleFormControlTextarea2"
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
<script>
    $(document).ready(function () {
        $('select[name="service_id"]').on('change', function () {
            var service_id = $(this).val();
            if (service_id) {
                $.ajax({
                    url: "{{ URL::to('Get_positions') }}/" + service_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="position_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="position_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            }
            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
