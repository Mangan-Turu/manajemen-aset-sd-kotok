<?php
defined('BASEPATH') or exit('No direct script access allowed');

$config['navigation'] = [
    [
        'label' => 'Dashboard',
        'icon' => 'fas fa-tachometer-alt',
        'url' => '#',
        'active' => ['dashboard', 'index', 'index2'],
        'role' => ['admin', 'kepala_sekolah'], // Hanya untuk role admin
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
        'active' => ['pengguna'],
        'role' => ['admin'],
    ],
    [
        'label' => 'Siswa',
        'icon' => 'fas fa-user-graduate', // Ikon siswa/mahasiswa
        'url' => 'siswa',
        'active' => ['siswa'],
        'role' => ['admin', 'kepala_sekolah'],
    ],
    [
        'label' => 'Aset',
        'icon' => 'fas fa-boxes', // Ikon untuk aset atau inventaris
        'url' => 'aset',
        'active' => ['aset'],
        'role' => ['admin', 'kepala_sekolah'],
    ],
    [
        'label' => 'Pengadaan',
        'icon' => 'fas fa-cart-plus', // Ikon pengadaan atau pembelian
        'url' => 'pengadaan',
        'active' => ['pengadaan'],
        'role' => ['admin', 'kepala_sekolah'],
    ],
    [
        'label' => 'Mutasi',
        'icon' => 'fas fa-exchange-alt', // Ikon mutasi atau perpindahan
        'url' => 'mutasi',
        'active' => ['mutasi'],
        'role' => ['admin'],
    ],
    [
        'label' => 'Pemeliharaan',
        'icon' => 'fas fa-tools', // Ikon alat untuk pemeliharaan
        'url' => 'pemeliharaan',
        'active' => ['pemeliharaan'],
        'role' => ['admin'],
    ],
    [
        'label' => 'Kerusakan',
        'icon' => 'fas fa-exclamation-triangle', // Ikon peringatan untuk kerusakan
        'url' => 'kerusakan',
        'active' => ['kerusakan'],
        'role' => ['admin', 'kepala_sekolah'],
    ],
    [
        'label' => 'Ruangan',
        'icon' => 'fas fa-door-open', // Ikon ruangan
        'url' => 'ruangan',
        'active' => ['ruangan'],
        'role' => ['admin', 'kepala_sekolah'],
    ],
    [
        'label' => 'Logout',
        'icon' => 'fas fa-sign-out-alt',
        'url' => 'logout',
        'active' => [],
        'role' => ['admin', 'kepala_sekolah'],
    ]
];
