<?php
session_start();

use ev\Models\Session;

require_once __DIR__ . '/../../vendor/autoload.php';

$newSession = Session::validate();
//jika ada ns nama

$nis = $newSession['nis'];
$nama = $newSession['nama'];
$kelas = $newSession['kelas'];

if (isset($_POST['go'])) {
    $hadir = htmlspecialchars($_POST['hadir']);
    $tugas = htmlspecialchars($_POST['tugas']);
    $formatif = htmlspecialchars($_POST['formatif']);
    $as = htmlspecialchars($_POST['uas']);
    $us = htmlspecialchars($_POST['uts']);

    try {
        if (empty(trim($hadir)) || empty(trim($tugas)) || empty(trim($formatif)) || empty(trim($as)) || empty(trim($us))) {
            throw new InvalidArgumentException('Isi semua field!');
        }

        if ($tugas > 100 || $formatif > 100 || $as > 100 || $us > 100) {
            throw new InvalidArgumentException('Nilai tidak boleh lebih dari 100');
        }

        if (!is_numeric($hadir) || !is_numeric($tugas) || !is_numeric($formatif) || !is_numeric($as) | !is_numeric($us)) {
            throw new InvalidArgumentException('Semua nilai harus berupa angka');
        }

        if (empty($errors)) {
            $data = array($hadir, $tugas, $formatif, $us, $as);
            $_SESSION['nama'] = $nama;
            $_SESSION['nis'] = $nis;
            $_SESSION['kelas'] = $kelas;
            $_SESSION['data'] = $data;

            header('Location: result.php');
            exit;
        }
        throw new InvalidArgumentException("Error while processing ur req");

        $_SESSION['auth'] = true;

        header('Location: nilai.php');
        exit;
    } catch (\Throwable $e) {
        $errors = $e->getMessage();
    }
}


// if (isset($_POST['go'])) {
//     $hadir = $_POST['hadir'];
//     $tugas = $_POST['tugas'];
//     $formatif = $_POST['formatif'];
//     $as = $_POST['uas'];
//     $us = $_POST['uts'];

//     if (empty($hadir) || empty($tugas) || empty($formatif) || empty($as) || empty($us)) {
//         $_SESSION['error'] = 'Isi semua field';
//     } else {
//         $_SESSION['auth'] = true;

//         header('Location: nilai.php');
//         exit;
//     }
// } 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <title>Nilai <?= $nama ?></title>
</head>

<body class="antialiased">
    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Input Nilai <?= $nama ?: 'Asuka' ?></h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">This where u add and calculate the
                <span class="font-semibold"><?= $nama ?: 'Asuka' ?></span> grades
            </p>
        </div>
        <form class="mx-auto mt-16 max-w-xl sm:mt-20" action="" method="post">
            <?php if (!empty($errors)) : ?>
                <div id="aler" class="shadow-lg hover:shadow-xl duration-100 sm:max-w-7xl mx-auto flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Alert</span>
                    <div class="ml-3 text-sm font-medium">
                        <?= $errors; ?>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#aler" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
            <div class="grid grid-cols-1 gap-x-8 gap-y-6">
                <div class="mt-2 w-full">
                    <div class="mb-3">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="number" value="<?php if (!empty($_POST['hadir'])) echo $_POST['hadir'] ?>" name="hadir" id="floating_hadir" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_hadir" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jumlah kehadiran</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="number" value="<?php if (!empty($_POST['tugas'])) echo $_POST['tugas'] ?>" name="tugas" id="floating_tsg" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_tsg" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nilai tugas</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="number" value="<?php if (!empty($_POST['formatif'])) echo $_POST['formatif'] ?>" name="formatif" id="floating_for" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_for" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nilai formatif</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="number" value="<?php if (!empty($_POST['uts'])) echo $_POST['uts'] ?>" name="uts" id="floating_uts" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_uts" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nilai uts</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="relative z-0 w-full mb-6 group">
                            <input type="number" value="<?php if (!empty($_POST['uas'])) echo $_POST['uas'] ?>" name="uas" id="floating_uas" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_uas" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nilai uas</label>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <input type="submit" value="Kirim" name="go" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                </div>
                <input type="hidden" name="nama" value="<?= $nama ?>">
                <input type="hidden" name="nis" value="<?= $nis ?>">
                <input type="hidden" name="kelas" value="<?= $kelas ?>">
            </div>
        </form>
    </div>

    <script src="../dist/flowbite.min.js"></script>

</body>

</html>