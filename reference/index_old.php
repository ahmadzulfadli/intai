<?php

require 'koneksi/konek.php';
$app = new Intai;
$data = $app->read_data();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>

    <style>
        .clogout {
            background-color: #1c87c9;
            border: none;
            color: white;
            padding: 15px 28px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 3px 2px;
            cursor: pointer;
        }

        .title {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        }

        #tbsensor {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            margin-left: 10%;
            width: 80%;
        }

        #tbsensor td,
        #tbsensor th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #tbsensor tr:nth-child(even) {
            background-color: #f2f2E2;
        }

        #tbsensor tr:hover {
            background-color: #eee;
        }

        #tbsensor th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #1a75ff;
            color: white;
        }
    </style>

    <center>
        <h1 class="title">Data Sensor</h1>
    </center>

    <div id="load_table">
        <table id="tbsensor">

            <tr>
                <th>No</th>
                <th>Waktu</th>
                <th>Temperature</th>
                <th>Humidity</th>
                <th>Aksi</th>
            </tr>

            <?php $i = 1; ?>
            <?php foreach ($data as $row) : {
                }  ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $row["timestamp"]; ?></td>
                    <td><?= $row["data_temperature"]; ?></td>
                    <td><?= $row["data_humidity"]; ?></td>
                    <td>
                        <a href="crud/hapus.php?id=<?= $row["id"]; ?>">Hapus</a>
                    </td>
                </tr>

                <?php $i++;  ?>
            <?php endforeach; ?>

        </table>
    </div>
    <script>
        function updateTabel() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("load_table").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "index_old.php", true);
            xmlhttp.send();
        }

        // Memperbarui tabel setiap 5 detik
        setInterval(updateTabel, 5000);
    </script>
</body>

</html>