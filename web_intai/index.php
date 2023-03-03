<?php
require 'koneksi/konek.php';
$app = new Intai;
$data = $app->read_data();
$num_results = $app->count_data();
$last_data = null;
if ($data) {
    $last_data = $data[0];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTAI</title>
    <link rel="shortcut icon" href="assets/image/logo1.svg">
    <!-- halfmoon css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/halfmoon/css/halfmoon.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- halfmoon js -->
    <script src="https://cdn.jsdelivr.net/npm/halfmoon/js/halfmoon.min.js"></script>
</head>

<body class="with-custom-webkit-scrollbars with-custom-css-scrollbars">
    <!-- page wrapper with sidebar -->
    <div id="page-wrapper" class="page-wrapper with-navbar with-sidebar with-transitions" data-sidebar-type="overlayed-sm-and-down">
        <!-- Navbar (immediate child of the page wrapper) -->
        <nav class="navbar">
            <!-- Navbar content (with toggle sidebar button) -->

            <button class="btn btn-action " onclick="halfmoon.toggleSidebar()" type="button" style="background-color: #5e81ac;"></button>

            <!-- Navbar brand -->
            <a href="#" class="navbar-brand ">
                INTAI
            </a>
            <!-- Navbar text -->
            <span class="navbar-text text-monospace">Teknik Elektro USR</span>
        </nav>
        <div class="sidebar-overlay" onclick="halfmoon.toggleSidebar()"></div>
        <!-- sidebar -->
        <div class="sidebar">
            <div class="sidebar-menu">
                <center>
                    <img src="assets/image/logo.svg" width="100px" height="100px" style="border-radius: 40%; margin-top: 10px;">
                    <h4>INTAI</h4>
                </center>
                <!-- Dashboard table and graph -->
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="tabel.php">Tabel</a></li>
                    <li><a href="grafik.php">Grafik</a></li>
                </ul><br>
            </div>
        </div>
        <!-- end of sidebar -->
        <!-- content wrapper -->
        <div class="content-wrapper">
            <!-- content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- First comes a content container with the main title -->
                    <!-- Third row (equally spaced on large screens and up) -->
                    <div class="row row-eq-spacing-lg">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="text-center">
                                    <h2 class="font-weight-bold mt-1">Keterangan :</h2>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nama Device</th>
                                            <th scope="col">Koordinat</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Elang</td>
                                            <td>0°28'35"N 101°20'57"E.</td>
                                            <td><?php
                                                $suara = $last_data['data_status'];
                                                class Status
                                                {
                                                    private $suara;

                                                    function __construct($suara)
                                                    {
                                                        $this->suara = $suara;
                                                    }

                                                    public function status()
                                                    {
                                                        if ($this->suara == 1) {
                                                            echo '<div class="alert alert-danger">Terdeteksi Penebangan</div>';
                                                        } else {
                                                            echo '<div class="alert alert-primary">Aman</div>';
                                                        }
                                                    }
                                                }

                                                $status = new Status($suara);
                                                $status->status();
                                                ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <h2 class="content-title">Data Sensor Sekarang</h2>
                    </div>
                    <!-- First row (equally spaced) -->
                    <div class="row row-eq-spacing">
                        <div class="col-6 col-xl-3 data">
                            <div class="card">
                                <h2 class="card-title">Sensor 1</h2>
                                <div id="jg1" class="gauge size-2"></div>
                                <div class="h-split"></div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 data">
                            <div class="card">
                                <h2 class="card-title">Sensor 2</h2>
                                <div id="jg2" class="gauge size-2"></div>
                                <div class="h-split"></div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 data">
                            <div class="card">
                                <h2 class="card-title">Sensor 3</h2>
                                <div id="jg3" class="gauge size-2"></div>
                                <div class="h-split"></div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3 data">
                            <div class="card">
                                <h2 class="card-title">Sensor 4</h2>
                                <div id="jg4" class="gauge size-2"></div>
                                <div class="h-split"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Third row (equally spaced on large screens and up) -->
                <!-- Second row (equally spaced on large screens and up) -->
                <div class="row row-eq-spacing-lg">
                    <div class="col-lg-8">
                        <div class="card h-lg-250 overflow-y-lg-auto">
                            <!-- h-lg-250 = height = 25rem (250px) only on large screens and up (> 992px), overflow-y-lg-auto = overflow-y: auto only on large screens and up (> 992px) -->
                            <h2 class="card-title">Keterangan Data</h2>
                            <br>
                            <table class="table table-striped table-hover">
                                <tr>
                                    <td>Banyaknya Data</td>
                                    <td>:</td>
                                    <td><?php echo $num_results; ?> </td>
                                </tr>
                                <tr>
                                    <td>Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td><?php echo $last_data['timestamp']; ?> </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card h-lg-250 overflow-y-lg-auto">
                            <!-- h-lg-250 = height = 25rem (250px) only on large screens and up (> 992px), overflow-y-lg-auto = overflow-y: auto only on large screens and up (> 992px) -->
                            <h2 class="card-title">Intai</h2>
                            Intai merupakan alat pendeteksi penebang liar yang dikembangkan untuk menjaga hutan dari
                            pelaku yang tidak bertanggung jawab. Alat ini menggunakan
                            sensor suara MAX4466, mikrokontroler ESP32 untuk mengidentifikasi suara gergaji mesin.
                        </div>
                    </div>
                </div>
                <!-- Third row (equally spaced on large screens and up) -->
                <div class="row row-eq-spacing-lg">
                    <div class="col-lg-12">
                        <div class="card">
                            <h2 class="card-title">Teknik Elektro UIN SUSKA Riau</h2>
                            ...
                        </div>
                        <div class="content">
                            ...
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of content -->
    </div>
    <!-- end of page wrapper with sidebar -->
    <script src="assets/js/raphael-2.1.4.min.js"></script>
    <script src="assets/js/justgage.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var jg1, jg2, jg3

            var defs1 = {
                label: "dB",
                value: <?php echo $last_data['data_dbmax1']; ?>,
                min: 0,
                max: 100,
                decimals: 2,
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true,
            }

            var defs2 = {
                label: "dB",
                value: <?php echo $last_data['data_dbmax2']; ?>,
                min: 0,
                max: 100,
                decimals: 2,
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true,
            }

            var defs3 = {
                label: "dB",
                value: <?php echo $last_data['data_dbmax3']; ?>,
                min: 0,
                max: 100,
                decimals: 2,
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true,
            }

            var defs4 = {
                label: "dB",
                value: <?php echo $last_data['data_dbmax4']; ?>,
                min: 0,
                max: 100,
                decimals: 2,
                gaugeWidthScale: 0.6,
                pointer: true,
                pointerOptions: {
                    toplength: 10,
                    bottomlength: 10,
                    bottomwidth: 2
                },
                counter: true,
                relativeGaugeSize: true,
            }

            jg1 = new JustGage({
                id: "jg1",
                defaults: defs1
            });

            jg2 = new JustGage({
                id: "jg2",
                defaults: defs2
            });

            jg3 = new JustGage({
                id: "jg3",
                defaults: defs3
            });

            jg4 = new JustGage({
                id: "jg4",
                defaults: defs4
            });
        });
    </script>
</body>

</html>