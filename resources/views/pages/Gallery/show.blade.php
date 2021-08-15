@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('projects_trans.Attachments')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('projects_trans.Attachments')}}
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
                                    <a class="nav-link active show " id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="true">{{trans('projects_trans.Attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane  active show" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{route('Upload_Gallery_attachment')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="Attachments">{{trans('projects_trans.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="Gallery_desc" value="{{Str::slug($Gallery->getTranslation('Description','en'))}}">
                                                        <input type="hidden" name="Gallery_id" value="{{$Gallery->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('projects_trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table id="datatable"  data-page-length="5" class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('projects_trans.filename')}}</th>
                                                <th scope="col">{{trans('projects_trans.created_at')}}</th>
                                                <th scope="col">{{trans('projects_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody >
                                                @foreach($Gallery->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle;position: relative;' >
                                                    <td>{{$loop->iteration}}</td>
                                                    <td >
                                                    <img  class="popup" data-toggle="modal" data-target=".bd-example-modal-lg"  src="{{url('/attachments/')}}/{{ Str::slug($attachment->imageable->getTranslation('Description','en')) }}/{{$attachment->filename}}" alt="Image" width="100" height="100"/>

                                                    </td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">

                                                        <button class="btn btn-info btn-sm">
                                                            <?php $Galleriesdesc=Str::slug($attachment->imageable->getTranslation('Description','en')) ?>
                                                            <a
                                                               href="{{url('Download_service_attachment')}}/{{$Galleriesdesc}}/{{$attachment->filename}}">
                                                               <i class="fa fa-cloud-download"></i>
                                                            </a>

                                                            </button>

                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{ $attachment->id }}"
                                                                title="{{ trans('projects_trans.Delete_attachment') }}"><i class="fa fa-trash"></i>
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('pages.Gallery.Delete_img')

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <!-- row closed -->

             <!-- image modal-->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <img  id="popup-img" src="">
        </div>
    </div>
    </div>

@endsection
@section('js')
<!--img model jquery-->
<script>
        $('.popup').on('click', function () {
            var src = $(this).attr('src');
            $('#popup-img').attr('src', src);

        });
</script>
@toastr_js
@toastr_render
@endsection
