@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('TeamMembers_trans.member_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('TeamMembers_trans.member_details')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('TeamMembers_trans.member_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('TeamMembers_trans.Attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{ trans('TeamMembers_trans.name') }}</th>
                                            <td>{{ $TeamMembers->Name }}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.email') }}</th>
                                            <td>{{$TeamMembers->Email}}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.phone') }}</th>
                                            <td>{{$TeamMembers->Phone}}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.address') }}</th>
                                            <td>{{$TeamMembers->Address}}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.gender') }}</th>
                                            <td>{{$TeamMembers->genders->Name}}</td>
                                            
                                        </tr>

                                        <tr>

                                            <th scope="row">{{trans('TeamMembers_trans.Date_of_Birth')}}</th>
                                            <td>{{ $TeamMembers->Date_Birth}}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.Job_Time') }}</th>
                                            <td>{{$TeamMembers->job_times->Name}}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.Job_Type') }}</th>
                                            <td>{{ $TeamMembers->job_types->Name }}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.Service') }}</th>
                                            <td>{{$TeamMembers->services->Name}}</td>
                                            <th scope="row">{{ trans('TeamMembers_trans.Positions') }}</th>
                                            <td>{{$TeamMembers->positions->Name}}</td>
                                            
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('TeamMembers_trans.Salary')}}</th>
                                            <td>{{ $TeamMembers->salary}}</td>
                                            <th scope="row">{{trans('TeamMembers_trans.Currency')}}</th>
                                            <td>{{ $TeamMembers->currencies->Name }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('Upload_attachment')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('TeamMembers_trans.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="member_name" value="{{$TeamMembers->Name}}">
                                                        <input type="hidden" name="member_id" value="{{$TeamMembers->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('TeamMembers_trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('TeamMembers_trans.filename')}}</th>
                                                <th scope="col">{{trans('TeamMembers_trans.created_at')}}</th>
                                                <th scope="col">{{trans('TeamMembers_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($TeamMembers->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->filename}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{url('Download_member_attachment')}}/{{ $attachment->imageable->Name }}/{{$attachment->filename}}"
                                                           role="button"><i class="fas fa-download"></i>&nbsp; {{trans('TeamMembers_trans.Download')}}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $attachment->id }}"
                                                                title="{{ trans('TeamMembers_trans.Delete_attachment') }}">{{trans('TeamMembers_trans.Delete_attachment')}}
                                                        </button>

                                                    </td>
                                                </tr>
                                              @include('pages.TeamMembers.Delete_img')
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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