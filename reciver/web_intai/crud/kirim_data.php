<?php

//include library utama
include_once '../koneksi/konek.php';

// Buat Instance baru
$app = new Intai();

// Baca query dari alamat
$app->query_string = $_SERVER['QUERY_STRING'];

// Cek apakah ada query bernama mode?
if ($app->is_url_query('mode')) {

    // Bagi menjadi beberapa operasi
    switch ($app->get_url_query_value('mode')) {

        default:
            $app->read_json();

        case 'save':
            if ($app->is_url_query('suara1') && $app->is_url_query('suara2') && $app->is_url_query('suara3') && $app->is_url_query('suara4') && $app->is_url_query('status')) {
                $suara1 = $app->get_url_query_value('suara1');
                $suara2 = $app->get_url_query_value('suara2');
                $suara3 = $app->get_url_query_value('suara3');
                $suara4 = $app->get_url_query_value('suara4');
                $status = $app->get_url_query_value('status');
                $app->create_data($suara1, $suara2, $suara3, $suara4, $status);
            } else {
                $error = [
                    'suara1' => 'required',
                    'suara2' => 'required',
                    'suara3' => 'required',
                    'suara4' => 'required',
                    'status' => 'required',
                ];
                echo $app->error_handler($error);
            }
            break;
        case 'delete':
            if ($app->is_url_query('id')) {
                $id = $app->get_url_query_value('id');
                $app->delete_data($id);
            } else {
                $error = [
                    'id' => 'required',
                ];
                echo $app->error_handler($error);
            }
            break;
    }
} else {
    $app->read_json();
}
