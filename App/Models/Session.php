<?php

namespace ev\Models;

use InvalidArgumentException;

class Session
{
  public static function validate()
  {
    if (!isset($_SESSION['nis']) || !isset($_SESSION['nama']) || !isset($_SESSION['kelas']) || !$_SESSION['auth']) {
      throw new InvalidArgumentException("Maaf, Data tidak lengkap");
    }

    $nis = $_SESSION['nis'];
    $nama = $_SESSION['nama'];
    $kelas = $_SESSION['kelas'];
    return compact('nis', 'nama', 'kelas');
  }

  public static function redirect(string $errMsg, string $redirect)
  {
    $_SESSION['error'] = $errMsg;
    header("Location: $redirect");
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
