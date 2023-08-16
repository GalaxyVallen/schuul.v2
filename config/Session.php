<?php

class Session
{
  public static function validateSession()
  {
    if (!isset($_SESSION['nis']) || !isset($_SESSION['nama']) || !isset($_SESSION['kelas'])) {
      throw new Exception("Maaf, Data tidak lengkap");
    }

    $nis = $_SESSION['nis'];
    $nama = $_SESSION['nama'];
    $kelas = $_SESSION['kelas'];
    return compact('nis', 'nama', 'kelas');
  }

  public static function handleErrorAndRedirect($errorMessage, $redirectUrl)
  {
    $_SESSION['error'] = $errorMessage;
    header("Location: $redirectUrl");
    exit();
  }
}

try {
  Session::validateSession();
} catch (\Throwable $e) {
  $error = $e->getMessage();
  Session::handleErrorAndRedirect($error, '../');
}
