<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

session_start();

use Carbon\Carbon;
use ev\Models\Session;
use ev\Models\Database;

require_once __DIR__ . '/../../vendor/autoload.php';

Carbon::setLocale('id_ID');

$newSession  = Session::validate();
$nis = $newSession['nis'];
$nama = $newSession['nama'];
$kelas = $newSession['kelas'];

/// try {
//     if (!isset($_SESSION['nis']) && !isset($_SESSION['nama']) && !isset($_SESSION['kelas'])) {
//         throw new Exception("Maaf, Data tidak lengkap");
//     }

//     $nis = $_SESSION['nis'];
//     $nama = $_SESSION['nama'];
//     $kelas = $_SESSION['kelas'];
// } catch (Exception $e) {
//     $error = $e->getMessage();
//     $_SESSION['error'] = $error;
//     header('Location: ../');
//     exit();
// }   

try {
    $resHadir = ($_SESSION['data'][0] / 14) * 5;
    $resTugas = $_SESSION['data'][1] * 0.1;
    $resFormatif = $_SESSION['data'][2] * 0.15;
    $resUts = $_SESSION['data'][3] * 0.3;
    $resUas = $_SESSION['data'][4] * 0.4;
    $tanggal = Carbon::now()->format('Y-m-d H:i:s');

    $nilaiAkhir = number_format($resHadir + $resTugas + $resFormatif + $resUts + $resUas, 2);

    $max = [
        90 => 'A',
        82 => 'B',
        79 => 'C',
        50 => 'D',
    ];

    $result = 'F';

    foreach ($max as $nilai => $grade) {
        if ($nilaiAkhir >= $nilai) {
            $result = $grade;
            break; //
        }
    }


    $db = new Database();

    $query = "INSERT 
                INTO nilai_siswa
                (nis, nama, kelas, nilai_kehadiran, nilai_tugas, nilai_formatif, nilai_uts, nilai_uas, result, nilai_akhir, tgl_nilai)
                VALUES 
                ('$nis', '$nama', '$kelas', '$resHadir', '$resTugas', '$resFormatif', '$resUts', '$resUas', '$result', '$nilaiAkhir','$tanggal')";

    $datas = mysqli_query($db->getConnection(), $query);

    if (!$datas) {
        throw new InvalidArgumentException("Gagal menambahkan data {$nama}");
    }

    echo
    "<script>
        alert('Data {$nama} berhasil ditambahkan!');
    </script>";

    unset($_SESSION['nis']);
    unset($_SESSION['nama']);
    unset($_SESSION['kelas']);

    $db->closeConnection();
} catch (\Throwable $e) {
    echo
    "<script>
        alert('Terjadi kesalahan: " . addslashes($e->getMessage()) . "');
    </script>";
    header('Location: /');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <title>Siswa <?= $nama ?>
    </title>
</head>

<body class="antialiased">
    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);">
            </div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Overview
                <?= $nama ?: 'Guest' ?>
            </h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Back <a href="../" class="underline-none text-slate-800 hover:underline">home</a>
            </p>
        </div>
        <div class="mx-auto mt-16 max-w-xl sm:mt-20">
            <ul class="space-y-3 text-sm">
                <li class="flex inline-flex border border-blue-300 rounded items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                    <span class="text-gray-800 dark:text-gray-400">
                        Kehadiran:
                        <?= ceil($resHadir) ?> / 5 <small class="text-gray-500">(
                            <?= number_format($resHadir, 2) ?>)
                        </small>
                    </span>
                </li>
                <li class="flex inline-flex border border-blue-300 rounded items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                    <span class="text-gray-800 dark:text-gray-400">
                        Nilai tugas: <span class="<?= $resTugas >= 75 ? 'text-green-600' : 'text-yellow-600' ?>"><?= $resTugas ?>0</span>
                    </span>
                </li>
                <li class="flex inline-flex border border-blue-300 rounded items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                    <span class="text-gray-800 dark:text-gray-400">
                        Nilai formatif: <span class="<?= ($resFormatif <= 60 || $resFormatif >= 60) ? 'text-yellow-500' : 'text-red-600'; ?>"><?= floor($resFormatif) ?></span>
                    </span>
                </li>
                <li class="flex inline-flex border border-blue-300 rounded items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                    <span class="text-gray-800 dark:text-gray-400">
                        Nilai UAS: <span class="<?= ($resUas >= 80) ? 'text-green-600' : 'text-red-600'; ?>"><?= floor($resUas) ?></span>
                    </span>
                </li>
                <li class="flex inline-flex border border-blue-300 rounded items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                    <span class="text-gray-800 dark:text-gray-400">
                        Nilai UTS: <span class="<?= ($resUts >= 80) ? 'text-green-600' : 'text-red-600'; ?>"><?= $resUts ?></span>
                    </span>
                </li>
                <li class="flex inline-flex border border-blue-300 rounded items-center gap-x-2 py-3 px-4 text-sm font-medium text-gray-800 dark:text-white">
                    <span class="text-gray-800 dark:text-gray-400">
                        Nilai akhir: <span class="<?= ($nilaiAkhir >= 80) ? 'text-green-600' : 'text-red-600'; ?>"><?= $nilaiAkhir ?></span>
                    </span>
                    <?= $result ?>
                </li>
            </ul>
        </div>
    </div>

    <script src="../dist/flowbite.min.js"></script>

</body>

</html>