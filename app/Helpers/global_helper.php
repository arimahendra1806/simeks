<?php

use Carbon\Carbon;

function format_currency($amount)
{
    return number_format($amount, 0, ',', '.');
}

function remove_currency($amount)
{
    return str_replace('.', '', $amount);
}

function format_date($date)
{
    if (!$date) {
        return '-';
    }

    $date = explode('/', $date);

    return $date[2] . '-' . $date[1] . '-' . $date[0];
}

function format_date_w_bs($date)
{
    if (!$date) {
        return '-';
    }

    $date = explode('-', $date);

    return $date[2] . '/' . $date[1] . '/' . $date[0];
}

function generate_code($prefix = 'UNK', $last_code)
{
    $today = Carbon::now();
    $date_now = $today->format('ymd');

    if ($last_code) {
        $date_last_code = substr($last_code, 5, 6);
        $last_increment = (int) substr($last_code, 11);

        if ($date_last_code === $date_now) {
            $incrementBaru = $last_increment + 1;
        } else {
            $incrementBaru = 1;
        }
    } else {
        $incrementBaru = 1;
    }

    return $prefix . $date_now . str_pad($incrementBaru, 4, '0', STR_PAD_LEFT);
}

function formate_date($date)
{
    $dt = DateTime::createFromFormat('d-m-Y', $date);
    return $dt ? $dt->format('Y-m-d') : null;
}

function formate_date_w_bs($date)
{
    $dt = DateTime::createFromFormat('Y-m-d', $date);
    return $dt ? $dt->format('d-m-Y') : null;
}

function indo_to_date($indoDate)
{
    $bulan = [
        'Januari' => '01',
        'Februari' => '02',
        'Maret' => '03',
        'April' => '04',
        'Mei' => '05',
        'Juni' => '06',
        'Juli' => '07',
        'Agustus' => '08',
        'September' => '09',
        'Oktober' => '10',
        'November' => '11',
        'Desember' => '12',
    ];

    [$day, $monthName, $year] = explode(' ', $indoDate);
    $month = $bulan[$monthName] ?? '01';
    return "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
}

// Ubah dari '2025-04-10' ke '10 April 2025'
function date_to_indo($date)
{
    $bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    $carbonDate = Carbon::parse($date);
    $day = $carbonDate->format('d');
    $month = $bulan[$carbonDate->format('m')] ?? '';
    $year = $carbonDate->format('Y');

    return "$day $month $year";
}

function encrypt_64($string)
{
    return base64_encode($string);
}

function decrypt_64($string)
{
    return base64_decode($string);
}

function normalize_phone_number($phone)
{
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (substr($phone, 0, 1) === '0') {
        $phone = '62' . substr($phone, 1);
    }
    if (substr($phone, 0, 2) === '62') {
        return $phone;
    }
    return '62' . $phone;
}
