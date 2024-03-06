<!DOCTYPE html>
<html lang="en">

    <head>
        <title>DOST XI</title>
        <link rel="icon" href="\icons\DOSTLOGOsmall.png" type="image/x-icon" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <style>
        #programportioncounter td {
            vertical-align: middle !important;
        }

        .portionicon {
            padding: 1px;
            margin-right: 5px;
            font-size: 12pt;
        }

        #programportioncounter-body {
            font-size: 17px;
        }

        .card {
            padding: 2%;
            margin-top: 6px !important;
            margin-bottom: 6px !important;
        }

        .gendercard,
        .programcard {
            margin-botom: 0% !important;
        }

        .coursecard {
            margin-top: 0% !important;
        }


        .programportioncard,
        .genderportioncard {
            box-shadow: 1px 2px 5px 4px rgb(214, 214, 214);
        }
    </style>

    <body>
        @include('layouts.headernew') {{-- HEADER START --}}
        @include('layouts.sidebarnew') {{-- SIDEBAR START --}}
        <main id="main" class="main">

            @include('dashboardbody')

        </main>

    </body>
    {{-- CHART TOGGLING --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.1/chart.min.js" integrity="sha512-2uu1jrAmW1A+SMwih5DAPqzFS2PI+OPw79OVLS4NJ6jGHQ/GmIVDDlWwz4KLO8DnoUmYdU8hTtFcp8je6zxbCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script>
        Chart.register(ChartDataLabels);
        var ongoingPROGRAM;
        var startYears;
        var scholarshipPrograms;
        var datasets;

        /* Start ProgramChart */
        ongoingPROGRAM = @json($ongoingPROGRAM);
        startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
        scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item.scholarshipprogram))];

        datasets = scholarshipPrograms.map(function(program, index) {
            return {
                label: program,
                data: startYears.map(year => {
                    var match = ongoingPROGRAM.find(item => item.startyear === year && item
                        .scholarshipprogram === program);
                    return match ? match.scholarshipprogramcount : 0;
                }),
                borderColor: getPredefinedColor(index),
                borderWidth: 3,
                fill: false,
                backgroundColor: getPredefinedColor(index), // Solid color for the area under the line
            };
        });

        /* customize x label (program) */
        var labelsprogram = startYears.map((year, index) => {
            if (index < startYears.length - 1) {
                return year + "-" + (year + 1);
            } else {
                return year + "-" + (year + 1);
            }
        });


        /* ProgramChart Setup */
        var myProgramChart = document.getElementById('myProgramChart').getContext('2d');
        window.myProgramChart = new Chart(myProgramChart, {
            type: 'line',
            data: {
                labels: labelsprogram,
                datasets: datasets,
            },
            options: {
                animation: {
                    tension: {
                        duration: 2000,
                        easing: 'linear',
                        from: 0.4,
                        to: 0,
                        loop: true
                    }
                },
                responsive: true,

                scales: {
                    x: {
                        type: 'category',
                        labels: labelsprogram,
                    },
                    y: {
                        beginAtZero: !0,
                    },
                },

                plugins: {
                    legend: {
                        labels: {

                            color: 'black', // Set the legend label color here

                        },
                    },
                    datalabels: {
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold',
                            size: 11.5 // change this to your preferred font size
                        },
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: !1,
                    },
                    zoom: {
                        zoom: {
                            wheel: {
                                enabled: true,
                            },
                            pinch: {
                                enabled: true
                            },
                            mode: 'x',
                        }
                    },
                },
            },
        });

        /* ProgramChart Part */
        function getPredefinedColor(index) {
            var predefinedColors = ['#ff3333', '#cccc00', '#ff00cc'];
            return predefinedColors[index % predefinedColors.length];
        }

        /* Start ProgamChartPortion*/
        var ctxPROGRAMPIE = document.getElementById('myPieChart').getContext('2d');
        var dataPROGRAM = @json($ongoingPROGRAMcounter);
        var labelsPROGRAM = [];
        var countsPROGRAM = [];

        dataPROGRAM.forEach(item => { // Use dataPROGRAM instead of data
            labelsPROGRAM.push(item.scholarshipprogram);
            countsPROGRAM.push(item.scholarshipprogramcount);
        });

        var myPieChart = new Chart(ctxPROGRAMPIE, {
            type: 'pie',
            data: {
                labels: labelsPROGRAM, // Use labelsPROGRAM
                datasets: [{
                    data: countsPROGRAM, // Use countsPROGRAM
                    backgroundColor: [
                        '#ff3333',
                        '#cccc00',
                        '#ff00cc',
                    ],
                }]
            },
            options: {
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'linear',

                },

                plugins: {
                    legend: {
                        labels: {
                            color: 'black' // Set the legend label color here
                        },
                        position: 'left',
                    },
                    datalabels: {
                        formatter: (value, ctxPROGRAMPIE) => {
                            let sum = 0;
                            let dataArr = ctxPROGRAMPIE.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(1) + "%";
                            return percentage;
                        },
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold',
                            size: 12.5 // change this to your preferred font size
                        },
                    }
                },

            },
        });


        /* Start GenderChart */
        ongoingGender = @json($ongoingGender);
        startYearsGender = [...new Set(ongoingGender.map(item => item.startyear))];
        scholarshipGender = [...new Set(ongoingGender.map(item => item.MF))];
        datasetsGender = scholarshipGender.map(function(gender, index) {
            return {
                label: gender,
                data: startYearsGender.map(year => {
                    var match = ongoingGender.find(item => item.startyear === year && item.MF === gender);
                    return match ? match.MFcount : 0;
                }),
                borderColor: getPredefinedColorGender(index),
                borderWidth: 3,
                fill: false,
                backgroundColor: getPredefinedColorGender(index), // Solid color for the area under the line
            };
        });

        /* customize x label (gender) */
        var labelsprogram = startYearsGender.map((year, index) => {
            if (index < startYearsGender.length - 1) {
                return year + "-" + (year + 1);
            } else {
                return year + "-" + (year + 1);
            }
        });

        /* Gender Chart Setup */
        var myGenderChart = document.getElementById('myGenderChart').getContext('2d');
        window.myGenderChart = new Chart(myGenderChart, {
            type: 'line',
            data: {
                labels: labelsprogram,
                datasets: datasetsGender,
            },
            options: {
                animation: {
                    tension: {
                        duration: 2000,
                        easing: 'linear',
                        from: 0.4,
                        to: 0,
                        loop: true
                    }
                },

                scales: {
                    x: {
                        type: 'category',
                        labels: labelsprogram,
                    },
                    y: {
                        beginAtZero: !0,
                    },
                },
                plugins: {
                    datalabels: {
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold',
                            size: 12.5 // change this to your preferred font size
                        },
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: !1,
                    },
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'x',
                        },
                        zoom: {
                            enabled: true,
                            mode: 'x',
                        },
                    },
                    legend: {
                        display: !0,
                        labels: {
                            boxWidth: 20,
                            usePointStyle: !0,

                            color: 'black',

                        },
                    },
                },
            },
        });

        /* Gender Chart Colors */
        function getPredefinedColorGender(index) {
            var predefinedColors = ['#FFC0CB', '#33ff33'];
            return predefinedColors[index % predefinedColors.length];
        }

        /* Gender Chart Proportion */
        var ctxgenderproportion = document.getElementById('myGenderPie').getContext('2d');
        var datagender = @json($ongoingGendercounter);
        var labelsgender = [];
        var countsgender = [];

        datagender.forEach(item => {
            labelsgender.push(item.MF);
            countsgender.push(item.MFcount);
        });

        var myGenderPieChart = new Chart(ctxgenderproportion, {
            type: 'pie',
            data: {
                labels: labelsgender,
                datasets: [{
                    data: countsgender,
                    backgroundColor: ['#FFC0CB', '#33ff33', ],
                }]
            },
            options: {


                maintainAspectRatio: false,
                animation: {
                    duration: 1500, // duration of the animation in milliseconds
                    easing: 'linear', // easing function to use

                },
                responsive: true,

                plugins: {
                    legend: {
                        position: 'left',
                        labels: {
                            color: 'black' // Set the legend label color here
                        }

                    },
                    datalabels: {

                        formatter: (value, ctxgenderproportion) => {
                            let sum = 0;
                            let dataArr = ctxgenderproportion.chart.data.datasets[0].data;
                            dataArr.map(data => {
                                sum += data;
                            });
                            let percentage = (value * 100 / sum).toFixed(1) + "%";
                            return percentage;
                        },
                        color: 'black', // change this to your preferred color
                        font: {
                            weight: 'bold'
                        },
                    },
                },
            },
        });

        /* Start Of Course Chart */
        var ctxcourse = document.getElementById('myCoursesChart').getContext('2d');
        var myCoursesChart = new Chart(ctxcourse, {
            type: 'bar',
            data: {
                labels: @json($dataCourses['labelscourses']),
                datasets: [{
                    label: 'Scholarship Courses Currently Availed ',
                    data: @json($dataCourses['datascourses']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                onClick: function(event, elements) {
                    // Check if a bar was clicked
                    if (elements.length > 0) {
                        // Access the clicked bar's data
                        var clickedLabel = myCoursesChart.data.labels[elements[0].index];
                        var clickedValue = myCoursesChart.data.datasets[0].data[elements[0].index];

                        // Your custom logic when a bar is clicked
                        console.log('Clicked:', clickedLabel, 'with value:', clickedValue);
                    }
                },
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },
                plugins: {
                    legend: {
                        labels: {
                            color: 'black',

                        }
                    },
                }

            },
        });

        /* ongoingProvinces chart */
        var ctxprovinces = document.getElementById('myProvincesChart').getContext('2d');
        var provincesColors = ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 205, 86, 0.2)',
            'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'
        ]; // Add more colors as needed
        window.myProvinceChart = new Chart(ctxprovinces, {
            type: 'doughnut',
            data: {
                labels: @json($dataProvinces['labelsprovince']),
                datasets: [{
                    label: @json($dataProvinces['labelsprovince']),
                    data: @json($dataProvinces['datasprovince']),
                    backgroundColor: provincesColors,

                    borderWidth: 2
                }]
            },
            options: {

                plugins: {
                    datalabels: {
                        font: {
                            weight: 'bold',
                            size: 14,
                        },
                        color: 'black',
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                    legend: {
                        position: 'left',
                        labels: {
                            color: "black",
                        },
                    },
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },

            },
        });


        document.addEventListener("DOMContentLoaded", function(event) {
            /* Filter Submit Program */
            $('#programyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {

                    // console.log(response);
                    //Destroy the existing chart
                    if (window.myProgramChart) {
                        // window.myProgramChart.destroy();
                        ongoingPROGRAM = response.ongoingPROGRAM;
                        startYears = [...new Set(ongoingPROGRAM.map(item => item.startyear))];
                        scholarshipPrograms = [...new Set(ongoingPROGRAM.map(item => item
                            .scholarshipprogram))];


                        /* customize x label (program) */
                        var labelsprogram = startYears.map((year, index) => {
                            if (index < startYears.length - 1) {
                                return year + "-" + (year + 1);
                            } else {
                                return year + "-" + (year + 1);
                            }
                        });
                        myProgramChart.data.labels = labelsprogram;
                        myProgramChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = startYears.map(year => {
                                var match = ongoingPROGRAM.find(item => item
                                    .startyear === year && item
                                    .scholarshipprogram ===
                                    scholarshipPrograms[
                                        index]);
                                return match ? match.scholarshipprogramcount :
                                    0;
                            });
                        });
                        myProgramChart.reset();
                        myProgramChart.update(); // Update the chart to reflect the changes
                    }

                    if (window.myPieChart) {
                        var dataPROGRAM = response.ongoingPROGRAMcounter;
                        var labelsPROGRAM = [];
                        var countsPROGRAM = [];

                        dataPROGRAM.forEach(item => { // Use dataPROGRAM instead of data
                            labelsPROGRAM.push(item.scholarshipprogram);
                            countsPROGRAM.push(item.scholarshipprogramcount);
                        });

                        myPieChart.data.labels = labelsPROGRAM; // Update the labels
                        myPieChart.data.datasets[0].data = countsPROGRAM; // Update the data
                        myPieChart.update(); // Update the chart
                    }


                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                });
            });

            /* Filter Submit Gender */
            $('#genderyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {
                    console.log(response);
                    //Destroy the existing chart
                    if (window.myGenderChart) {

                        var ongoingGenderResponse = response
                            .ongoingGender; // Rename to avoid conflict
                        var startYearsGenderResponse = [...new Set(ongoingGenderResponse.map(
                            item =>
                            item.startyear))]; // Rename
                        var scholarshipGenderResponse = [...new Set(ongoingGenderResponse.map(
                            item => item.MF))]; // Rename
                        /* customize x label (program) */
                        var labelsgender = startYears.map((year, index) => {
                            if (index < startYears.length - 1) {
                                return year + "-" + (year + 1);
                            } else {
                                return year + "-" + (year + 1);
                            }
                        });
                        myGenderChart.data.labels = labelsgender;
                        myGenderChart.data.datasets.forEach((dataset, index) => {
                            dataset.data = startYearsGenderResponse.map(year => {
                                var match = ongoingGenderResponse.find(item =>
                                    item
                                    .startyear === year && item.MF ===
                                    scholarshipGenderResponse[index]);
                                return match ? match.MFcount : 0;
                            });
                        });

                        myGenderChart.update(); // Update the chart to reflect the changes
                    }

                    if (window.myGenderPieChart) {

                        var dataGender = response
                            .ongoingGendercounter; // Use dataGender instead of dataPROGRAM
                        var labelsGender = [];
                        var countsGender = [];

                        dataGender.forEach(item => {
                            labelsGender.push(item.MF);
                            countsGender.push(item.MFcount);
                        });

                        myGenderPieChart.data.labels = labelsGender;
                        myGenderPieChart.data.datasets[0].data = countsGender;
                        myGenderPieChart.update();
                    }


                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                });
            });



            $('#provinceyearform').on('submit', function(e) {
                e.preventDefault();
                var $this = $(this);
                $.ajax({
                    url: $this.prop('action'),
                    method: 'POST',
                    data: $this.serialize(),
                }).done(function(response) {
                    /*  console.log(response); */
                    //Destroy the existing chart
                    if (window.myProvinceChart && response.dataProvinces.labelsprovince && response
                        .dataProvinces.datasprovince) {
                        // Update the chart data
                        myProvinceChart.data.labels = response.dataProvinces.labelsprovince;
                        myProvinceChart.data.datasets[0].data = response.dataProvinces
                            .datasprovince;

                        // Update the chart
                        myProvinceChart.update();
                    }



                }).catch(error => {
                    console.error('Error fetching or processing data:', error);
                });
            });

        });



        /* ongoingSchools */
        var ctxschools = document.getElementById('mySchoolChart').getContext('2d');

        // Function to generate a random color in hexadecimal format
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Get the data from your PHP variables
        var labelsSchool = @json($dataSchoool['labelsschool']);
        var dataSchool = @json($dataSchoool['datasschool']);

        // Generate random colors for each data point
        var backgroundColorsSchool = dataSchool.map(() => getRandomColor());

        var mySchoolChart = new Chart(ctxschools, {
            type: 'doughnut',
            data: {
                labels: labelsSchool,
                datasets: [{
                    label: labelsSchool,
                    data: dataSchool,
                    borderWidth: 2,
                    backgroundColor: backgroundColorsSchool, // Set random colors here
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        font: {
                            weight: 'bold',
                            size: 14,
                        },
                        color: 'black',
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                    legend: {
                        position: 'left',
                        labels: {
                            color: "black",

                        },
                    },
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },
            },
        });

        /* ongoingMovement */
        var ctxmovement = document.getElementById('myMovementChart').getContext('2d');

        // Function to generate a random color in hexadecimal format
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Get the data from your PHP variables
        var labels = @json($dataMovements['labelsmovements']);
        var data = @json($dataMovements['datasmovements']);

        // Generate random colors for each data point
        var backgroundColors = data.map(() => getRandomColor());

        var myMovementChart = new Chart(ctxmovement, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: labels,
                    data: data,
                    borderWidth: 2,
                    backgroundColor: backgroundColors, // Set random colors here
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        font: {
                            weight: 'bold',
                            size: 14,
                        },
                        color: 'black',
                        formatter: (value) => {
                            return value + '%';
                        },
                    },
                    legend: {
                        position: 'left',
                    },
                },
                maintainAspectRatio: false,
                animation: {
                    duration: 5000,
                    easing: 'easeOutQuart',
                },
            },
        });
    </script>



</html>
