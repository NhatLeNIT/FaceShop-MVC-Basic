<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 25-May-17
 * Time: 16:31
 */
class N_Model
{
    // Biến lưu trữ kết nối
    private $conn;
    // Biến lưu trữ kết quả truy vấn
    protected $result = NULL;

    // Hàm Kết Nối
    public function connect()
    {
        // Nếu chưa kết nối thì thực hiện kết nối
        if (!$this->conn) {
            $this->conn = mysqli_connect(HOST, DB_USER, DB_PASSWORD, DB_NAME) or die ('Lỗi kết nối');
            mysqli_query($this->conn, "SET NAMES 'utf8'");
        }
    }

    // Hàm Ngắt Kết Nối
    public function disconnect()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }

    /**
     * Lấy kết quả truy vấn
     * @return array
     */
    public function getResult()
    {
        $resultTemp = array();
        if (!empty($this->result)) {
            while ($row = mysqli_fetch_assoc($this->result)) {
                array_push($resultTemp, $row);
            }
        }
        return $resultTemp;
    }

    /**
     * Hàm Insert
     * @param $table
     * @param $data
     * @return bool|mysqli_result
     */
    public function insert($table, $data)
    {
        // Lưu trữ danh sách field
        $fieldList = '';
        // Lưu trữ danh sách giá trị tương ứng với field
        $valueList = '';

        // Lặp qua data
        foreach ($data as $key => $value) {
            $fieldList .= ",`$key`";
            $valueList .= ",'" . mysqli_real_escape_string($this->conn, $value) . "'";
        }

        // Vì sau vòng lặp các biến $fieldList và $valueList sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'INSERT INTO `' . $table . '`(' . trim($fieldList, ',') . ') VALUES (' . trim($valueList, ',') . ')';

        return mysqli_query($this->conn, $sql);
    }

    /**
     * Hàm Update
     * @param $table
     * @param $data
     * @param $where
     * @return bool|mysqli_result
     */
    public function update($table, $data, $where)
    {
        $sql = '';
        // Lặp qua data
        foreach ($data as $key => $value) {
            $sql .= "`$key` = '" . mysqli_real_escape_string($this->conn, $value) . "',";
        }

        // Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
       $sql = 'UPDATE ' . $table . ' SET ' . trim($sql, ',') . ' WHERE ' . $where;

        return mysqli_query($this->conn, $sql);
    }

    /**
     * Hàm delete
     * @param $table
     * @param $where
     * @return bool|mysqli_result
     */
    public function remove($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->conn, $sql);
    }


    /**
     * Hàm thực thi câu lệnh sql
     * @param $sql
     * @return bool
     */
    public function execute($sql)
    {
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            $this->result = NULL;
            return FALSE;
        }

        $this->result = $result;
        return TRUE;
    }

    /**
     * Hàm lấy tổng số record
     * @return int
     */
    public function getNumRows() {
        return mysqli_num_rows($this->result);
    }

    /**
     * Hàm lấy id vừa mới insert
     * @return int|string
     */
    public function getInsertId(){
        return mysqli_insert_id($this->conn);
    }
}