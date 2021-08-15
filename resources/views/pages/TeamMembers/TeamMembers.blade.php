@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('main_trans.list_members') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_members') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small" href="{{route('TeamMembers.create')}}" >
                        {{ trans('main_trans.add_member') }}</a>
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
                                                <div  class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        
                                                        <div  class="table-responsive mt-15">
                                                            <table   class="table center-aligned-table mb-0"
                                                                data-page-length="50"
                                                                style="text-align: center">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('TeamMembers_trans.name') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.email') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.phone') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.Job_Time') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.Job_Type') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.Service') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.Positions') }}</th>
                                                                    <th>{{ trans('TeamMembers_trans.Processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($Services->TeamMembers as $list_TeamMembers)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $list_TeamMembers->Name}}</td>
                                                                        <td>{{ $list_TeamMembers->Email}} </td>
                                                                        <td>{{ $list_TeamMembers->Phone}} </td>
                                                                        <td>{{ $list_TeamMembers->job_times->Name}} </td>
                                                                        <td>{{ $list_TeamMembers->job_types->Name}} </td>
                                                                        <td>{{ $list_TeamMembers->services->Name}} </td>
                                                                        <td>{{ $list_TeamMembers->positions->Name}} </td>
                                                                       <td>
                                                                            <a href="{{route('TeamMembers.edit',$list_TeamMembers->id)}}"
                                                                               class="btn btn-success btn-sm"
                                                                               ><i class="fa fa-edit"></i></a>

                                                                            <a href="#"class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_TeamMember{{ $list_TeamMembers->id }}"><i class="fa fa-trash"></i></a>

                                                                            <a href="{{route('TeamMembers.show',$list_TeamMembers->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-eye"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                @include('pages.TeamMembers.delete')
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
                </div>
            </div>
        </div>
        <!-- row closed -->
        @endsection
        @section('js')
            @toastr_js
            @toastr_render
         

@endsection