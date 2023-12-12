@extends('layouts.dashboard')
@section('title', trans('Dashboard'))
@section('content')
<style type="text/css">
  .user-type-area{
      text-align: left;
      margin-bottom: 20px !important;
  }
  .user-type-area .form-group{
    display: flex;
  }
  .user-type-area .form-group a{
    margin-left: 10px;
  }
  
  @media (min-width: 700px){
    .pl0{
      padding-left: 0px;
    }
  }
  @media (max-width: 600px){
    .user-type-area .form-group .select2-container{
      width: 200px !important;
    }
  }
</style>
<div class="container-fluid">
  {{-- <div class="block-header">
      <h2>Dashboard</h2>
  </div> --}}
  <!-- Body Copy -->
  <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                    Welcome to {!! trans('main.site_title') !!} {{ date('Y') }}
                    <a href="{{ URL::to('users') }}" class="btn btn-primary  btn-lg waves-effect pull-right">Users</a>
                  </h2>
              </div>
              <div class="body">
                <div class="row clearfix user-type-area">
                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">
                      <label for="email_address_2"> User Type {!! trans('main.mandatory_star') !!}</label>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 pl0">
                      <div class="form-group">
                        <div class="">
                          <select id="setType">
                            <option value="{{ base64_encode('all') }}">All</option>
                            <option value="{{ base64_encode('priest') }}">priest</option>
                            <option value="{{ base64_encode('priest') }}">Perpetually Professed</option>
                          </select>
                        </div>
                        <a href="#" class="btn btn-primary" id="print_val">Print Report</a>
                      </div>
                    </div>
                </div>
                @if(!empty($users))
                  <div class="row clearfix">
                    @foreach($users as $user)
                      <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                          <div class="info-box @if($user->user_type == "brother") bg-cyan @elseif($user->user_type == "priest") bg-teal @elseif($user->user_type == "decan") bg-pink @endif hover-expand-effect">
                              <div class="icon">
                                  <i class="material-icons">person_add</i>
                              </div>
                              <div class="content">
                                  <div class="text">
                                    <span class="badge">
                                      @php
                                        if($user->user_type == 'brother'){
                                          echo 'Br. ';
                                        } else if($user->user_type == 'priest'){
                                          echo 'Fr. ';
                                        } else if($user->user_type == 'decan'){
                                          echo 'Dn. ';
                                        }
                                      @endphp
                                      {{ $user->name.' '.$user->cong_abbr  }}
                                    </span>
                                  </div>
                                  <div class="text"><b>No Of Votes: {{ $user->votecnt ?? '0'}}</b></div>
                                  {{-- <div class="text"><b>President: {{ $user->president }}</b> / <b>Vice President: {{ $user->vpresident }}</b> / <b>Treasurer-Cum-Secretary: {{ $user->treasurer }}</b> {!! ($user->user_type == 'sister') ? ' / <b>Secretary: '.$user->secretary.'</b>' : '' !!}</div> --}}
                                  {{-- <div class="number count-to">{{ $user->votecnt }}</div> --}}
                              </div>
                          </div>
                      </div>
                    @endforeach
                  </div>
                  <div class="text-center">
                    {{ $users->links() }}
                  </div>
                @endif
              </div>
          </div>
      </div>
  </div>
  <!-- #END# Body Copy -->
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $("#setType").select2({ width: '300px' });
    var apChosn = $("#setType").val();
    var durl = "{{ URL::to('fRpt') }}";
    $("#print_val").click(function(){
      apChosn = $("#setType").val();
      $("#print_val").attr("href", durl+'?pval='+apChosn);
      /*$.ajax({
        url: "{{ URL::to('fRpt') }}?pval="+apChosn,
        type: 'GET',
        data:{"_token": "{{ csrf_token() }}",},
        success: function (data) {
          console.log("s");
        }
      });*/
    });
  });
</script>

@endsection