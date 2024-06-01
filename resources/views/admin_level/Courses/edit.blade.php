{{-- begin edit location modal--}}

<div id="edit_course_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header cat_modal_header">
                <p class="modal-title">Update Course</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="frm" id="frm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">

                                <label>Course Name</label>
                                <input name="course_name" required="required" type="text" id="edit_course_name" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group form-group-default">

                                <label>Course Details</label>
                                <textarea name="course_details" required="required" type="text" id="edit_course_details" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer justify-content-center">
                <span><a data-dismiss="modal" aria-label="Close" class="btn btn-danger cancel-button btn-sm text-left">Cancel&nbsp;<span class="glyphicons glyphicons-circle_minus"></span></a></span>
                <input type="submit" class="btn btn-info btn-sm " value="Update">
            </div>
            </form>
        </div>
    </div>
</div>
{{-- end of edit location modal --}}