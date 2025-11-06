<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ruangan;
use App\Models\Peralatan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Laboratorium',
            'email' => 'admin@silab.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Sample Users
        User::create([
            'name' => 'Dr. Isnan',
            'email' => 'isnan@silab.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        User::create([
            'name' => 'Rehan Asisten',
            'email' => 'rehan@silab.com', 
            'password' => Hash::make('password'),
            'role' => 'asisten',
        ]);

        User::create([
            'name' => 'Mahasiswa Contoh',
            'email' => 'mahasiswa@silab.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        // ==================== DATA RUANGAN ====================
        $ruangan = [
            [
                'nama_ruang' => 'Lab Komputer A',
                'kapasitas' => 30,
                'lokasi' => 'Gedung Teknik Lantai 1',
                'fasilitas' => '25 PC, AC, Projector, Whiteboard, LAN, Internet',
            ],
            [
                'nama_ruang' => 'Lab Komputer B',
                'kapasitas' => 25,
                'lokasi' => 'Gedung Teknik Lantai 1',
                'fasilitas' => '20 PC, AC, Projector, Printer, Scanner',
            ],
            [
                'nama_ruang' => 'Lab Jaringan Komputer',
                'kapasitas' => 20,
                'lokasi' => 'Gedung Teknik Lantai 2',
                'fasilitas' => 'Router Cisco, Switch, Server, Tools Networking',
            ],
            [
                'nama_ruang' => 'Lab Elektronika Dasar',
                'kapasitas' => 25,
                'lokasi' => 'Gedung Teknik Lantai 2',
                'fasilitas' => 'Osiloskop, Multimeter, Power Supply, Solder',
            ],
            [
                'nama_ruang' => 'Lab Microcontroller',
                'kapasitas' => 20,
                'lokasi' => 'Gedung Teknik Lantai 3',
                'fasilitas' => 'Arduino, Raspberry Pi, Sensor Kit, Oscilloscope',
            ],
            [
                'nama_ruang' => 'Lab Pemrograman',
                'kapasitas' => 35,
                'lokasi' => 'Gedung Teknik Lantai 3',
                'fasilitas' => '30 PC, Dual Monitor, Software Development Tools',
            ],
            [
                'nama_ruang' => 'Lab Robotika',
                'kapasitas' => 15,
                'lokasi' => 'Gedung Teknik Lantai 4',
                'fasilitas' => 'Robot Kit, 3D Printer, Tools Mekanik',
            ],
            [
                'nama_ruang' => 'Lab Basis Data',
                'kapasitas' => 25,
                'lokasi' => 'Gedung Teknik Lantai 4',
                'fasilitas' => '20 PC, Server Database, Software Database',
            ],
            [
                'nama_ruang' => 'Ruang Presentasi',
                'kapasitas' => 40,
                'lokasi' => 'Gedung Utama Lantai 1',
                'fasilitas' => 'Projector, Sound System, Screen, Microphone',
            ],
            [
                'nama_ruang' => 'Lab Multimedia',
                'kapasitas' => 20,
                'lokasi' => 'Gedung Teknik Lantai 4',
                'fasilitas' => 'PC High-End, Graphic Tablet, Software Editing',
            ]
        ];

        foreach ($ruangan as $data) {
            Ruangan::create($data);
        }

        // ==================== DATA PERALATAN ====================
        $peralatan = [
            // ===== ELEKTRONIK =====
            [
                'nama_alat' => 'Laptop ASUS VivoBook',
                'kategori' => 'Elektronik',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Laptop DELL Inspiron',
                'kategori' => 'Elektronik',
                'jumlah_total' => 6,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Projector Epson EB-X41',
                'kategori' => 'Elektronik',
                'jumlah_total' => 4,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Speaker Active JBL',
                'kategori' => 'Elektronik',
                'jumlah_total' => 5,
                'jumlah_tersedia' => 5,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Microphone Wireless',
                'kategori' => 'Elektronik',
                'jumlah_total' => 6,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Kamera DSLR Canon',
                'kategori' => 'Elektronik',
                'jumlah_total' => 3,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
            ],

            // ===== ALAT UKUR =====
            [
                'nama_alat' => 'Multimeter Digital',
                'kategori' => 'Alat Ukur',
                'jumlah_total' => 15,
                'jumlah_tersedia' => 12,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Osiloskop Digital',
                'kategori' => 'Alat Ukur',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Power Supply DC',
                'kategori' => 'Alat Ukur',
                'jumlah_total' => 10,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Function Generator',
                'kategori' => 'Alat Ukur',
                'jumlah_total' => 6,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Logic Analyzer',
                'kategori' => 'Alat Ukur',
                'jumlah_total' => 4,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
            ],

            // ===== PRAKTIKUM =====
            [
                'nama_alat' => 'Arduino Uno R3',
                'kategori' => 'Praktikum',
                'jumlah_total' => 25,
                'jumlah_tersedia' => 20,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Raspberry Pi 4',
                'kategori' => 'Praktikum',
                'jumlah_total' => 15,
                'jumlah_tersedia' => 12,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Sensor Kit (37 in 1)',
                'kategori' => 'Praktikum',
                'jumlah_total' => 20,
                'jumlah_tersedia' => 15,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Breadboard 830 Point',
                'kategori' => 'Praktikum',
                'jumlah_total' => 30,
                'jumlah_tersedia' => 25,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Komponen Elektronika Kit',
                'kategori' => 'Praktikum',
                'jumlah_total' => 12,
                'jumlah_tersedia' => 10,
                'kondisi' => 'baik',
            ],

            // ===== JARINGAN =====
            [
                'nama_alat' => 'Router Cisco 2901',
                'kategori' => 'Jaringan',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Switch 24 Port',
                'kategori' => 'Jaringan',
                'jumlah_total' => 6,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Access Point Wireless',
                'kategori' => 'Jaringan',
                'jumlah_total' => 5,
                'jumlah_tersedia' => 3,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Crimping Tool',
                'kategori' => 'Jaringan',
                'jumlah_total' => 10,
                'jumlah_tersedia' => 8,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Network Cable Tester',
                'kategori' => 'Jaringan',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
            ],

            // ===== MULTIMEDIA =====
            [
                'nama_alat' => 'Graphic Tablet Wacom',
                'kategori' => 'Multimedia',
                'jumlah_total' => 5,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Webcam HD',
                'kategori' => 'Multimedia',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Tripod Kamera',
                'kategori' => 'Multimedia',
                'jumlah_total' => 6,
                'jumlah_tersedia' => 4,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Green Screen',
                'kategori' => 'Multimedia',
                'jumlah_total' => 3,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
            ],

            // ===== ROBOTIKA =====
            [
                'nama_alat' => 'Robot Kit Arduino',
                'kategori' => 'Robotika',
                'jumlah_total' => 8,
                'jumlah_tersedia' => 6,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Drone Programming',
                'kategori' => 'Robotika',
                'jumlah_total' => 4,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => '3D Printer Ender 3',
                'kategori' => 'Robotika',
                'jumlah_total' => 3,
                'jumlah_tersedia' => 2,
                'kondisi' => 'baik',
            ],
            [
                'nama_alat' => 'Sensor Ultrasonic',
                'kategori' => 'Robotika',
                'jumlah_total' => 15,
                'jumlah_tersedia' => 12,
                'kondisi' => 'baik',
            ]
        ];

        foreach ($peralatan as $data) {
            Peralatan::create($data);
        }
    }
}