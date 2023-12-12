@extends('layouts.dashboard')
@section('title', trans('Dashboard'))
@section('content')

    <div class="container-fluid">
        <!-- Body Copy -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Welcome to voting of IMV - {{ date('Y') }}</h2>
                    </div>
                    <div class="body">
                        @if(@$my_details[0]->voted == 1)
                            <p class="lead" style="font-size: 16px !important;">
                                <div class="alert bg-green alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <strong>Well done!</strong> Thanks for Voting
                                </div>
                            </p>
                            <p align="center" class="lead" style="font-size: 16px !important;">
                                Thanks for your active participation, You have Voted at {{ date("d-M-Y, h:i A",strtotime($my_details[0]->voted_dtime)) }}
                            </p>
                            <p class="lead" style="font-size: 16px !important;">
                                <span style="color: red; ">Note:</span> Please wait for next announcement from Election Commission of IMV
                            </p>
                        @else
                        <div class="row clearfix"></div>
                          <form action="{{ route('save-vote') }}" id="homeVoteForm" class="form-horizontal" method="POST">
                             @csrf
                              @php $j = 0; @endphp
                              @for($i=0; $i < $tcount; $i++)
                                @php $j++ @endphp
                                <div class="col-md-12 col-lg-6" style="margin-top: 20px !important;">
                                  <div class="row"> 
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 form-control-label">
                                      <label for="email_address_2"> {!! trans('Delegate') !!} {!! $j !!} <span style="color:red">*</span></label>
                                    </div>
                                    <div class="col-lg-9 col-md-6 col-sm-6 col-xs-6">
                                      <div class="form-group">
                                        <div class="">
                                          <select class="form-control mjsuperior" name="mjsuperior[{{$i}}]" id="mjsuperior_{{ $i }}" data-cid="{{ $i }}" required="required">
                                            <option value="">Choose a Major Superior</option>
                                            @if($ausers)
                                                @foreach($ausers as $con => $con_val)
                                                  <option value="{{ $con_val->id }}">
                                                    @php
                                                      if($con_val->user_type == "priest"){
                                                        $rle = 'Fr. ';
                                                      } else if($con_val->user_type == "decan"){
                                                        $rle = 'Dn. ';
                                                      } else if($con_val->user_type == "brother"){
                                                        $rle = 'Br. ';
                                                      }
                                                    @endphp
                                                    {{ $rle.' '.$con_val->name }}
                                                  </option>
                                                @endforeach
                                              @endif
                                          </select>
                                        </div>
                                        @if ($errors->has('mjsuperior'))
                                          <span class="help-block">
                                            {{ $errors->first('mjsuperior') }}
                                          </span>
                                        @endif
                                        <label id="mjsuperior_{{ $i }}-error" class="error" for="mjsuperior_{{ $i }}"></label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endfor
                          
                            </div>

                            <div class="row clearfix"></div>
                            <div class="col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1" style="margin-left: 13% !important;">
                              <div class="row clearfix js-sweetalert">
                                <button type="submit" class="btn btn-primary btn-lg waves-effect", id="sbtbtn">Save</button>
                                <a href="{{ route('dashboard') }}" class="btn btn-danger danger-cancel btn-lg waves-effect">Cancel</a>
                              </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Body Copy -->
    </div>

    <script type="text/javascript">
    $(document).ready(function(){
        $(".congregation").select2();
        $(".mjsuperior").select2();

        $('.mjsuperior').change(function () {
            if($('.mjsuperior option[value="' + $(this).val() + '"]:selected').length > 1) {
                $(this).val('-1').change();
                // alert('You have already selected this option previously - please choose another.')
                var uname = $(this).text().replace("Choose a Major Superior", "");;
                toastr.error("You cannot duplicate, You have already selected this user.");
            }
        });


        // validate form on keyup and submit
        $("#homeVoteForm").validate({
            submitHandler: function(form) {
                $("#sbtbtn").attr("disabled", true);
                form.submit();
            },
            ignore: [],
            rules: {
                "congregation[]": "required",
                "mjsuperior[]": "required",
            },
            messages: {
                "congregation[]": "This field is required",
                "mjsuperior[]": "This field is required"
            },
            //To check during tabing itself
            onkeyup: function(element) {
                this.element(element);
            },
            onfocusout: function(element) {
                this.element(element);
            }
        });
    });
    </script>
@endsection