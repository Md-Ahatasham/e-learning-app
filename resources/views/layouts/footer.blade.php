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
<script>$.fn.fileinput.defaults.theme = 'gly';</script>
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
    $("document").ready(function() {
        $(document).ready(function() {
            $('.timepicker').mdtimepicker();
        });
        $("#unit, #permission,#specialty,#qualification,#precaution,#bed,#room,#assignedTablet,#rounder_activity,#affect,#behavior").DataTable({
            "responsive": true,
            "paging": true,
            "pageLength": 1000,
            "lengthChange": false,
            "searching": true,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
    });
</script>
<script>
    $(function() {
        $("#unit_wrapper>.row>.col-md-6").first().text('Unit List');
        $("#location_wrapper>.row>.col-md-6").first().text('Unit List');
        $("#affect_wrapper>.row>.col-md-6").first().text('Affect List');
        $("#behavior_wrapper>.row>.col-md-6").first().text('Behavior List');
        $("#room_wrapper>.row>.col-md-6").first().text('Room List');
        $("#bed_wrapper>.row>.col-md-6").first().text('Bed List');
        $("#specialty_wrapper>.row>.col-md-6").first().text('Specialty List');
        $("#qualification_wrapper>.row>.col-md-6").first().text('Qualification List');
        $("#studentTable_wrapper>.row>.col-md-6").first().text('Student List');
        $("#roundertable_wrapper>.row>.col-md-6").first().text('Rounders');
        $("#tablettable_wrapper>.row>.col-md-6").first().text('Tablets');
        $("#assignedTablet_wrapper>.row>.col-md-6").first().text('Assigned Tablet List');
        $("#rounder_activity_wrapper>.row>.col-md-6").first().text('Tablet Details');
        $("#notificationTable_wrapper>.row>.col-md-6").first().text('Notifications');
        $("#permission_wrapper>.row>.col-md-6").first().text('Permission List');
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });

        function formatText(icon) {
            return $('<span><i class="fas ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
        };

        $('.rounder_name').select2({
            templateSelection: formatText,
            templateResult: formatText
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
        $(document).on('click', '.edit_unit', function() {
            var id = $(this).attr("id");
            $.get("{{route('units.unitInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_unit_name').val(data.result.name);
                    action = "{{route('units.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_unit_modal').modal('show');
        });
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
    $("document").ready(function() {
        $(document).on('click', '.room', function() {
            $.get("{{route('rooms.create')}}",
                function(data) {
                    if (data.unit.length > 0) {
                        for (var i = 0; i < data.unit.length; i++) {
                            selected = '';

                            $('#unit_name').append('<option value = \"' + data.unit[i].id + '\" ' + selected + '>' + data.unit[i].name + '</option>');
                        }
                    }
                }, "json");
            $('#roomModal').modal('show');
        });
    });
</script>
<script>
    $("document").ready(function() {
        $(document).on('click', '.edit_room', function() {
            var id = $(this).attr("id");
            $.get("{{route('rooms.edit')}}", {
                    id: id
                },
                function(data) {
                    var selected_item = data.result.result.unit_id;
                    if (data.result.unit.length > 0) {
                        for (var i = 0; i < data.result.unit.length; i++) {
                            if (data.result.unit[i].id == selected_item) {
                                selected = ' selected="selected" ';
                            } else {
                                selected = '';
                            }
                            $('#edit_unit_name').append('<option value = \"' + data.result.unit[i].id + '\" ' + selected + '>' + data.result.unit[i].name + '</option>');
                        }
                    }
                    $('#edit_room_name').val(data.result.result.room_no);
                    action = "{{route('rooms.update')}}" + '?id=' + data.result.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#editRoomModal').modal('show');
        });
    });
</script>
<script>
    $("document").ready(function() {
        $(document).on('click', '.bed', function() {
            $.get("{{route('beds.create')}}",
                function(data) {
                    if (data.room.length > 0) {
                        for (var i = 0; i < data.room.length; i++) {
                            selected = '';

                            $('#room_no').append('<option value = \"' + data.room[i].id + '\" ' + selected + '>' + data.room[i].room_no + '</option>');
                        }
                    }
                }, "json");
            $('#bedModal').modal('show');
        });
    });
</script>

<script>
    $("document").ready(function() {
        $(".unit").change(function() {
            var id = $(this).val();
            $.get("{{route('patients.getRoomListByUnitId')}}", {
                    id: id
                },
                function(data) {
                    $(".room").empty();
                    if (data.roomList.length > 0) {
                        $('.room').append('<option value = \"' + '' + '\">' + 'Select Room No' + '</option>');
                        for (var i = 0; i < data.roomList.length; i++) {
                            selected = '';
                            $('.room').append('<option value = \"' + data.roomList[i].id + '\" ' + selected + '>' + data.roomList[i].room_no + '</option>');
                        }
                    }
                }, "json");
        });
    });
</script>
<script>
    $("document").ready(function() {
        $(".room").change(function() {
            var id = $(this).val();
            $.get("{{route('patients.getBedListByRoomId')}}", {
                    id: id
                },
                function(data) {
                    $(".bed").empty();
                    if (data.bedList.length > 0) {
                        $('.bed').append('<option value = \"' + '' + '\">' + 'Select Bed No' + '</option>');
                        for (var i = 0; i < data.bedList.length; i++) {
                            selected = '';
                            $('.bed').append('<option value = \"' + data.bedList[i].id + '\" ' + selected + '>' + data.bedList[i].bed_no + '</option>');
                        }
                    }
                }, "json");

        });
    });
</script>
</body>

</html>