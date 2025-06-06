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
        'url' => 'pengguna',
        'active' => ['pengguna']
    ],
    [
        'label' => 'Siswa',
        'icon' => 'fas fa-user-graduate', // Ikon siswa/mahasiswa
        'url' => 'siswa',
        'active' => ['siswa']
    ],
    [
        'label' => 'Aset',
        'icon' => 'fas fa-boxes', // Ikon untuk aset atau inventaris
        'url' => 'aset',
        'active' => ['aset']
    ],
    [
        'label' => 'Pengadaan',
        'icon' => 'fas fa-cart-plus', // Ikon pengadaan atau pembelian
        'url' => 'pengadaan',
        'active' => ['pengadaan']
    ],
    [
        'label' => 'Mutasi',
        'icon' => 'fas fa-exchange-alt', // Ikon mutasi atau perpindahan
        'url' => 'mutasi',
        'active' => ['mutasi']
    ],
    [
        'label' => 'Pemeliharaan',
        'icon' => 'fas fa-tools', // Ikon alat untuk pemeliharaan
        'url' => 'pemeliharaan',
        'active' => ['pemeliharaan']
    ],
    [
        'label' => 'Kerusakan',
        'icon' => 'fas fa-exclamation-triangle', // Ikon peringatan untuk kerusakan
        'url' => 'kerusakan',
        'active' => ['kerusakan']
    ],
    [
        'label' => 'Ruangan',
        'icon' => 'fas fa-door-open', // Ikon ruangan
        'url' => 'ruangan',
        'active' => ['ruangan']
    ],
    [
        'label' => 'Logout',
        'icon' => 'fas fa-sign-out-alt',
        'url' => 'logout',
        'active' => []
    ]
];
