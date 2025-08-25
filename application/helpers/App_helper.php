<?php
function _webSetting()
{
    $CI = &get_instance();

    $CI->db->select('*');
    $CI->db->from('pengaturan_web');
    $CI->db->where(['id' => 1]);

    return $CI->db->get()->row();
}

function addData($table, $data)
{
    $CI = &get_instance();

    return $CI->db->insert($table, $data);
}

function getData($table, $where)
{
    $CI = &get_instance();

    $CI->db->select('*');
    $CI->db->from($table);
    $CI->db->where($where);
    return $CI->db->get()->row_array();
}

function getResult($table, $where)
{
    $CI = &get_instance();

    $CI->db->select('*');
    $CI->db->from($table);
    $CI->db->where($where);
    return $CI->db->get()->result();
}

function updateData($table, $data, $where)
{
    $CI = &get_instance();
    return $CI->db->update($table, $data, $where);
}

function Result($table)
{
    $CI = &get_instance();

    $CI->db->select('*');
    $CI->db->from($table);
    return $CI->db->get()->result();
}

function tglIndo($tgl)
{
    $hari = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );

    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $split = explode('-', $tgl);
    $tanggal = $split[2];
    $bulan = $bulan[(int)$split[1]];
    $tahun = $split[0];

    $nama_hari = $hari[date('l', strtotime($tgl))];

    return "$nama_hari, $tanggal $bulan $tahun";
}

function waktuIndo($time, $param)
{
    $hari = array(
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    );

    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $datetime = new DateTime($time);
    $tanggal = $datetime->format('d');
    $bulan = $bulan[(int)$datetime->format('m')];
    $tahun = $datetime->format('Y');
    $waktu = $datetime->format('H:i:s');

    $nama_hari = $hari[date('l', strtotime($time))];

    if ($param == 1) {
        $hasil = "$nama_hari, $tanggal $bulan $tahun";
    } else {
        $hasil = "$waktu";
    }

    return $hasil;
}
