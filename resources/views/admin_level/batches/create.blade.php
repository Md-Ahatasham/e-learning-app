<!---- batch add modal ---------------------------------------------------->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cat_modal_header">
                <p class="modal-title">Add New Batch</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="frm" action="{{route('batches.store')}}" method="post" enctype="multipart/form-data"> {{csrf_field()}}

                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="row" id="unitTable">
                                <div class="form-group">
                                    <label for="">Batch Name</label>
                                    <input required="required" placeholder="Enter Batch Name" class="form-control-sm form-control" id="" type="text" name="batch_name[]">
                                </div>
                            </div>
                            <a class="add_button btn-sm btn-default add_more_button form-control" title="Add field"><em class="fas fa-plus add_icon"></em> </a>
                        </div>
                    </div>
{{--            </div>--}}
                    <div class="modal-footer justify-content-center">
                        <div class="col-6 text-center">
                            <span><a data-dismiss="modal" aria-label="Close" class="btn-sm btn btn-danger cancel-button text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                            <span><input type="submit" class="btn btn-sm btn-info text-right" value="Save"><span class="glyphicons glyphicons-circle_plus"></span></button></span>
                        </div>

                    </div>
                </form>
        </div>
    </div>
</div>
{{-- end of add batch modal--}}