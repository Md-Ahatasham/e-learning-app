<aside class="control-sidebar control-sidebar-dark">
</aside>
<footer class="main-footer">
    <div class="float-right d-none d-sm-inline-block">
        <strong>Version</strong> 1.0.0
    </div>
</footer>
</div>

<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/raphael/raphael.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('dist/js/color.js')}}"></script>
<script src="{{asset('dist/js/slick.min.js')}}"></script>
<script src="{{asset('plugins/custom.js')}}"></script>
<script src="{{asset('krajee/js/plugins/buffer.min.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/js/plugins/filetype.min.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/js/plugins/piexif.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/js/plugins/sortable.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/js/fileinput.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/js/locales/fr.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/js/locales/es.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/themes/gly/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/themes/fa5/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('krajee/themes/explorer-fa5/theme.js')}}" type="text/javascript"></script>
<script src="{{asset('js/moment.js')}}" type="text/javascript"></script>
<script src="{{asset('js/datepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('plugins/ckeditor.js')}}"></script>
<script src="{{asset('plugins/anothereditor.js')}}"></script>
<script>$.fn.fileinput.defaults.theme = 'gly';</script>
<script>
    $("document").ready(function() {
        $("#routine").DataTable({
            "responsive": true,
            "paging": true,
            "pageLength": 10000,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": true,
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#startDate,#endDate').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "MM/DD/YYYY HH:mm:ss A",
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#content").fileinput({
            theme: 'explorer-fa5',
            maxFileSize: 20000048,
            showUpload: false, // Hide the upload button
            showCaption: true,
            browseClass: "btn btn-primary btn-md",
            fileType: "any",
            previewFileIcon: "<i class='fas fa-file'></i>",
            deleteUrl: "",
            uploadUrl: '#',
            initialPreviewShowDelete: true,
            overwriteInitial: false,
            initialPreviewAsData: true,
            initialPreview: [], // You can populate this array with initial preview files if necessary
            initialPreviewConfig: [], // You can populate this array with initial preview configuration if necessary
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val()
                };
            },
            deleteExtraData: function() {
                return {
                    _token: $("input[name='_token']").val()
                };
            },
            showDelete: true,
            showTrash:true,
            showRemove: false, // Ensure the remove button is shown
            showClose: false // Optionally hide the close button in each preview frame
        }).on('filedeleted', function(event, key) {
            console.log('Key = ' + key);
        });
    });
</script>

<script>
    $("document").ready(function() {
        $('#updatePasswordForm').on('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Clear previous error messages
            $('.error').text('');

            // Get form values
            let currentPassword = $('#currentPassword').val();
            let newPassword = $('#newPassword').val();
            let confirmPassword = $('#confirmPassword').val();

            let isValid = true;

            // Client-side validation
            if (newPassword.length < 8) {
                $('#newPasswordError').text('New password must be at least 8 characters long.');
                isValid = false;
            }

            if (newPassword !== confirmPassword) {
                $('#confirmPasswordError').text('Passwords do not match.');
                isValid = false;
            }

            // If validation passes, submit the form via AJAX
            if (isValid) {
                $.ajax({
                    url: '/updatePassword', // Adjust the URL as needed
                    type: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token if needed
                    },
                    success: function (response) {
                        alert('Password updated successfully!');
                        $('#password-change-modal').modal('hide');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            // Display server-side validation errors
                            $.each(jqXHR.responseJSON.errors, function (field, message) {
                                $('#' + field + 'Error').text(message[0]);
                            });
                        } else {
                            alert('Error updating password. Please try again.');
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#user_email').keyup(function(e) {
            var email = $("#user_email").val();
            $.get("{{url('checkEmail')}}", {
                    email: email
                },
                function(data) {
                    if (data.result != '') {
                        $("#email").html(data.result);
                        $(':input[name="submit"]').prop('disabled', true);
                    } else {
                        $("#email").html(data.result);
                        $(':input[name="submit"]').prop('disabled', false);
                    }
                }, "json");
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#edit_user_email').keyup(function(e) {
            var email = $("#edit_user_email").val();
            $.get("{{url('checkEmail')}}", {
                    email: email
                },
                function(data) {
                    if (data.result != '') {
                        $("#edit_email").html(data.result);
                        $(':input[name="submit"]').prop('disabled', true);
                    } else {
                        $("#edit_email").html(data.result);
                        $(':input[name="submit"]').prop('disabled', false);
                    }
                }, "json");
        });
    });
</script>

<script>
    function deleteItem(e) {
        const checkStr = confirm('Are you sure you want to delete this?');
        if (checkStr === false) {
            e.preventDefault();
            return false;
        }
    }
    $(document).ready(function() {

        $('#studentTable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 1000,
            "info": false,
            "order": [
                [0, 'desc']
            ],
            "ajax": "{{ url('dataTableStudentList') }}",
            "columns": [{
                "data": "profile_photo",
                "orderable": false
                },
                {
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "action",
                },

            ],
            "fnDrawCallback": function (oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var maxField = 11;
        var addButton = $('.add_button');
        var wrapper = $('#unitTable');
        var x = 1;
        $(addButton).click(function() {
            var labelName = $('label[for="' + this.id + '"]').html();
            var fieldName = $("#unitTable input:last").attr("name")
            var fieldHTML = '<div class="form-group"><input type="text" placeholder="Enter ' + labelName + '" class="form-control-sm form-control" name=' + fieldName + ' required="required" style="max-width:90%;display:inline-block"/><a href="javascript:void(0);"  class="remove_button btn btn-sm btn-default" style="margin-left:2%;border-radius:50%"><i class="fas fa-trash"></i></a></div>';
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML);
            } else {
                alert('You can not add more than 10 fields at a time');
            }
        });

        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).closest('div').remove();
            x--;
        });

        $(".reset").click(function() {
            $(this).closest('form').find(".select2,.input_field, input[type=select],textarea,select, select2").val("");
            $('.select2').val('').trigger("change");
        });
        $(".reload").click(function() {
            location.reload();
        });

    });
</script>

<script>
    $(function() {
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    })
</script>
<script>
    $(document).ready(() => {
        $("#profile_image").change(function() {
            const file = this.files[0];
            const files = this.files[0]['name'];
            var fileSizeInkb = parseFloat(file.size / 1024).toFixed(2);
            var image_regex = /^.*\.(jpeg|JPEG|JPG|jpg|png|PNG|)$/;
            if (!image_regex.test(files) || fileSizeInkb > 2048) {
                alert("File format or file size not supported. Supported formates are jpeg,jpg,png and size should be less than 2MB");
                return false;
            } else {
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#imgPreview")
                            .attr("src", event.target.result).css({
                                'min-height': '100px',
                                'max-height': '100px',
                                'min-width': '100px',
                                'max-width': '100px'
                            });
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $("#edit_profile_image").change(function() {
            const file = this.files[0];
            const files = this.files[0]['name'];
            var fileSizeInkb = parseFloat(file.size / 1024).toFixed(2);
            var image_regex = /^.*\.(jpeg|JPEG|JPG|jpg|png|PNG|)$/;
            if (!image_regex.test(files) || fileSizeInkb > 2048) {
                alert("File format or file size not supported. Supported formates are jpeg,jpg,png and size should be less than 2MB");
                return false;
            } else {
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $("#imgPreviewForEdit")
                            .attr("src", event.target.result).css({
                                'min-height': '100px',
                                'max-height': '100px',
                                'min-width': '100px',
                                'max-width': '100px'
                            });
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        var minLength = 11;
        var maxLength = 15;
        $('#emergency_contact').on('keydown keyup change', function() {
            var char = $(this).val();
            var charLength = $(this).val().length;
            if (charLength < minLength) {
                $('#emergency_max-length-message').text('Length is short, minimum length' + minLength + ' characters.');
            } else if (charLength > maxLength) {
                $('#emergency_max-length-message').text('Length is not valid, maximum length ' + maxLength + ' characters.').css({
                    'color': 'red'
                });
                $(this).val(char.substring(0, maxLength));
            } else {
                $('#emergency_max-length-message').text('');
            }
        });

        $('#phone_number').on('keydown keyup change', function() {
            var char = $(this).val();
            var charLength = $(this).val().length;
            if (charLength < minLength) {
                $('#phone_max-length-message').text('Length is short, minimum length' + minLength + ' characters.');
            } else if (charLength > maxLength) {
                $('#phone_max-length-message').text('Length is not valid, maximum length ' + maxLength + ' characters.').css({
                    'color': 'red'
                });
                $(this).val(char.substring(0, maxLength));
            } else {
                $('#phone_max-length-message').text('');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        var url = window.location;
        var path = $(location).attr('href').split("/").splice(3, 1);
        url = 'http://' + $(location).attr('host') + '/' + path;
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
        $("ul>li .menu-open>a>i").addClass('fa fa-circle').css({"color":"#00aecb"});
    });
</script>

<script>
    $("document").ready(function() {
        $(document).on('click', '.edit_batch', function() {
            let id = $(this).attr("id");
            $.get("{{route('batches.batchInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_batch_name').val(data.result.batch_name);
                    let action = "{{route('batches.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_batch_modal').modal('show');
        });
    });
</script>

<script>
    $("document").ready(function() {
        $(document).on('click', '.edit_course', function() {
            let id = $(this).attr("id");
            $.get("{{route('courses.courseInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_course_name').val(data.result.course_name);
                    $('#edit_course_details').val(data.result.course_details);
                    let action = "{{route('courses.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_course_modal').modal('show');
        });
    });
</script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
</script>

</body>

</html>