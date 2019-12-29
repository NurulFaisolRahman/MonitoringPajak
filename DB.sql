-- Adminer 4.7.5 PostgreSQL dump

-- \connect "tes";

DROP TABLE IF EXISTS "Akun";
CREATE TABLE "public"."Akun" (
    "Username" character varying(25) NOT NULL,
    "Password" character varying(60) NOT NULL,
    "JenisAkun" character varying(1) NOT NULL,
    "Pembuat" character varying(25),
    "WaktuRegistrasi" timestamp DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "Akun_Username" PRIMARY KEY ("Username"),
    CONSTRAINT "Akun_Pembuat_fkey" FOREIGN KEY ("Pembuat") REFERENCES "Akun"("Username") ON UPDATE CASCADE NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "Akun" ("Username", "Password", "JenisAkun", "Pembuat", "WaktuRegistrasi") VALUES
('faisol',  '$2y$10$TjT2D1kS3VSJqkB42v0O1OrZ3nrKab1/nepXxeGWV5bkSxpO/yhVu', '3',    'admin',    '2019-12-27 07:27:22.565769'),
('admin',   '$2y$10$EScvpZpsHjfILo8vKxSCK.IM.Mfs4TgHVZkuLepqq2UG.TmzeV5NO', '1',    'admin',    '2019-12-16 13:29:31'),
('cafekopi',    '$2y$10$OVJznLirBaoqh1jocd7EE.rypRyTP9Nmua3v7r2Sqxl.y8KbcUQX2', '3',    'admin',    '2019-12-27 15:03:18.98337'),
('econk',   '$2y$10$rtZeHUscLjUBbu8oL2A4vOguofKgYhlpV9NPypyxzbehR2Vfw5VLG', '2',    'admin',    '2019-12-18 23:05:28');

DROP TABLE IF EXISTS "Rekening";
CREATE TABLE "public"."Rekening" (
    "NomorRekening" character varying(15) NOT NULL,
    "JenisPajak" character varying(25) NOT NULL,
    "SubJenisPajak" character varying(25) NOT NULL,
    CONSTRAINT "Rekening_NomorRekening" PRIMARY KEY ("NomorRekening")
) WITH (oids = false);

INSERT INTO "Rekening" ("NomorRekening", "JenisPajak", "SubJenisPajak") VALUES
('01.04',   'Hotel',    'Hotel Bintang Tiga'),
('03.05',   'Hiburan',  'Pameran'),
('02.02',   'Restoran', 'Restoran Makan'),
('02.03',   'Restoran', 'Cafe'),
('07.01',   'Parkir',   'Parkir');

DROP TABLE IF EXISTS "Aktifitas";
CREATE TABLE "public"."Aktifitas" (
    "NamaUser" character varying(25) NOT NULL,
    "Aktifitas" character varying(100) NOT NULL,
    "IP" character varying(25) NOT NULL,
    "TanggalAkses" timestamp DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "Aktifitas_NamaUser_fkey" FOREIGN KEY ("NamaUser") REFERENCES "Akun"("Username") ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "Aktifitas" ("NamaUser", "Aktifitas", "IP", "TanggalAkses") VALUES
('admin',	'Akses Menu Wajib Pajak',	'::1',	'2019-12-30 06:04:58.76368'),
('admin',	'Akses Menu User',	'::1',	'2019-12-30 06:05:07.688311'),
('admin',	'Akses Menu Wajib Pajak',	'::1',	'2019-12-30 06:05:12.485912'),
('admin',	'Edit Data Wajib Pajak Dengan NPWPD = 1507.19.607',	'::1',	'2019-12-30 06:07:42.146471'),
('admin',	'Akses Menu Wajib Pajak',	'::1',	'2019-12-30 06:07:42.197357'),
('admin',	'Akses Menu Wajib Pajak',	'::1',	'2019-12-30 06:10:23.446867');

DROP TABLE IF EXISTS "WajibPajak";
CREATE TABLE "public"."WajibPajak" (
    "NPWPD" character varying(12) NOT NULL,
    "NamaWP" character varying(50) NOT NULL,
    "AlamatWP" character varying(50) NOT NULL,
    "NomorRekening" character varying(15) NOT NULL,
    "JamOperasional" character varying(11) NOT NULL,
    "Riwayat" character varying(25),
    "Status" character varying(10),
    "Koneksi" character varying(25),
    "Password" character varying(60),
    "Pembuat" character varying(25),
    "WaktuRegistrasi" timestamp DEFAULT CURRENT_TIMESTAMP,
    "PengirimanPertama" timestamp,
    "Sinyal" timestamp,
    "Pemilik" character varying(25),
    CONSTRAINT "WajibPajak_NPWPD" PRIMARY KEY ("NPWPD"),
    CONSTRAINT "WajibPajak_NomorRekening_fkey" FOREIGN KEY ("NomorRekening") REFERENCES "Rekening"("NomorRekening") ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE,
    CONSTRAINT "WajibPajak_Pemilik_fkey" FOREIGN KEY ("Pemilik") REFERENCES "Akun"("Username") ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "WajibPajak" ("NPWPD", "NamaWP", "AlamatWP", "NomorRekening", "JamOperasional", "Riwayat", "Status", "Koneksi", "Password", "Pembuat", "WaktuRegistrasi", "PengirimanPertama", "Sinyal", "Pemilik") VALUES
('1507.19.615', 'Hotel A',  'Malang',   '01.04',    '07.00-22.00',  '2019-12-29 20:31:00',  'Online',   'db',   '$2y$10$iSuBN7pciQJI82qI35xpNelfN7pPzoUpSPuhql5dnb4VWAYVPm3Qa', 'admin',    '2019-12-18 20:57:11',  '2019-12-26 21:11:39',  '2019-12-29 20:33:00',  'faisol'),
('1507.19.607', 'Hotel B',  'Malang',   '01.04',    '07.00-20.00',  '2019-12-30 06:10:08',  'Online',   'text', '$2y$10$QLODHKwqViXGqX53ubzbU.w7u6IzCQyoncGWN6LsEORTtPkYdk5ti', 'admin',    '2019-12-26 21:02:13.775008',   '2019-12-30 06:10:08',  '2019-12-27 14:13:00',  'faisol'),
('0000.00.001', 'Cafe Kopi',    'Jl Malang',    '02.03',    '00.01-24.00',  '2019-12-27 15:13:56',  'Enable',   'db',   '$2y$10$B6UCsShEMvO5Tg7i8TgPju.R.Y4132ijyHHamZOUf3hgUoVHLiDWm', 'admin',    '2019-12-27 15:01:54.823376',   '2019-12-27 15:13:55',  '2019-12-27 15:28:00',  'cafekopi'),
('1507.19.696', 'Restoran B',   'Demung',   '02.02',    '08.00-21.00',  '2019-12-26 21:11:39',  'Online',   'db',   '$2y$10$Q8QcHUnqjsSgErxXC.nC.O.fWCPlf1cFRsafas2eZ0aAXT3MhItCu', 'admin',    '2019-12-24 08:30:27',  '2019-12-26 21:11:39',  '2019-12-29 14:51:00',  NULL);

DROP TABLE IF EXISTS "Transaksi";
CREATE TABLE "public"."Transaksi" (
    "NPWPD" character varying(12) NOT NULL,
    "NomorTransaksi" character varying(25) NOT NULL,
    "SubNominal" character varying(15) NOT NULL,
    "Service" character varying(15) NOT NULL,
    "Diskon" character varying(15) NOT NULL,
    "Pajak" character varying(15) NOT NULL,
    "TotalTransaksi" character varying(15) NOT NULL,
    "WaktuTransaksi" timestamp,
    "JenisPajak" character varying(15),
    "WaktuTerima" timestamp DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "Transaksi_NomorTransaksi" PRIMARY KEY ("NomorTransaksi"),
    CONSTRAINT "Transaksi_NPWPD_fkey" FOREIGN KEY ("NPWPD") REFERENCES "WajibPajak"("NPWPD") ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);

INSERT INTO "Transaksi" ("NPWPD", "NomorTransaksi", "SubNominal", "Service", "Diskon", "Pajak", "TotalTransaksi", "WaktuTransaksi", "JenisPajak", "WaktuTerima") VALUES
('1507.19.607',	'1',	'51363',	'0',	'0',	'5136',	'56499',	'2019-12-10 15:01:00',	'Hotel',	'2019-12-30 06:10:08.057751'),
('1507.19.607',	'2',	'51363',	'0',	'0',	'5136',	'56499',	'2019-12-10 15:01:00',	'Hotel',	'2019-12-30 06:10:08.057751');

-- 2019-12-30 06:30:46.579016+07
