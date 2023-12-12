
@if ( Session::has('success') )
<div class="alert alert-success alert-block fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <!-- <h4>
        <i class="icon-ok-sign"></i>
        Success!
    </h4> -->
    <p>{{ Session::get("success") }}</p>
</div>
@endif

@if ( Session::has('warning') )
<div class="alert alert-warning alert-block fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <!-- <h4>
        <i class="icon-ok-sign"></i>
        Success!
    </h4> -->
    <p>{{ Session::get("warning") }}</p>
</div>
@endif

@if ( Session::has('error') )
<div class="alert alert-danger alert-block fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <!-- <h4>
        <i class="icon-ok-sign"></i>
        Success!
    </h4> -->
    <p>{{ Session::get("error") }}</p>
</div>
@endif

@if ( Session::has('info') )
<div class="alert alert-primary alert-block fade in">
    <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times"></i>
    </button>
    <!-- <h4>
        <i class="icon-ok-sign"></i>
        Success!
    </h4> -->
    <p>{{ Session::get("info") }}</p>
</div>
@endif
