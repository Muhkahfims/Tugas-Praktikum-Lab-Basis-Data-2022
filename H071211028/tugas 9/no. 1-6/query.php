<?php
class MyQuery
{
  function __construct($conn)
  {
    $this->conn = $conn;
  }

  function show_data()
  {
    echo "Daftar Orderan" . "\n";

    // Todo [1] : Buatkan query untuk menampilkan 5 data pelanggan terbaru berdasarkan waktu orderan
    $sql = "select customerNumber as 'id', orderDate as 'tanggal', customerName as 'nama'
    from orders
    join customers
    using(customerNumber)
    order by orderDate desc
    limit 5";

    // Jalankan Query dan Menampilkan
    $result = $this->conn->query($sql);
    $resultSet = array();
    if ($result->num_rows > 0) {
      $index = 1;
      while ($row = $result->fetch_array()) {
        $resultSet[$index - 1] = $row['id'];
        printf("%d. %s \t| %s\n", $index, $row['tanggal'], $row['nama']);
        $index++;
      }
    } else {
      echo "Hasil 0";
    }

    return $resultSet;
  }

  function update_name()
  {
    // tampilkan nama dan pilih nama
    $list_id = $this->show_data();
    $input = -1;
    while ($input < 0 || $input > 5) {
      try {
        echo "Pilih nama yang hendak kamu ubah\n";
        $input = (int)readline('> ') - 1;
      } catch (Exception $e) {
        $input = -1;
      }
    }
    echo 'Input Nama Baru';
    $new_name = readline('> ');

    // TODO [2] : menonaktikan sesuatu
    //
    $sql = "SET autocommit = 0"; // menyimpan query
    $this->conn->query($sql); //ini agar bisa dijalankan

    // TODO [3] : memulai sesuatu
    //
    $sql = "START TRANSACTION"; //memulai
    $this->conn->query($sql); //ini agar bisa dijalankan
    // TODO [4] : masukkan query untuk mengupdate nama berdasarkan id
    //
    $sql = "update customers
            set customerName = '$new_name'
            where customerNumber = '$list_id[$input]'";


    $this->conn->query($sql);
    $this->show_data();
    while (true) {
      echo 'Simpan Perubahan?' . "\n" . '1. YES' . "\n" . '2. NO' . "\n";
      $choice = readline('> ');
      switch ($choice) {
        case 1:
          // TODO [5] : melakukan sesuatu
          //
          $sql="commit";
          $this->conn->query($sql);
          return;
        case 2:
          // TODO [6] : melakukan sesuatu
          //
          $sql="rollback";
          $this->conn->query($sql);
          return;
        default:
          echo "Input Salah\n";
          break;
      }
    }
  }
}
