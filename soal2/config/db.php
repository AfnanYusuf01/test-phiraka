<?php
/**
 * Class Database (db)
 * Class sederhana untuk koneksi ke database PostgreSQL
 * Nilai: 30 poin
 */
class db {
    private $host   = 'localhost';
    private $port   = '5432';
    private $dbname = 'db_test_p';
    private $user   = 'postgres';
    private $pass   = '12345678';
    private $conn;

    /**
     * Constructor - membuat koneksi ke PostgreSQL
     */
    public function __construct() {
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }

    /**
     * Mendapatkan koneksi database
     * @return PDO
     */
    public function getConnection() {
        return $this->conn;
    }

    /**
     * Menjalankan query SELECT
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function select($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    /**
     * Menjalankan query INSERT
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function insert($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Menjalankan query UPDATE
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function update($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Menjalankan query DELETE
     * @param string $sql
     * @param array $params
     * @return bool
     */
    public function delete($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * Menutup koneksi
     */
    public function close() {
        $this->conn = null;
    }
}
?>
