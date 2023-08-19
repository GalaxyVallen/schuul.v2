<?php

class Session
{
  public static function validate()
  {
    if (!isset($_SESSION['nis']) || !isset($_SESSION['nama']) || !isset($_SESSION['kelas']) || !$_SESSION['auth']) {
      throw new Exception("Maaf, Data tidak lengkap");
    }

    $nis = $_SESSION['nis'];
    $nama = $_SESSION['nama'];
    $kelas = $_SESSION['kelas'];
    return compact('nis', 'nama', 'kelas');
  }

  public static function redirect($errorMessage, $redirectUrl)
  {
    $_SESSION['error'] = $errorMessage;
    header("Location: $redirectUrl");
    exit();
  }
}

//coba
try {
  Session::validate();
} catch (\Throwable $e) {
  $error = $e->getMessage();
  Session::redirect($error, '../');
}
