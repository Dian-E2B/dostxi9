var startyearValue = $('#startyear').val();
var endyearValue = $('#endyear').val();
var semesterValue = $('#semester').val();

$(function () {
    $("#datepicker").datepicker({
        dateFormat: "MM d, yy",
        showOtherMonths: true,
        selectOtherMonths: true
    });
});

function showSuggestionsAlertRemarks() {
    Swal.fire({
        title: 'Select Remarks',
        html: '<ul class="list-group">' +
            '<li class="list-group-item btn btn-light btn-sm" onclick="selectSuggestion(\'tuition + stipend - OK\')">tuition + stipend - OK</li>' +
            '<li class="list-group-item btn btn-light  btn-sm" onclick="selectSuggestion(\'stipend - OK\')">stipend - OK</li>' +
            '</ul>',
        showCloseButton: true,
        showConfirmButton: false,
    });
}

function selectSuggestion(suggestion) {
    var remarksInput = document.getElementById('remarksField');
    remarksInput.value = suggestion;
    Swal.close();
}

function showStatusEndorsementSuggestionsAlert() {
    Swal.fire({
        title: 'Select a status endorsement',
        html: '<ul class="list-group">' +
            '<li class="list-group-item" onclick="selectStatusEndorsement(\'NO COR\')">NO COR</li>' +
            '<li class="list-group-item" onclick="selectStatusEndorsement(\'LOA: PENDING APPLICATION\')">LOA: PENDING APPLICATION</li>' +
            '</ul>',
        showCloseButton: true,
        showConfirmButton: false,
    });
}

function selectStatusEndorsement(option) {
    var statusEndorsementInput = document.getElementById('statusEndorsement2Field');
    statusEndorsementInput.value = option;
    Swal.close(); // Close the SweetAlert popup
}

jQuery(document).ready(function ($) {

    $('#getSelectedRows').hide();

    var semesterValue2;

    if (semesterValue == 1) {
        semesterValue2 = semesterValue + 1;
    } else if (semesterValue == 2) {
        semesterValue2 = semesterValue - 1;
    } else {
        semesterValue2 = "SUMMER";
    }


    var url = '{{ route('getongoinglistgroupsajaxviewclicked') }}';
    var selectedRows = [];
    var table = $('#yourDataTable').DataTable({
        orderCellsTop: true,
        select: true,
        serverSide: true,
        pageLength: 100,
        ajax: {
            url: url,
            type: 'GET',
            data: {
                startyear: startyearValue,
                endyear: endyearValue,
                semester: semesterValue
            },
        },
        columns: [

            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'action-column',

                render: function (data, type, row) {
                    var number = row
                        .NUMBER; // Assuming 'NUMBER' is the column name in your database
                    return '<td class="">' +
                        '<a href="#" class="edit-btn" data-number="' + number +
                        '"><i class="bi bi-pencil-fill"></i><a href="#" class="view-btn" data-number="' +
                        number +
                        '"><i class="bi bi-eye-fill"></i></a>' +
                        '</td>';
                }
            },

            {
                className: 'action-column',
                data: 'BATCH',

            },
            {
                className: 'action-column',
                data: 'NUMBER',

            },
            {
                data: 'NAME',

            },
            {
                className: 'MF-column',
                data: 'MF',
                render: function (data, type, row) {
                    // Apply custom styles to the email address
                    var styledgender =
                        '<span style="width: 3% !important">' + data +
                        '</span>';
                    return styledgender;
                },

            },
            {
                className: 'action-column',
                data: 'SCHOLARSHIPPROGRAM',
                render: function (data, type, row) {
                    // Apply custom styles to the email address
                    var styledprogram = '<span style="text-align:center !important">' + data +
                        '</span>';
                    return styledprogram;
                }

            },
            {
                className: 'action-column',
                data: 'SCHOOL',
                render: function (data, type, row) {
                    // Apply custom styles to the email address
                    var styledschool = '<span >' + data +
                        '</span>';
                    return styledschool;
                }
            },
            {
                className: 'action-column',
                data: 'COURSE',

                render: function (data, type, row) {
                    // Apply custom styles to the email address
                    var stylecourse = '<span>' + data +
                        '</span>';
                    return '<td class="" style="color: blue;">' + stylecourse + '</td>';
                }

            },
            {

                className: 'action-column',
                data: 'GRADES',
                name: 'GRADES' + semesterValue2 + 'SEM' + startyearValue - 1 + endyearValue - 1,


            },
            {
                className: 'action-column',
                data: 'SummerREG',

            },
            {
                className: 'action-column',
                data: 'REGFORMS',

            },
            {
                className: 'action-column',
                data: 'REMARKS',

            },
            {
                data: 'STATUSENDORSEMENT',

            },
            {
                data: 'STATUSENDORSEMENT2',

            },
            {
                data: 'STATUS',
                render: function (data, type, row) {

                    if (data === null) {
                        return "";
                    }

                    var stylestatus = '<span>' + data + '</span>';
                    return stylestatus;
                }
            },
            {
                data: 'NOTATIONS',

            },
            {
                data: 'SUMMER',

            },
            {
                data: 'FARELEASEDTUITION',

            },
            {
                data: 'FARELEASEDTUITIONBOOKSTIPEND',

            },
            {
                data: 'LVDCAccount',

            },
            {
                data: 'HVCNotes',

            },
            {
                data: 'startyear',

            },
            {
                data: 'endyear',

            },


        ],
        columnDefs: [{
            targets: 'action-column', // Use a class to target the specific column
            className: 'text-center',
        },
        {
            targets: 'MF-column', // Use a class to target the specific column
            orderable: false,
            searchable: false,
        },
        {
            targets: [0, 2], // Index of the "No" column, now correctly targeting the first column (0)
            orderable: false,
            searchable: false,
        },
        {
            targets: [1, 2, 3, 5, 6, 7, 8, 9, 19, 4, 10, 11, 12, 13, 14, 15, 16, 17, 18, 20], // Adjusted to correctly target the intended columns
            orderable: false,
        },
        ],

        scrollX: true,
        order: [
            /*   [1, 'asc'] //set batch sort from lowest */
        ],
        fixedColumns: {
            leftColumns: 1,
        },
        createdRow: function (row, data, dataIndex) {
            $(row).find('.action-column').addClass('text-center');
        },
        drawCallback: function (settings) {
            var api = this.api();
            api.columns([4, 5, 6, 7]).every(function (d) {
                var column = this;
                var theadname = $(api.column(d).header()).text();
                var select = column.header().querySelector('select');

                if (!select || select.options.length === 0) {
                    select = document.createElement('select');
                    select.style.padding = '2px';
                    select.add(new Option(' ' + theadname, ''));
                    column.header().replaceChildren(select);
                    select.addEventListener('change', function () {
                        var val = DataTable.util.escapeRegex(select.value);
                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });
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
            /*  let start = table.page.info().start;
             let i = start + 1;
             table
                 .column(2, {
                     search: 'applied',
                     order: 'applied'
                 })
                 .nodes()
                 .each(function(cell, index) {
                     cell.innerHTML = i++;
                 }); */
        },

    });


    /*  $('#yourDataTable').on('search.dt', function() {
         $(this).DataTable().columns.adjust();
         //  table.columns.adjust().draw();
     }); */



    $('#nav-Ongoing-tab').click(function () {
        table.columns.adjust().draw();
    });

    var selectAllClicked = false;
    $('#selectAllRows').on('click', function () {
        selectAllClicked = !selectAllClicked;
        if (selectAllClicked) {
            table.rows().select();

        } else {
            table.rows().deselect();
        }
    });
    $('#getSelectedRows2').on('click', function () {
        var selectedRows = table.rows({
            selected: true
        }).data().toArray();
        var selectedRowIds = selectedRows.map(row => row.NUMBER); // Assuming 'id' is the column name containing the IDs
        var startYear = $('#startyear').val();
        var semester = $('#semester').val();
        var datepicker = $('#datepicker').val();
        axios.post('/endorseongoing', {
            selectedRowIds: selectedRowIds,
            startYear: startYear,
            semester: semester,
            datepicker: datepicker
        })
            .then(function (response) {
                /*  console.log('Selected rows data sent successfully:', response.data); */
                Swal.fire({
                    title: 'Endorsed!',
                    text: 'Scholar(s) has ben endorsed!',
                    icon: 'success',
                    confirmButtonText: 'Okay',
                })
                table.ajax.reload(null, false);
                table.columns.adjust().draw();

            })
            .catch(function (error) {
                console.error('Error sending selected rows data:', error);

            });
    });


    table.on('select deselect', function () { //
        var selectedRowsCount = table.rows({
            selected: true
        }).count();
        if (selectedRowsCount > 0) {
            $('#getSelectedRows').show();
        } else {
            $('#getSelectedRows').hide();
        }
    });


    $(document).on('click', '.view-btn', function () {
        var number = $(this).data('number');
        var url = '{{ url(' / viewscholarrecords / ') }}' + '/' + number;
        window.location.href = url;
    });

    $(document).on('click', '.edit-btn', function () {
        var number = $(this).data('number');


        axios.get(`/get-ongoing/${number}/${semesterValue}/${startyearValue}`)
            .then(response => {
                const data = response.data;
                document.querySelector('#editModal #idField').value = data.NUMBER;
                document.querySelector('#editModal #nameField').value = data.NAME;
                document.querySelector('#editModal #genderField').value = data.MF;
                document.querySelector('#editModal #programField').value = data.SCHOLARSHIPPROGRAM;
                document.querySelector('#editModal #schoolField').value = data.SCHOOL;
                document.querySelector('#editModal #courseField').value = data.COURSE;
                document.querySelector('#editModal #gradesField').value = data.GRADES;
                document.querySelector('#editModal #summerRegField').value = data.SummerREG;
                document.querySelector('#editModal #regFormsField').value = data.REGFORMS; //ongoingregforms table
                document.querySelector('#editModal #remarksField').value = data.REMARKS; //ongoingremarks table
                document.querySelector('#editModal #statusEndorsementField').value = data.STATUSENDORSEMENT;
                document.querySelector('#editModal #statusEndorsement2Field').value = data.STATUSENDORSEMENT2;
                document.querySelector('#editModal #statusField').value = data.STATUS;
                document.querySelector('#editModal #notationsField').value = data.NOTATIONS;
                document.querySelector('#editModal #summerField').value = data.SUMMER;
                document.querySelector('#editModal #faReleaseTuitionField').value = data.FARELEASEDTUITION;
                document.querySelector('#editModal #faReleaseTuitionBookStipendField').value = data.FARELEASEDTUITIONBOOKSTIPEND;
                document.querySelector('#editModal #lvdCAccountField').value = data.LVDCAccount;
                document.querySelector('#editModal #hvcNotesField').value = data.HVCNotes;
                document.querySelector('#editModal #startyearField').value = data.startyear;
                document.querySelector('#editModal #endyearField').value = data.endyear;
                document.querySelector('#editModal #semesterField').value = data.semester;
                // Show the offcanvas
                const editModalElement = document.getElementById('editModal');
                const editModal = bootstrap.Offcanvas.getInstance(editModalElement) || new bootstrap.Offcanvas(editModalElement);
                editModal.show();
            })
            .catch(error => {
                console.error('Error fetching data for editing:', error);
            });


        /*   $.ajax({
              url: '{{ url('/get-ongoing/') }}' + '/' + number + '/' + semesterValue + '/' + startyearValue,
              method: 'GET',
              success: function(data) {
                  $('#editModal #idField').val(data.NUMBER);
                  $('#editModal #nameField').val(data.NAME);
                  $('#editModal #genderField').val(data.MF);
                  $('#editModal #programField').val(data.SCHOLARSHIPPROGRAM);
                  $('#editModal #schoolField').val(data.SCHOOL);
                  $('#editModal #courseField').val(data.COURSE);
                  $('#editModal #gradesField').val(data.GRADES);
                  $('#editModal #summerRegField').val(data.SummerREG);
                  $('#editModal #regFormsField').val(data.REGFORMS); //ongoingregforms table
                  $('#editModal #remarksField').val(data.REMARKS); //ongoingremarks table
                  $('#editModal #statusEndorsementField').val(data.STATUSENDORSEMENT);
                  $('#editModal #statusEndorsement2Field').val(data.STATUSENDORSEMENT2);
                  $('#editModal #statusField').val(data.STATUS);
                  $('#editModal #notationsField').val(data.NOTATIONS);
                  $('#editModal #summerField').val(data.SUMMER);
                  $('#editModal #faReleaseTuitionField').val(data.FARELEASEDTUITION);
                  $('#editModal #faReleaseTuitionBookStipendField').val(data.FARELEASEDTUITIONBOOKSTIPEND);
                  $('#editModal #lvdCAccountField').val(data.LVDCAccount);
                  $('#editModal #hvcNotesField').val(data.HVCNotes);
                  $('#editModal #startyearField').val(data.startyear);
                  $('#editModal #endyearField').val(data.endyear);
                  $('#editModal #semesterField').val(data.semester);
                  $('#editModal').offcanvas('show');

              },
              error: function(error) {
                  console.error('Error fetching data for editing:', error);
              }
          }); */

        /* Save Changes Button */
        //TODO
        $('#saveChangesBtn').off('click').click(function () {
            // Gather the updated data from the modal fields
            var updatedData = {
                /*  NUMBER: $('#editModal #idField').val(), */
                NAME: $('#editModal #nameField').val(),
                MF: $('#genderField').val(),
                SCHOLARSHIPPROGRAM: $('#editModal #programField').val(),
                SCHOOL: $('#editModal #schoolField').val(),
                COURSE: $('#editModal #courseField').val(),
                GRADES: $('#editModal #gradesField').val(),
                SummerREG: $('#editModal #summerRegField').val(),
                REGFORMS: $('#editModal #regFormsField').val(), //ongoingregforms table
                STATUSENDORSEMENT: $('#editModal #statusEndorsementField').val(),
                STATUSENDORSEMENT2: $('#editModal #statusEndorsement2Field').val(),
                STATUS: $('#editModal #statusField').val(),
                NOTATIONS: $('#editModal #notationsField').val(),
                SUMMER: $('#editModal #summerField').val(),
                FARELEASEDTUITION: $('#editModal #faReleaseTuitionField').val(),
                FARELEASEDTUITIONBOOKSTIPEND: $('#editModal #faReleaseTuitionBookStipendField').val(),
                LVDCAccount: $('#editModal #lvdCAccountField').val(),
                HVCNotes: $('#editModal #lvdCAccountField').val(),
                HVCNotes: $('#editModal #lvdCAccountField').val(),
                /*    semester: $('#editModal #semesterField').val(),
                   startyear: $('#editModal #startyearField').val(),
                   endyear: $('#editModal #endyearField').val(), */
                REMARKS: $('#editModal #remarksField').val(), //ongoingremarks table
            };

            axios.post(`/savechangesongongoing/${number}`, updatedData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => {
                    console.log(response);
                    Swal.fire({
                        icon: 'success',
                        text: 'Record has been edited',
                        title: 'Success!',
                    });

                    // Redraw the DataTable
                    table.ajax.reload(null, false);
                    document.querySelectorAll('#editModal input').forEach(input => input.value = '');
                    let myOffCanvas = document.getElementById('editModal');
                    let openedCanvas = bootstrap.Offcanvas.getInstance(myOffCanvas);
                    openedCanvas.hide();
                })
                .catch(error => {
                    console.error('Error saving changes:', error);
                });

        });

    });

    var columnsToHide = [1, 2, 21, 22, 22];
    columnsToHide.forEach(function (columnIndex) {
        table.column(columnIndex).visible(false);
    });

});

function customExportAction(e, dt, button, config) {

    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        //
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {

            $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            dt.one('preXhr', function (e, s, data) {
                //
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            //
            setTimeout(dt.ajax.reload, 0);

            return false;
        });
    });
    dt.ajax.reload();

}


$.extend(true, $.fn.dataTable.defaults, {

    dom: 'flrtipB',
    buttons: [{
        extend: 'print',

        autoPrint: true,
        orientation: 'landscape',
        pageSize: 'A4',
        text: '<i class="bi bi-printer-fill"></i>',
        title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
        exportOptions: {
            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15],
            modifier: {
                search: 'none'
            }
        },
        action: customExportAction,
        customize: function (win) {
            $(win.document.body).css({
                'background-color': '#fff', //

            });
            $(win.document.body).find('table td').css({
                'white-space': 'normal',
                'word-wrap': 'break-word'
            });

            //ADDED APRIL 8 2024
            $(win.document.body).find('div.DTTT_container').remove();

            $(win.document.body).find('table td:nth-child(3)').css({
                'white-space': 'nowrap',
                'word-wrap': 'normal'
            });
            $(win.document.body).find('table td:nth-child(6)').css({
                'white-space': 'nowrap',
                'word-wrap': 'normal'
            });


            $(win.document.body).find('h1').css('font-size', '50pt');
            $(win.document.body).find('h1').css('font-weight', 'bold');
            if (win.document.body.innerHTML.indexOf('<img id="logo"') === -1) {
                $(win.document.body).prepend(
                    '<img id="logo" src="{{ asset('icons / DOSTlogoONGOING.jpg') }}">');
            }
            $(win.document.body)
                .css('font-size', '36pt')
                .find('td')
                .css('font-size', '36pt')
                .css('background-color', 'white')
            $(win.document.body).find('table td').css({
                'border': '1px solid black',
                'border': 'none !important',



            });
            $(win.document.body).find('table th').css({
                'border': 'none !important',
            });


            $(win.document.body).find('table td, table th').css({
                'padding-left': '0.5rem',
                'padding-right': '0.5rem'
            });

            $(win.document.body).find('table thead th').each(function (index) {
                var customHeaderName;
                switch (index) {
                    case 0:
                        customHeaderName = 'BATCH';
                        break;
                    case 1:
                        customHeaderName =
                            'No'; // Change the second column header to 'No'
                        break;
                    case 2:
                        customHeaderName = 'NAME';
                        break;
                    case 3:
                        customHeaderName = 'M/F';
                        break;
                    case 4:
                        customHeaderName = 'SCHOLARSHIP\nPROGRAM';
                        break;
                    case 5:
                        customHeaderName = 'School';
                        break;
                    case 6:
                        customHeaderName = 'Course';
                        break;
                    case 7:
                        customHeaderName = 'Grades';
                        break;
                    case 8:
                        customHeaderName = 'Summer\nREG';
                        break;
                    case 9:
                        customHeaderName = 'REG\nFORMS';
                        break;
                    case 10:
                        customHeaderName = 'REMARKS';
                        break;
                    case 11:
                        customHeaderName = 'ENDORSEMENT';
                        break;
                    case 12:
                        customHeaderName = 'STATUS';
                        break;
                    case 13:
                        customHeaderName = 'NOTATION';
                        break;

                    default:
                        customHeaderName = 'Default Header';
                }
                $(this).text(customHeaderName);
                $(this).css({
                    'font-size': '40pt',
                    'white-space': 'pre-wrap',
                    'border': '1px solid black', //
                });
            });
            $(win.document.body).find('table tbody td:nth-child(2)').each(function (index) {

                $(this).text(index + 1); //modified dec 18 2023
            });
            $(win.document.body).find('table').removeClass('table-striped');
            var style = 'table { width: 100%; } ';
            var head = win.document.head || win.document.getElementsByTagName('head')[0];
            var link = document.createElement('style');
            link.type = 'text/css';
            link.appendChild(document.createTextNode(style));
            head.appendChild(link);
        },

    },
        /*   {
              extend: 'excel',
              text: '<i class="fas fa-file-excel"></i>',
              title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
              exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                  modifier: {
                      search: 'none'
                  }
              },
          },
          {
              extend: 'csv',
              text: '<i class="fas fa-file-csv"></i>',
              title: 'ON-GOING SCHOLARS MONITORING CHECKLIST {{ session('semester') }} AY {{ session('startyear') }}-{{ session('endyear') }}',
              exportOptions: {
                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14],
                  modifier: {
                      search: 'none'
                  }
              },
          }, */

    ]
});
