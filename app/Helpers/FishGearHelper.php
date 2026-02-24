<?php

use Carbon\Carbon;

if (!function_exists('hitung_denda')) {

    function hitung_denda($tgl_deadline, $tgl_kembali_real, $harga_alat)
    {
        $deadline = Carbon::parse($tgl_deadline);
        $realita  = Carbon::parse($tgl_kembali_real);

        if ($realita->greaterThan($deadline)) {

            $selisih_hari = $realita->diffInDays($deadline);

            // 50% dari harga sewa per hari
            $tarif_per_hari = $harga_alat * 0.5;

            return $selisih_hari * $tarif_per_hari;
        }

        return 0;
    }
}
