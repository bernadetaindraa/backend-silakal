<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    [
        'title' => 'Dashboard',
        'items' => [

            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2 7-7 7 7 2 2M5 10v10h14V10"/>
                '
            ],

            [
                'label' => 'Dashboard',
                'route' => 'pelayanan.dashboard',
                'roles' => [2],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2 7-7 7 7 2 2M5 10v10h14V10"/>
                '
            ],

            [
                'label' => 'Dashboard',
                'route' => 'dukuh.dashboard',
                'roles' => [3],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2 7-7 7 7 2 2M5 10v10h14V10"/>
                '
            ],

        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | PENGATURAN
    |--------------------------------------------------------------------------
    */

    [
        'title' => 'Manajemen Pengguna',
        'items' => [

            [
                'label' => 'Pengguna',
                'route' => 'admin.users.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                '
            ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | KONTEN
    |--------------------------------------------------------------------------
    */

    [
        'title' => 'Manajemen Konten',
        'items' => [

            [
                'label' => 'Berita',
                'route' => 'admin.berita.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8h10M7 12h10M7 16h6M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                '
            ],

            [
                'label' => 'Komentar',
                'route' => 'admin.komentar.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4-.8L3 20l1.2-3.2A7.963 7.963 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                '
            ],

            [
                'label' => 'Agenda',
                'route' => 'admin.agenda.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                '
            ],

            [
                'label' => 'Potensi Desa',
                'route' => 'admin.potensi-produk.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 2l3 7h7l-5.5 4.5L18 21l-6-4-6 4 1.5-7.5L2 9h7z"/>
                '
            ],

             [
                'label' => 'Produk Hukum',
                'route' => 'admin.produk-hukum.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
                '
            ],

            [
                'label' => 'Kebudayaan',
                'route' => 'admin.kebudayaan.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                '
            ],

        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | INTERAKSI
    |--------------------------------------------------------------------------
    */

    [
        'title' => 'Pengaduan dan Survey',
        'items' => [

            [
                'label' => 'Pengaduan',
                'route' => 'admin.pengaduan.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.364 5.636l-1.414-1.414L12 9.172 7.05 4.222 5.636 5.636 10.586 10.586 5.636 15.536l1.414 1.414L12 12l4.95 4.95 1.414-1.414-4.95-4.95z"/>
                '
            ],

            [
                'label' => 'Survey IKM',
                'route' => 'admin.survey.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5h2m-1 0v14m-7-7h14"/>
                '
            ],

        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | PELAYANAN
    |--------------------------------------------------------------------------
    */

    [
        'title' => 'Pelayanan',
        'items' => [

        [
            'label' => 'Layanan',
            'route' => 'pelayanan.layanan.index',
            'roles' => [2],
            'icon' => '
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>
            '
        ],

        [
            'label' => 'Riwayat',
            'route' => 'pelayanan.layanan.riwayat',
            'roles' => [2],
            'icon' => '
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 8h14M5 8V6a2 2 0 012-2h10a2 2 0 012 2v2m-14 0v10a2 2 0 002 2h10a2 2 0 002-2V8"/>
            '
        ],

        // [
        //     'label' => 'Pembuatan Surat',
        //     'route' => 'pelayanan.layanan.show',
        //     'roles' => [2],
        //     'icon' => '
        //         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        //             d="M7 8h10M7 12h8m-8 4h6"/>
        //     '
        // ],

            [
                'label' => 'Verifikasi',
                'route' => 'dukuh.layanan.index',
                'roles' => [3],
                'icon' => '
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6-2V5l-7-3-7 3v6c0 5.25 3.25 10 7 11 3.75-1 7-5.75 7-11z"/>
                    </svg>
                ',
            ],

            [
                'label' => 'Data Warga',
                'route' => 'dukuh.warga.index',
                'roles' => [3],
                'icon' => '
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-1a4 4 0 00-3-3.87M9 20H4v-1a4 4 0 013-3.87m10-3.13a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                ',
            ]

        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | DOKUMEN & LAPORAN
    |--------------------------------------------------------------------------
    */

    [
        'title' => 'Laporan dan Dokumen',
        'items' => [
            [
                'label' => 'Laporan',
                'route' => 'admin.laporan.index',
                'roles' => [1],
                'icon' => '
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6M5 21h14"/>
                '
            ],
        ]
    ],

    
];