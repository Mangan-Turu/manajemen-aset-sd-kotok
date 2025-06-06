<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['navigation'] = [
    [
        'label' => 'Dashboard',
        'icon' => 'fas fa-tachometer-alt',
        'url' => '#',
        'active' => ['dashboard', 'index', 'index2'],
        // 'children' => [
        //     [
        //         'label' => 'Dashboard v1',
        //         'url' => 'index',
        //         'active' => ['index'],
        //     ],
        //     [
        //         'label' => 'Dashboard v2',
        //         'url' => 'index2',
        //         'active' => ['index2'],
        //     ]
        // ]
    ],
    [
        'label' => 'Pengguna',
        'icon' => 'fas fa-user', // Ikon orang untuk pengguna
        'url' => 'kriteria',
        'active' => ['kriteria']
    ],
    [
        'label' => 'Siswa',
        'icon' => 'fas fa-user-graduate', // Ikon siswa/mahasiswa
        'url' => 'karyawan',
        'active' => ['karyawan']
    ],
    [
        'label' => 'Aset',
        'icon' => 'fas fa-boxes', // Ikon untuk aset atau inventaris
        'url' => 'penilaian',
        'active' => ['penilaian']
    ],
    [
        'label' => 'Pengadaan',
        'icon' => 'fas fa-cart-plus', // Ikon pengadaan atau pembelian
        'url' => 'hasil',
        'active' => ['hasil']
    ],
    [
        'label' => 'Mutasi',
        'icon' => 'fas fa-exchange-alt', // Ikon mutasi atau perpindahan
        'url' => 'hasil',
        'active' => ['hasil']
    ],
    [
        'label' => 'Pemeliharaan',
        'icon' => 'fas fa-tools', // Ikon alat untuk pemeliharaan
        'url' => 'hasil',
        'active' => ['hasil']
    ],
    [
        'label' => 'Kerusakan',
        'icon' => 'fas fa-exclamation-triangle', // Ikon peringatan untuk kerusakan
        'url' => 'hasil',
        'active' => ['hasil']
    ],
    [
        'label' => 'Ruangan',
        'icon' => 'fas fa-door-open', // Ikon ruangan
        'url' => 'hasil',
        'active' => ['hasil']
    ],
    [
        'label' => 'Logout',
        'icon' => 'fas fa-sign-out-alt',
        'url' => 'logout',
        'active' => []
    ]
];
