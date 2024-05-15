jQuery(document).ready(function ($) {

    $('#submitButton').click(function () {
        var selectedYear = $('#startYear').val();
        var nextYear = parseInt(selectedYear) + 1;
        var yearRange = selectedYear + ' - ' + nextYear;
        $('#divToUpdate').text(yearRange);
    });

    var table = $('#thisdatatable').DataTable({
        scrollResize: true,
        pageResize: true,
        serverSide: true,
        pageLength: 25,
        fixedHeader: false,
        scrollX: true,
        select: false,
        ajax: {
            url: dataTableUrl,
            type: 'GET',

        },
        columns: [{
            data: 'lname',
        },
        {
            data: 'fname',
        },
        {
            data: 'mname',
        },
        {
            data: 'spasno',
        },
        {
            data: 'email',

        },
        {
            data: 'app_id',
        },
        {
            data: 'strand',
        },
        {
            data: 'progname',
        },
        {
            data: 'gendername',
            render: function (data, type, row) {
                // Apply custom styles to the email address
                var styledgender = '<span style="padding-right: 10px;">' + data +
                    '</span>';
                return styledgender;
            },
        },
        {
            data: 'bday',
        },
        {
            data: 'mobile',
        },
        {
            data: 'houseno',
        },
        {
            data: 'street',
        },
        {
            data: 'village',
        },
        {
            data: 'barangay',
        },
        {
            data: 'municipality',
        },
        {
            data: 'province',
        },
        {
            data: 'zipcode',
        },
        {
            data: 'district',
        },
        {
            data: 'region',
        },
        {
            data: 'hsname',
        },
        {
            data: 'remarks',
        },
        {
            data: 'scholar_status_id',

        },
        {
            data: null,
            orderable: false,
            searchable: false,
            className: 'action-column',
            render: function (data, type, row) {
                var number = row.id;
                return '' + '<a class="table-edit" data-id="' + number +
                    '">Edit</a>' + ''
            }
        },



        ],
        scrollX: true,
        order: [
            [1, 'asc'] //set batch sort from lowest
        ],
        fixedColumns: {
            right: 1,
            left: 1,
        },
        columnDefs: [{
            targets: 'action-column', // Use a class to target the specific column
            className: 'text-center',
        },
        {

            targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, , 9, , 10, 11, 12, 13, 14, 15, 16],
            orderable: false,
        }, {
            visible: false,
            searchable: true,
            targets: 22,


        }

        ],
        "createdRow": function (row, data, dataIndex) {
            if (data.scholar_status_id != '0') {
                $(row).find('td:first-child')
                    .css('color', 'green')
                    .css('font-weight', 'bold');

            }
        },
        drawCallback: function (settings) {
            var api = this.api();

            api.columns([6, 7, 8, 15, 16]).every(function (d) {
                var column = this;

                var theadname = $(api.column(d).header()).text();
                //
                var select = column.header().querySelector('select');


                if (!select || select.options.length === 0) {
                    select = document.createElement('select');
                    //
                    select.style.padding = '1px';
                    //
                    select.add(new Option(' ' + theadname, ''));

                    column.header().replaceChildren(select);

                    //
                    select.addEventListener('change', function () {
                        var val = DataTable.util.escapeRegex(select.value);

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                    //
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            // Skip theadname from the dropdown options
                            if (d !== theadname) {
                                select.add(new Option(d));
                            }
                        });
                }
            });
        },
    });





    $(document).on('click', '.table-edit', function () {
        var number = $(this).data('id');
        // alert(number);
        // Show the modal


        let modal = new bootstrap.Modal('#editModal');
        modal.show()

        $.ajax({
            url: getSeirecord + '/' + number,
            method: 'GET',
            success: function (data) {
                $('#editModal #IdField').val(data.id);
                $('#editModal #AppIDField').val(data.app_id);
                $('#editModal #EmailField').val(data.email);
                $('#editModal #RemarksField').val(data.remarks);
                $('#editModal #ProgramField').val(data.program_id);
                $('#editModal #StrandField').val(data.strand);
                $('#editModal #ContactField').val(data.mobile);
                $('#editModal #SurnameField').val(data.lname);
                $('#editModal #FirstnameField').val(data.fname);
                $('#editModal #MiddlenameField').val(data.mname);
                $('#editModal #DistrictField').val(data.district);
                $('#editModal #CourseField').val(data.course);
                $('#editModal #SchoolField').val(data.school);
            },
            error: function (error) {
                console.error('Error fetching data for editing:', error);
            }
        });


        $('#editModal').on('hidden.bs.modal', function () {
            $(this).trigger('reset'); ///works
        })

        $('#saveChangesBtn').off('click').click(function () {

            var selectElementProgram = document.querySelector('#ProgramField');
            var selectElementGender = document.querySelector('#GenderField');
            var selectedValueProgram = parseInt(selectElementProgram.value, 10);
            var selectedValueGender = parseInt(selectElementGender.value, 10);
            //
            var updatedData = {
                app_id: $('#editModal #AppIDField').val(),
                email: $('#editModal #EmailField').val(),
                program_id: $('#editModal #ProgramField').val(),
                remarks: $('#editModal #RemarksField').val(),
                strand: $('#editModal #StrandField').val(),
                mobile: $('#editModal #ContactField').val(),
                lname: $('#editModal #SurnameField').val(),
                fname: $('#editModal #FirstnameField').val(),
                mname: $('#editModal #MiddlenameField').val(),
                gender_id: $('#editModal #GenderField').val(),
                school: $('#editModal #SchoolField').val(),
                course: $('#editModal #CourseField').val(),

            };


            $.ajax({
                url: saveSeirecord + '/' + number, //
                method: 'POST', //
                data: updatedData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    //
                    Swal.fire({
                        icon: "success",
                        title: "",
                        text: 'Record has been edited',
                    });
                    //
                    var dataTable = $('#thisdatatable').DataTable();
                    table.ajax.reload(null, false);
                    $('#editModal input').val('');
                    $('#editModal').modal(
                        'hide'
                    ); //

                },
                error: function (error) {
                    console.error('Error saving changes:', error);
                }
            });
        });

    });

    $('#yearForm').on('submit', function (e) { //DONT DELETE
        e.preventDefault();
        var startYear = $(this).find('select[name="startYear"]').val();
        table.ajax.url("seilistviewajax?startYear=" + startYear).load();
    });



});
