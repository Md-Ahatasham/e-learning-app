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


<script type="text/javascript">
    $('.slider').slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#abbreviation").keyup(function() {
            var value = $(this).val();
            $("#color_view").val(value);
        });

        $("#selectAll").click(function() {
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });

    });
</script>
<script>
    function clickColor(hex, seltop, selleft, html5) {
        var color;
        if (html5 && html5 == 5) {
            color = document.getElementById("html5colorpicker").value;
            $("#color_view").css("background", color);
            $("#color_code").val(color);
        }
    }
</script>
<script>
    $("document").ready(function() {

        // if (navigator.userAgent.indexOf("Firefox") != -1) {
        //     $(".add-precaution-icon").css({
        //         "margin-top": '110' + '%'
        //     });
        //     $(".edit-precaution-icon").css({
        //         "margin-top": '115' + '%'
        //     });
        // } else if (navigator.userAgent.indexOf("Chrome") != -1) {
        //     $(".add-precaution-icon").css({
        //         "margin-top": '125' + '%'
        //     });
        //     $(".edit-precaution-icon").css({
        //         "margin-top": '133' + '%'
        //     });
        // }

        $(document).on('click', '.edit_user', function() {
            var id = $(this).attr("id");
            $.get("{{route('users.userInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_first_name').val(data.result.first_name);
                    $('#edit_last_name').val(data.result.last_name);
                    $('.edit_email').val(data.result.email);
                    $('#edit_employee_id').val(data.result.user_code);
                    $('#imgPreviewForEdit').attr("src", data.result.profile_photo);
                    $('#name').empty();
                    var selected_item = "";
                    if (data.result !== null) {
                        selected_item = data.result.role_id;
                    }

                    if (data.roles.length > 0) {

                        for (var i = 0; i < data.roles.length; i++) {
                            if (data.roles[i].id == selected_item) {
                                selected = 'selected="selected" ';
                            } else {
                                selected = '';
                            }
                            $('#name').append('<option value = \"' + data.roles[i].id + '\" ' + selected + '>' + data.roles[i].name + '</option>');
                        }
                    }
                    action = "{{route('users.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_user').modal('show');
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
    $(document).ready(function() {
        $(".rounding-history").click(function() {
            var patientId = $(this).attr("id");
            $('#rounding_history_table').DataTable({
                "processing": true,
                "serverSide": true,
                "retrieve": true,
                "pageLength": 4,
                "info": false,
                "lengthChange": false,
                "searching": false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": "{{ url('getRoundingHistory') }}" + '/' + patientId,
                "columns": [{
                        "data": "time"
                    },
                    {
                        "data": "rounder"
                    },
                    {
                        "data": "tablet"
                    },
                    {
                        "data": "location"
                    },
                    {
                        "data": "behaviour"
                    },
                    {
                        "data": "affect"
                    },
                    {
                        "data": "transfer_to"
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                    }
                }
            });

        });

        $(".activity_history").click(function() {
            var patientId = $(this).attr("id");
            $('#activity_history_table').DataTable({
                "processing": true,
                "serverSide": true,
                "retrieve": true,
                "pageLength": 4,
                "info": false,
                "lengthChange": false,
                "searching": false,
                "order": [
                    [0, 'asc']
                ],
                "ajax": "{{ url('getPatientActivityHistory') }}" + '/' + patientId,
                "columns": [{
                        "data": "time"
                    },
                    {
                        "data": "event"
                    },
                    {
                        "data": "user"
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                    }
                }
            });

        });

        $('#dashboardPatientTable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 7,
            "info": false,
            "order": [
                [1, 'desc']
            ],
            "ajax": "{{ url('dashboardPatientList') }}",
            "columns": [{
                    "data": "patient_picture",
                    "orderable": false
                },
                {
                    "data": "first_name"
                },
                {
                    "data": "preferred_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "gender"
                },
                {
                    "data": "unit"
                },
                {
                    "data": "room"
                },
                {
                    "data": "bed"
                },
                {
                    "data": "admission_date"
                },
                {
                    "data": "rounding_interval"
                },
                {
                    "data": "precaution",
                    "orderable": false,
                },
            ]
        });

        $('#patienttable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 1000,
            "info": false,
            "order": [
                [1, 'desc']
            ],
            "ajax": "{{ url('dataTablePatientList') }}",
            "columns": [{
                    "data": "patient_picture",
                    "orderable": false
                },
                {
                    "data": "first_name"
                },
                {
                    "data": "preferred_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "gender"
                },
                {
                    "data": "units"
                },
                {
                    "data": "rooms"
                },
                {
                    "data": "beds"
                },
                {
                    "data": "admission_date"
                },
                {
                    "data": "rounding_interval"
                },
                {
                    "data": "precaution",
                    "orderable": false
                },
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
        $('#dischargepatienttable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 1000,
            "info": false,
            "order": [
                [6, 'desc']
            ],
            "ajax": "{{ url('dischargedPatient') }}",
            "columns": [{
                    "data": "patient_picture",
                    "orderable": false
                },
                {
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "gender"
                },
                {
                    "data": "unit"
                },
                {
                    "data": "room"
                },
                {
                    "data": "bed"
                },
                {
                    "data": "admission_date"
                },
                {
                    "data": "rounding_interval"
                },
                {
                    "data": "precaution",
                    "orderable": false
                },
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });

        $('#queuePatienttable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 1000,
            "info": false,
            "order": [
                [1, 'desc']
            ],
            "ajax": "{{ url('queuePatientList') }}",
            "columns": [{
                    "data": "patient_picture",
                    "orderable": false
                },
                {
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "gender"
                },
                {
                    "data": "unit"
                },
                {
                    "data": "room"
                },
                {
                    "data": "bed"
                },
                {
                    "data": "rounding_interval"
                },
                {
                    "data": "precaution",
                    "orderable": false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });

        $('#roundertable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 1000,
            "info": false,
            "order": [
                [0, 'desc']
            ],
            "ajax": "{{ url('dataTableRounderList') }}",
            "columns": [{
                    "data": "first_name"
                },
                {
                    "data": "last_name"
                },
                {
                    "data": "employee_id"
                },
                {
                    "data": "dob"
                },
                {
                    "data": "status"
                },
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
        $('#tablettable').DataTable({
            "processing": true,
            "serverSide": true,
            "pageLength": 1000,
            "info": false,
            "order": [
                [0, 'desc']
            ],
            "ajax": "{{ url('dataTableTabletList') }}",
            "columns": [{
                    "data": "tablet_in_use"
                },
                {
                    "data": "time_since_last_sync"
                },
                {
                    "data": "name"
                },
                {
                    "data": "assigned_patients"
                },
                {
                    "data": "last_location"
                },
                {
                    "data": "tablet_in_use"
                },

            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });

        var firstRounder = $(".first_rounder").attr("id");
        $("div[id='" + firstRounder + '_card' + "']").addClass('btn-info');
        $(".rounderActivityLogTable").attr('id', firstRounder).DataTable({
            "retrieve": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 7,
            "info": false,
            "lengthChange": false,
            "searching": false,
            "order": [
                [0, 'desc']
            ],
            "ajax": "{{ url('tabletActivityByrounderId') }}" + '/' + firstRounder,
            "columns": [{
                    "data": "time",
                    "className": "text-center"
                },
                {
                    "data": "event",
                    "className": "text-center"
                },
                {
                    "data": "user",
                    "className": "text-center"
                },
            ],
            "fnDrawCallback": function(oSettings) {
                if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                    $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                }
            }
        });
        $(".rounder-activity").click(function() {
            var firstRounder = $(this).attr("id");
            $("div[class*='btn-info']").removeClass('btn-info');
            $("div[id='" + firstRounder + '_card' + "']").addClass('btn-info');
            $(".rounderActivityLogTable").attr('id', '_' + firstRounder).DataTable({
                "processing": true,
                "serverSide": true,
                "destroy": true,
                "pageLength": 7,
                "lengthChange": false,
                "info": false,
                "searching": false,
                "order": [
                    [0, 'desc']
                ],
                "ajax": "{{ url('tabletActivityByrounderId') }}" + '/' + firstRounder,
                "columns": [{
                        "data": "time",
                        "className": "text-center"
                    },
                    {
                        "data": "event",
                        "className": "text-center"
                    },
                    {
                        "data": "user",
                        "className": "text-center"
                    },
                ],
                "fnDrawCallback": function(oSettings) {
                    if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {
                        $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();
                    }
                }
            });
        });

    {{--    $('#notificationTable').DataTable({--}}
    {{--        "processing": true,--}}
    {{--        "serverSide": true,--}}
    {{--        "pageLength": 1000,--}}
    {{--        "info": false,--}}
    {{--        "order": [--}}
    {{--            [1, 'desc']--}}
    {{--        ],--}}
    {{--        "ajax": "{{ url('dataTableNotificationList') }}",--}}
    {{--        "columns": [{--}}
    {{--                "data": "id",--}}
    {{--                "orderable": false--}}
    {{--            },--}}
    {{--            {--}}
    {{--                "data": "patient",--}}
    {{--                "orderable": false--}}
    {{--            },--}}
    {{--            {--}}
    {{--                "data": "rounder"--}}
    {{--            },--}}
    {{--            {--}}
    {{--                "data": "action_details"--}}
    {{--            },--}}
    {{--            // {--}}
    {{--            //     data: 'action',--}}
    {{--            //     name: 'action',--}}
    {{--            //     orderable: true,--}}
    {{--            //     searchable: true--}}
    {{--            // },--}}

    {{--        ],--}}
    {{--        "fnDrawCallback": function(oSettings) {--}}
    {{--            if (oSettings._iDisplayLength >= oSettings.fnRecordsDisplay()) {--}}
    {{--                $(oSettings.nTableWrapper).find('.dataTables_paginate').hide();--}}
    {{--            }--}}
    {{--        }--}}
    {{--    });--}}
    {{--});--}}

    function deleteItem(e) {
        var checkstr = confirm('Are you sure you want to delete this?');
        if (checkstr == false) {
            e.preventDefault();
            return false;
        }
    }

    function checkDischarge(e) {
        var checkstr = confirm('Are you sure you want to discharge?');
        if (checkstr == false) {
            e.preventDefault();
            return false;
        }
    }
</script>
<script>
    $("document").ready(function() {
        $(document).on('click', '.tablet', function() {
            $.get("{{route('tablets.create')}}",
                function(data) {
                    if (data.rounder.length > 0) {
                        for (var i = 0; i < data.rounder.length; i++) {
                            selected = '';

                            $('#rounder_name').append('<option value = \"' + data.rounder[i].id + '\" ' + selected + '>' + data.rounder[i].first_name + ' ' + data.rounder[i].last_name + '</option>');
                        }
                    }
                }, "json");
            $('#tabletModal').modal('show');
        });
    });
</script>
<script>
    {{--$("document").ready(function() {--}}
    {{--    $(document).on('click', '#notification_menu', function() {--}}
    {{--        $.get("{{url('updateNotification')}}",--}}
    {{--            function(data) {}, "json");--}}
    {{--    });--}}
    {{--});--}}
</script>
<script>
    $("document").ready(function() {
        $(document).on('click', '.edit_tablet', function() {
            var id = $(this).attr("id");
            $.get("{{route('tablets.edit')}}", {
                    id: id
                },
                function(data) {
                    var selected_item = data.result.result.rounder_id;
                    if (data.result.rounder.length > 0) {
                        for (var i = 0; i < data.result.rounder.length; i++) {
                            if (data.result.rounder[i].id == selected_item) {
                                selected = ' selected="selected" ';
                            } else {
                                selected = '';
                            }
                            $('#edit_rounder_name').append('<option value = \"' + data.result.rounder[i].id + '\" ' + selected + '>' + data.result.rounder[i].first_name + ' ' + data.result.rounder[i].last_name + '</option>');
                        }
                    }
                    $('#edit_tablet_name').val(data.result.result.tablet_name);
                    action = "{{route('tablets.update')}}" + '?id=' + data.result.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#editTabletModal').modal('show');
        });
    });
</script>

<script>
    {{--$("document").ready(function() {--}}
    {{--    $(document).on('click', '.edit_notification', function() {--}}
    {{--        var id = $(this).attr("id");--}}
    {{--        $.get("{{route('notifications.edit')}}", {--}}
    {{--                id: id--}}
    {{--            },--}}
    {{--            function(data) {--}}
    {{--                var selected_item = data.result.result.rounder_id;--}}
    {{--                if (data.result.rounder.length > 0) {--}}
    {{--                    for (var i = 0; i < data.result.rounder.length; i++) {--}}
    {{--                        if (data.result.rounder[i].id == selected_item) {--}}
    {{--                            selected = ' selected="selected" ';--}}
    {{--                        } else {--}}
    {{--                            selected = '';--}}
    {{--                        }--}}
    {{--                        if (data.result.rounder[i].is_online == 1) {--}}
    {{--                            icon = "fa-solid fa-circle";--}}
    {{--                        } else {--}}
    {{--                            icon = "fa-duotone fa-circle";--}}
    {{--                        }--}}
    {{--                        $('#rounder_id').append('<option data-icon="' + icon + '" value = \"' + data.result.rounder[i].id + '\" ' + selected + '>' + data.result.rounder[i].first_name + ' ' + data.result.rounder[i].last_name + '</option>');--}}
    {{--                    }--}}
    {{--                }--}}
    {{--                $('#patient_name').val(data.result.result.patient.first_name + ' ' + data.result.result.patient.last_name);--}}
    {{--                $('#patient_id').val(data.result.result.patient_id);--}}
    {{--                $('#previous_rounder_id').val(data.result.result.rounder_id);--}}
    {{--                action = "{{route('notifications.update')}}" + '?id=' + data.result.result.id;--}}
    {{--                $('#frm').attr('action', action);--}}
    {{--            }, "json");--}}
    {{--        $('#edit_notification').modal('show');--}}
    {{--    });--}}
    {{--});--}}
</script>

<script>
    $("document").ready(function() {
        var array_of_id = [];
        $(document).on('click', '.checkInput', function() {
            var id = $(this).attr("id");
            array_of_id.push($(this).attr("id"));
            var appearence = 0;
            if ($.inArray(id, array_of_id) > -1) {
                array_of_id.forEach(element => {
                    if (element === id) {
                        appearence++;
                    }
                });
            }
            $.get("{{route('precautions.getColor')}}", {
                    id: id
                },
                function(data) {

                    if (appearence % 2 != 0) {
                        $("div[id='" + id + "']").css("background", data.result.result.color_code);
                    } else {
                        $("div[id='" + id + "']").css("background", "none");
                    }
                }, "json");

            $("input[id='" + id + "']").prop('checked', function(_, checked) {
                return !checked;
            });

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
<script type="text/javascript">
    {{--$(document).ready(function() {--}}
    {{--    setInterval(function() {--}}
    {{--        $(".sidebar").load(--}}
    {{--            $.get("{{url('countNotification')}}",--}}
    {{--                function(data) {--}}
    {{--                    $('#notification_count').html(data.result.result);--}}
    {{--                }, "json")--}}
    {{--        )--}}
    {{--    }, 5000);--}}

    {{--});--}}
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
        $("#precaution_wrapper>.row>.col-md-6").first().text('PreCaution List');
        $("#patienttable_wrapper>.row>.col-md-6").first().text('Master Patient List');
        $("#queuePatienttable_wrapper>.row>.col-md-6").first().text('Queued Patient List');
        $("#dischargepatienttable_wrapper>.row>.col-md-6").first().text('Discharged Patient List');
        $("#dashboardPatientTable_wrapper>.row>.col-md-6").first().text('Current Patient List');
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
        $(document).on('click', '.edit_location', function() {
            var id = $(this).attr("id");
            $.get("{{route('locations.locationInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_location_name').val(data.result.name);
                    action = "{{route('locations.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_location_modal').modal('show');
        });
    });
</script>

<script>
    $("document").ready(function() {
        $(document).on('click', '.edit_affect', function() {
            var id = $(this).attr("id");
            $.get("{{route('affects.affectInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_affect_name').val(data.result.affect_name);
                    action = "{{route('affects.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_affect_modal').modal('show');
        });
    });
</script>
<script>
    $("document").ready(function() {
        $(document).on('click', '.edit_behavior', function() {
            var id = $(this).attr("id");
            $.get("{{route('behaviors.behaviorInfoById')}}", {
                    id: id
                },
                function(data) {
                    $('#edit_behavior_name').val(data.result.behavior_name);
                    action = "{{route('behaviors.update')}}" + '?id=' + data.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#edit_behavior_modal').modal('show');
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
        $(document).on('click', '.edit_bed', function() {
            var id = $(this).attr("id");
            $.get("{{route('beds.edit')}}", {
                    id: id
                },
                function(data) {
                    var selected_item = data.result.result.room_id;
                    if (data.result.room.length > 0) {
                        for (var i = 0; i < data.result.room.length; i++) {
                            if (data.result.room[i].id == selected_item) {
                                selected = ' selected="selected" ';
                            } else {
                                selected = '';
                            }
                            $('#edit_room_no').append('<option value = \"' + data.result.room[i].id + '\" ' + selected + '>' + data.result.room[i].room_no + '</option>');
                        }
                    }
                    $('#edit_bed_no').val(data.result.result.bed_no);
                    action = "{{route('beds.update')}}" + '?id=' + data.result.result.id;
                    $('#frm').attr('action', action);
                }, "json");
            $('#editBedModal').modal('show');
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