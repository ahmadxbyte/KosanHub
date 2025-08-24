<?php
function _webSetting()
{
    $CI = &get_instance();

    $CI->db->select('*');
    $CI->db->from('pengaturan_web');
    $CI->db->where(['id' => 1]);

    return $CI->db->get()->row();
}

function addData($data, $table)
{
    $CI = &get_instance();

    return $CI->db->insert($table, $data);
}
