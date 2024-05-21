@if ($message = Session::get('toast_success'))
<div class="alert alert-block toaster">
    <button type="button" class="close toaster-button" data-dismiss="alert">×</button>
    <strong class="toaster-text-success">{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('toast_error'))
<div class="alert toaster alert-block">
    <button type="button" class="close toaster-button" data-dismiss="alert">×</button>
    <strong class="toaster-text-error">{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('toast_warning'))
<div class="alert toaster alert-block">
    <button type="button" class="close toaster-button" data-dismiss="alert">×</button>
    <strong class="toaster-text-warning">{{ $message }}</strong>
</div>
@endif



@if ($message = Session::get('toast_info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($errors->any())
<div class="alert toaster">
    <button type="button" class="close toaster-button" data-dismiss="alert">×</button>
    <strong class="toaster-text-danger">Please check the form below for errors </strong>
</div>
@endif