<?php
function _masterKode($keterangan, $digit, $param1 = '', $param2 = '', $param3 = '')
{
    $lastNumber = getData('ms_kode', ['keterangan' => $keterangan]);

    $params     = $param1 . $param2 . $param3;

    if ($lastNumber) {
        if ($lastNumber['terakhir'] < 1) {
            $last = 1;
        } else {
            $last = $lastNumber['terakhir'] + 1;
        }

        $generator = sprintf("%0" . ($digit - (strlen($params))) . "d", $last);

        $kode = $params . $generator;

        updateData('ms_kode', ['terakhir' => $last], ['keterangan' => $keterangan]);
    } else {
        $data = [
            'keterangan' => $keterangan,
            'panjang'    => $digit,
            'param1'     => $param1,
            'param2'     => $param2,
            'param3'     => $param3,
            'terakhir'   => 1,
        ];

        addData('ms_kode', $data);

        $generator = sprintf("%0" . ($digit - (strlen($params))) . "d", 1);

        $kode = $params . $generator;
    }

    return $kode;
}
