<?php
require_once __DIR__ . '/../config/database.php';

class Pelanggan {
    private PDO $db;

    public function __construct() {
        $this->db = getConnection();
    }

    public function semua(): array {
        return $this->db->query('SELECT * FROM pelanggan ORDER BY id DESC')->fetchAll();
    }

    public function cari(int $id): ?array {
        $st = $this->db->prepare('SELECT * FROM pelanggan WHERE id = ?');
        $st->execute([$id]);
        return $st->fetch() ?: null;
    }

    public function tambah(array $d): void {
        $sql = 'INSERT INTO pelanggan (nama, email, password, no_telepon, alamat, level_member)
                VALUES (?, ?, ?, ?, ?, ?)';
        $this->db->prepare($sql)->execute([
            $d['nama'],
            $d['email'],
            password_hash($d['password'], PASSWORD_DEFAULT),
            $d['no_telepon'],
            $d['alamat'],
            $d['level_member'],
        ]);
    }

    public function ubah(int $id, array $d): void {
        if ($d['password'] !== '') {
            $sql = 'UPDATE pelanggan SET nama=?, email=?, password=?, no_telepon=?, alamat=?, level_member=? WHERE id=?';
            $params = [$d['nama'], $d['email'], password_hash($d['password'], PASSWORD_DEFAULT),
                       $d['no_telepon'], $d['alamat'], $d['level_member'], $id];
        } else {
            $sql = 'UPDATE pelanggan SET nama=?, email=?, no_telepon=?, alamat=?, level_member=? WHERE id=?';
            $params = [$d['nama'], $d['email'], $d['no_telepon'], $d['alamat'], $d['level_member'], $id];
        }
        $this->db->prepare($sql)->execute($params);
    }

    public function hapus(int $id): void {
        $this->db->prepare('DELETE FROM pelanggan WHERE id = ?')->execute([$id]);
    }
        public function cariByEmail(string $email): ?array {
        $st = $this->db->prepare('SELECT * FROM pelanggan WHERE email = ?');
        $st->execute([$email]);
        return $st->fetch() ?: null;
    }
}