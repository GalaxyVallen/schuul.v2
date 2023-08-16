<?php
session_start();

require_once '../config/Session.php';
$newSession  = Session::validateSession();

// Mengakses data dari array yang dihasilkan oleh metode validatenewSession ()
$nis = $newSession['nis'];
$nama = $newSession['nama'];
$kelas = $newSession['kelas'];
// try {
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

$resHadir = ($_POST['hadir'] / 14) * 5;
$resTugas = $_POST['tugas'] * 0.1;
$resFormatif = $_POST['formatif'] * .15;
$resUts = $_POST['uts'] * .3;
$resUas = $_POST['uas'] * .4;

$nilaiAkhir = number_format($resHadir + $resTugas + $resFormatif = $resUts + $resUas, 2);

if ($nilaiAkhir >= 90) {
    $result = 'A';
} else if ($nilaiAkhir >= 82) {
    $result = 'B';
} else if ($nilaiAkhir >= 79) {
    $result = 'C';
} else if ($nilaiAkhir >= 50) {
    $result = 'D';
} else {
    $result = 'F';
};

require_once '../config/Database.php';

$db = new Database();
$connect = $db->getConnection();

$query = "INSERT INTO nilai_siswa
        (nis, nama, kelas, nilai_kehadiran, nilai_tugas, nilai_formatif, nilai_uts, nilai_uas, result, nilai_akhir)
        VALUES ('$nis', '$nama', '$kelas', '$resHadir', '$resTugas', '$resFormatif', '$resUts', '$resUas', '$result', '$nilaiAkhir')";

$datas = mysqli_query($connect, $query);

if ($datas) {
    echo "
        <script>
            alert('Data {$nama} berhasil ditambahkan!');
        </script>
    ";
    session_destroy();
} else {
    echo "
        <script>
            alert('Data {$nama} gagal ditambahkan!');
        </script>
    ";
}

$db->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Nilai
        <?= $nama ?>
    </title>
</head>

<body>
    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);">
            </div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Nilai
                <?= $nama ?: 'Asuka' ?>
            </h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Back <a href="../">home</a>
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