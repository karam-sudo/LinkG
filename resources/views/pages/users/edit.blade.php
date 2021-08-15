@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
Edit User
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <strong class="content-title mb-0 my-auto">{{ trans('Users_trans.Users') }}</strong>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/{{ trans('Users_trans.edit_user') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Error</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">{{ trans('Users_trans.back') }}</a>
                    </div>
                </div><br>

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">

          
                        <div class="form-group col-sm-12 col-md-6">
                            <label>{{ trans('Users_trans.User_name') }}<span class="text-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                        </div>

                

                        <div class="form-group  col-sm-12 col-md-6">
                            <label>{{ trans('Users_trans.email') }} </label>
                            {!! Form::text('email', null, array('class' => 'form-control','required')) !!}
                        </div>  

                

                        <div class="form-group  col-sm-12 col-md-6">
                            <label>{{ trans('Users_trans.password') }} </label>
                            {!! Form::password('password', array('class' => 'form-control','required')) !!}
                        </div>


                        <div class="form-group  col-sm-12 col-md-6">
                            <label>{{ trans('Users_trans.password_confirm') }} </label>
                            {!! Form::password('confirm-password', array('class' => 'form-control','required')) !!}
                        </div>



                    <div class="form-group col-sm-12 col-md-4">
                        <label for="Status">{{ trans('Users_trans.user_status') }}<span class="text-danger">*</span></label>
                        <select class="custom-select mr-sm-2" name="Status">
                            <option value="{{ $user->Status}}">{{ $user->Status}}</option>
                            <option value="Active">Active</option>
                            <option value="Not Active">Not Active</option>
                         </select>
                    </div>

            

                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <label class="form-label"> {{ trans('Users_trans.user_permission') }} </label>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))!!}
                        </div>
                    </div>


                    
                    <div class="mg-t-30">
                        <button class="btn btn-main-primary pd-x-20" type="submit">{{ trans('Users_trans.submit') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            
            </div>
        </div>
    </div>
</div>




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
<script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection