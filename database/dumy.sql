INSERT INTO m_ruangan (kode_ruangan, nama_ruangan, jenis_ruangan, lantai, kapasitas, penanggung_jawab, keterangan, created_by)
VALUES 
('R001', 'Kelas 1A', 'kelas', 1, 30, 'Budi Santoso', 'Ruang kelas utama', 1),
('R002', 'Kelas 1B', 'kelas', 1, 32, 'Siti Aminah', 'Ruang kelas cadangan', 1),
('R003', 'Kantor TU', 'kantor', 1, 5, 'Dewi Puspita', 'Ruang tata usaha', 1),
('R004', 'Laboratorium Komputer', 'laboratorium', 2, 20, 'Joko Prasetyo', 'Lab komputer utama', 1),
('R005', 'Perpustakaan Utama', 'perpustakaan', 2, 15, 'Lina Herawati', 'Perpustakaan sekolah', 1),
('R006', 'Gudang Alat', 'gudang', 0, 10, 'Samsul Hadi', 'Gudang peralatan sekolah', 1),
('R007', 'Kelas 2A', 'kelas', 2, 30, 'Rina Melati', 'Ruang kelas atas', 1),
('R008', 'Kelas 2B', 'kelas', 2, 30, 'Tono Rahman', 'Ruang kelas atas 2', 1),
('R009', 'Kelas 3A', 'kelas', 3, 28, 'Yuni Safitri', 'Kelas tingkat akhir', 1),
('R010', 'Kelas 3B', 'kelas', 3, 29, 'Arif Nugroho', 'Kelas tambahan tingkat akhir', 1);


INSERT INTO m_siswa (nis, nama_siswa, kelas, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, nama_ortu, no_hp_ortu, created_by)
VALUES 
('NIS001', 'Ahmad Fauzi', '1A', 'Jakarta', '2010-01-15', 'L', 'Jl. Merdeka No.1', 'Samsudin', '081234567001', 1),
('NIS002', 'Siti Nurhaliza', '1B', 'Bandung', '2010-02-18', 'P', 'Jl. Kamboja No.2', 'Solehah', '081234567002', 1),
('NIS003', 'Rian Saputra', '2A', 'Bogor', '2009-03-20', 'L', 'Jl. Anggrek No.3', 'Andi Saputra', '081234567003', 1),
('NIS004', 'Dewi Lestari', '2B', 'Depok', '2009-04-25', 'P', 'Jl. Mawar No.4', 'Sri Mulyani', '081234567004', 1),
('NIS005', 'Budi Hartono', '3A', 'Bekasi', '2008-05-10', 'L', 'Jl. Melati No.5', 'Tatang', '081234567005', 1),
('NIS006', 'Nina Kartika', '3B', 'Tangerang', '2008-06-12', 'P', 'Jl. Dahlia No.6', 'Yulianti', '081234567006', 1),
('NIS007', 'Indra Lesmana', '1A', 'Jakarta', '2010-07-11', 'L', 'Jl. Mawar No.7', 'Joko Lesmana', '081234567007', 1),
('NIS008', 'Maya Sari', '1B', 'Bandung', '2010-08-15', 'P', 'Jl. Tulip No.8', 'Rahmat Sari', '081234567008', 1),
('NIS009', 'Riko Pratama', '2A', 'Bogor', '2009-09-19', 'L', 'Jl. Kenanga No.9', 'Prasetyo', '081234567009', 1),
('NIS010', 'Lina Marlina', '3A', 'Depok', '2008-10-21', 'P', 'Jl. Flamboyan No.10', 'Hasanah', '081234567010', 1);


INSERT INTO m_aset (kode_aset, nama_aset, kategori, merk, tipe, spesifikasi, jumlah, satuan, lokasi_fisik, ruangan_id, tahun_perolehan, sumber_dana, harga_satuan, status, created_by)
VALUES 
('A001', 'Komputer', 'Elektronik', 'Asus', 'A320', 'Core i5, RAM 8GB', 5, 'unit', 'Lab Komputer', 4, 2020, 'Dana BOS', 7000000, 1, 1),
('A002', 'Printer', 'Elektronik', 'Canon', 'IP2770', 'Inkjet', 2, 'unit', 'Kantor TU', 3, 2019, 'Dana BOS', 1200000, 1, 1),
('A003', 'Proyektor', 'Elektronik', 'Epson', 'EB-S41', 'SVGA 3300 lumens', 1, 'unit', 'Kelas 1A', 1, 2021, 'Komite Sekolah', 4500000, 1, 1),
('A004', 'Meja Belajar', 'Furniture', 'Olympic', 'Meja Siswa', 'Kayu jati', 30, 'unit', 'Kelas 1A', 1, 2018, 'Dana BOS', 250000, 1, 1),
('A005', 'Kursi Belajar', 'Furniture', 'Olympic', 'Kursi Siswa', 'Kayu jati', 30, 'unit', 'Kelas 1A', 1, 2018, 'Dana BOS', 150000, 1, 1),
('A006', 'Lemari Arsip', 'Furniture', 'Modera', 'Steel', 'Lemari 2 pintu', 2, 'unit', 'Kantor TU', 3, 2017, 'Dana BOS', 800000, 1, 1),
('A007', 'Rak Buku', 'Furniture', 'IKEA', 'RBT01', 'Kayu solid', 5, 'unit', 'Perpustakaan Utama', 5, 2020, 'Donatur', 500000, 1, 1),
('A008', 'Laptop', 'Elektronik', 'HP', 'Pavilion 14', 'Intel i5, SSD 512GB', 1, 'unit', 'Kantor TU', 3, 2022, 'Dana BOS', 9000000, 1, 1),
('A009', 'Papan Tulis', 'Perlengkapan', 'Standard', 'Whiteboard', 'Aluminium frame', 10, 'unit', 'Kelas 1A', 1, 2019, 'Dana BOS', 300000, 1, 1),
('A010', 'Alat Ukur', 'Lab', 'Casio', 'Scientific Tools', 'Set lengkap', 3, 'set', 'Lab Komputer', 4, 2021, 'Komite Sekolah', 1500000, 1, 1);


INSERT INTO m_pengadaan (no_pengadaan, tanggal_pengadaan, aset_id, jumlah, satuan, harga_satuan, total_harga, sumber_dana, supplier, dokumen_pengadaan, created_by)
VALUES 
('PG001', '2023-01-10', 1, 5, 'unit', 7000000, 35000000, 'Dana BOS', 'PT Teknologi Jaya', 'dok1.pdf', 1),
('PG002', '2023-02-15', 2, 2, 'unit', 1200000, 2400000, 'Dana BOS', 'CV Print Solution', 'dok2.pdf', 1),
('PG003', '2023-03-20', 3, 1, 'unit', 4500000, 4500000, 'Komite Sekolah', 'PT VisionTech', 'dok3.pdf', 1),
('PG004', '2023-04-05', 4, 30, 'unit', 250000, 7500000, 'Dana BOS', 'PT Furniture Kita', 'dok4.pdf', 1),
('PG005', '2023-05-12', 5, 30, 'unit', 150000, 4500000, 'Dana BOS', 'PT Kursi Siswa', 'dok5.pdf', 1),
('PG006', '2023-06-17', 6, 2, 'unit', 800000, 1600000, 'Dana BOS', 'CV Arsip Makmur', 'dok6.pdf', 1),
('PG007', '2023-07-21', 7, 5, 'unit', 500000, 2500000, 'Donatur', 'CV Buku Pustaka', 'dok7.pdf', 1),
('PG008', '2023-08-29', 8, 1, 'unit', 9000000, 9000000, 'Dana BOS', 'PT Elektronik Nusantara', 'dok8.pdf', 1),
('PG009', '2023-09-10', 9, 10, 'unit', 300000, 3000000, 'Dana BOS', 'PT Whiteboard Kita', 'dok9.pdf', 1),
('PG010', '2023-10-05', 10, 3, 'set', 1500000, 4500000, 'Komite Sekolah', 'PT Lab Supplies', 'dok10.pdf', 1);


INSERT INTO m_mutasi (aset_id, jumlah, dari_ruangan_id, ke_ruangan_id, tanggal_mutasi, alasan, dokumen_mutasi, created_by)
VALUES 
(1, 2, 4, 1, '2024-01-05', 'Digunakan untuk ujian di kelas', 'mut1.pdf', 1),
(2, 1, 3, 1, '2024-01-10', 'Digunakan presentasi kelas', 'mut2.pdf', 1),
(3, 1, 1, 3, '2024-02-15', 'Pindah ke ruang guru', 'mut3.pdf', 1),
(4, 10, 1, 7, '2024-03-01', 'Pindah ke kelas baru', 'mut4.pdf', 1),
(5, 10, 1, 8, '2024-03-02', 'Distribusi kursi siswa', 'mut5.pdf', 1),
(6, 1, 3, 6, '2024-04-10', 'Dijadikan arsip', 'mut6.pdf', 1),
(7, 2, 5, 7, '2024-05-12', 'Rak dipindah ke kelas', 'mut7.pdf', 1),
(8, 1, 3, 3, '2024-06-01', 'Laptop digunakan tetap', 'mut8.pdf', 1),
(9, 2, 1, 2, '2024-06-05', 'Papan tulis cadangan', 'mut9.pdf', 1),
(10, 1, 4, 5, '2024-06-10', 'Alat lab dipinjam perpustakaan', 'mut10.pdf', 1);
