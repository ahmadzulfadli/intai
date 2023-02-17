<?php


$servername = "localhost";
$username = "root";
$password = "Kucinghitam123";
$database = "dataesp";

$conn = mysqli_connect($servername, $username, $password, $database);

function query($query)
{
    global $conn;
    $hasil = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }
    return $rows;
}


function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tbl_dht11 WHERE id = $id");

    return mysqli_affected_rows($conn);
}
