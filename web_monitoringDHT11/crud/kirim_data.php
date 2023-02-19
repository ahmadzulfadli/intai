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
            if ($app->is_url_query('temperature') && $app->is_url_query('humidity') && $app->is_url_query('kebisingan')) {
                $temp = $app->get_url_query_value('temperature');
                $humid = $app->get_url_query_value('humidity');
                $suara = $app->get_url_query_value('kebisingan');
                $app->create_data($temp, $humid, $suara);
            } else {
                $error = [
                    'temperature' => 'required',
                    'humidity' => 'required',
                    'kebisingan' => 'required',
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

        case 'update':
            if ($app->is_url_query('id')) {
                $id = $app->get_url_query_value('id');

                if ($app->is_url_query('temperature')) {
                    $temp = $app->get_url_query_value('temperature');
                    $app->update_data($id, $temp);
                }

                if ($app->is_url_query('humidity')) {
                    $humid = $app->get_url_query_value('humidity');
                    $app->update_data($id, $humid);
                }

                if ($app->is_url_query('kebisingan')) {
                    $suara = $app->get_url_query_value('kebisingan');
                    $app->update_data($id, $suara);
                }
            } else {
                $error = [
                    'id' => 'required',
                    'temperature' => 'OR required',
                    'humidity' => 'OR required',
                    'kebisingan' => 'OR required',
                ];
                echo $app->error_handler($error);
            }
            break;
    }
} else {
    $app->read_json();
}
