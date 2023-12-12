@extends('layouts.dashboard')
@section('title','Edit User')
@section('content')
@php use App\Helpers\HBAHelper; @endphp
<section class="">
    <div class="container-fluid">
        <div class="">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                        <h2>Edit User</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix"></div>
                            {!! Form::open(array('route' => array('updateUser',$user->id),'method'=>'POST','id'=>'UserForm','class' => 'form-horizontal  row-border')) !!}
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2"> Name {!! trans('main.mandatory_star') !!}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::text('name', @$user->name, array('class'=>'form-control', 'id' => 'name','placeholder' => 'Enter Name','maxlength' => '50')) !!}
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                   {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                            <label id="name-error" class="error" for="name" style="display: block;"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2"> Email {!! trans('main.mandatory_star') !!}</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                {!! Form::text('email', @$user->email, array('class'=>'form-control', 'id' => 'email','placeholder' => 'Enter Email','maxlength' => '50')) !!}
                                            </div>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                   {{ $errors->first('email') }}
                                                </span>
                                            @endif
                                            <label id="email-error" class="error" for="email" style="display: block;"></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix"></div>
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                         <div class="row clearfix js-sweetalert">

                                         {!! Form::submit('Update',['class' => 'btn btn-primary btn-lg waves-effect']) !!}
                                        {!! Html::link(route('users'), trans('main.cancel'), array('class' => 'btn btn-danger danger-cancel btn-lg waves-effect'), true) !!}
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
 $(document).ready(function(){
    // validate Category form on keyup and submit
    $("#UserForm").validate({
      ignore: [],
      rules: {
        name: "required",
        email: "required"
        },
      messages: {
        name: "Name is required",
        email: "email is required"
      }
    });
});
</script>
@endsection