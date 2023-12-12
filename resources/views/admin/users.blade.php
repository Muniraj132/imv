@extends('layouts.dashboard')
@section('title', trans('Dashboard'))
@section('content')
<style type="text/css">
.select2 {
  min-width:180px !important;
}
.dataTables_wrapper .dataTables_info {
    clear:none;
    margin-left:20px;
    padding-top:0;
    font-weight: bold;
}
</style>
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous"> --}}
<section class="">
    <div class="container-fluid">
        <div class="">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="card">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="header">
                          <a href="{{ URL::to('fdashboard') }}" class="btn btn-primary  btn-lg waves-effect pull-right">Reports</a>
                        <h2>All Users</h2>
                        </div>
                        <div class="body">
                            <p class="pull-left">
                                    <select class="voted" id="voted" name="voted">
                                        <option value="">Choose Voting status</option>
                                        <option value="1">Voted</option>
                                        <option value="2">Not Voted</option>
                                    </select>
                                </p>
                            <div class="row clearfix"></div>
                            <div class="table-responsive" style="border:0px white !important;">
                              <table class="datatable mdl-data-table dataTable" cellspacing="0" width="100%" role="grid" style="width: 100%;">
                                  <thead>
                                      <tr>
                                          <th>User Name</th>
                                          <th>Email</th>
                                          {{-- <th>Congregation</th> --}}
                                          <th>Vote Status</th>
                                          <th>Voted Time</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
      $("#voted").select2();

        var tablesss = $('.datatable').DataTable({
            responsive: true,
            "pageLength": 100,
            "lengthMenu": [[200, 400, 600, 800, 1000, 100], [200, 400, 600, 800, "All", "100"]],
            "oLanguage": {
              "sLengthMenu": "Show _MENU_ records",
            },
            processing: true,
            serverSide: true,
            // "lengthChange": false,
            "language": {
              'loadingRecords': '&nbsp;',
              "processing": '<div class="preloader"><div class="spinner-layer pl-red"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>'
            },
            dom: 'lifrtp',
            ajax: {
              url: "{{ URL::to('listAllUsers') }}",
              data: function (d) {
                    //$(".page-loader-wrapper").show();
                    d.voted = $('#voted').val()
                },
              complete: function (d){
                $(".page-loader-wrapper").hide();
              }
            },
            columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        // { data: 'congregation', name: 'congregation' },
                        { data: 'voted', name: 'voted' },
                        { data: 'voted_dtime', name: 'voted_dtime' },
                        { data: 'viewLink', name: 'viewLink' },
                        /*{ data: 'View', name: 'View', render:function(data, type, row){
                            return "<a href='job/"+row.id+"/edit'>Edit</a>"
                        }},*/
                     ],
            "aoColumnDefs": [
                { "bSortable": false, "aTargets": [0] }, 
            ],
        });

        $('#voted').change(function(){
            // $("body").css("opacity","0.0");
            //$(".page-loader-wrapper").show();
            tablesss.draw();
        });
        $(document).on("change","#voted",function(){
            // $("body").css("opacity","0.0");
            $(".page-loader-wrapper").show();
        });
        
        $(document).on("click",".paginate_button",function(){
          $(".page-loader-wrapper").show();
        });
        $("#cat_delete_all_0cat").click(function(){
          if($(this).prop("checked")) {
            $(".cat_delete_all").prop("checked", true);
          } else {
            $(".cat_delete_all").prop("checked", false);
          } 
        });
        $(".dataTables_length label select").addClass("setCusDpDown");
    });
</script>
@endsection
