CREATE TABLE tugas_web (
  kode VARCHAR(4) PRIMARY KEY,
  nama VARCHAR(50),
  sex ENUM('Pria', 'Wanita'),
  agama VARCHAR(10),
  provinsi VARCHAR(100),
  kota VARCHAR(100),
  alamat TEXT,
  password TEXT,
  hobi TEXT,
  tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);