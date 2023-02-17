<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'koneksi.php';


$kartu = query("SELECT * FROM sensor");

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="1">
    <title>Home</title>
</head>

<body>

    <style>
        .clogout {
            float: right;
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

    <a href="logout.php" class="clogout">Logout</a>

    <center>
        <h1 class="title">Data Sensor Arus dan Tegangan</h1>
    </center>

    <table id="tbsensor">

        <tr>
            <th>No</th>
            <th>Waktu</th>
            <th>Tegangan</th>
            <th>Arus</th>
            <th>Suhu</th>
            <th>Kelembaban</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($kartu as $data) : {
            }  ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $data["waktu"]; ?></td>
                <td><?= $data["tegangan"]; ?></td>
                <td><?= $data["arus"]; ?></td>
                <td><?= $data["suhu"]; ?></td>
                <td><?= $data["kelembaban"]; ?></td>
                <td>
                    <a href="hapus.php?id=<?= $data["id"]; ?>">Hapus</a>
                </td>
            </tr>

            <?php $i++;  ?>
        <?php endforeach; ?>

    </table>

</body>

</html>