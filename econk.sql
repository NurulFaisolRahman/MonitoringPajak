-- Adminer 4.7.5 PostgreSQL dump
DROP TABLE IF EXISTS "Rekening";
CREATE TABLE "public"."Rekening" (
    "NomorRekening" character varying(15) NOT NULL,
    "JenisPajak" character varying(25) NOT NULL,
    "SubJenisPajak" character varying(25) NOT NULL,
    CONSTRAINT "Rekening_NomorRekening" PRIMARY KEY ("NomorRekening")
) WITH (oids = false);


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


DROP TABLE IF EXISTS "Aktifitas";
CREATE TABLE "public"."Aktifitas" (
    "NamaUser" character varying(25) NOT NULL,
    "Aktifitas" character varying(100) NOT NULL,
    "IP" character varying(25) NOT NULL,
    "TanggalAkses" timestamp DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT "Aktifitas_NamaUser_fkey" FOREIGN KEY ("NamaUser") REFERENCES "Akun"("Username") ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);


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


DROP TABLE IF EXISTS "Transaksi";
CREATE TABLE "public"."Transaksi" (
    "NPWPD" character varying(12) NOT NULL,
    "NomorTransaksi" character varying(25) NOT NULL,
    "NomorOrder" character varying(25) NULL,
    "SubNominal" character varying(15) NOT NULL,
    "Service" character varying(15) NOT NULL,
    "Diskon" character varying(15) NOT NULL,
    "Pajak" character varying(15) NOT NULL,
    "TotalTransaksi" character varying(15) NOT NULL,
    "WaktuTransaksi" character varying(25),
    "JenisPajak" character varying(15),
    "WaktuTerima" timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY ("NPWPD","NomorTransaksi"),
    CONSTRAINT "Transaksi_NPWPD_fkey" FOREIGN KEY ("NPWPD") REFERENCES "WajibPajak"("NPWPD") ON UPDATE CASCADE ON DELETE RESTRICT NOT DEFERRABLE
) WITH (oids = false);


-- 2020-01-13 16:41:48.476892+07
