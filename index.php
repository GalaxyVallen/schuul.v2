<?php
session_start();

require_once 'config/Database.php';

$db = new Database();

$query = 'select * from nilai_siswa';

$datas = $db->getConnection()->query($query) or die($connect);

$rows = [];
if ($datas->num_rows > 0) {
    while ($row = $datas->fetch_assoc()) {
        $rows[] = $row;
    }
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
} else {
    $error = null;
}

// if (mysqli_num_rows($datas) > 0) {
//     $rows = [];
//     while ($row = $datas->fetch_assoc()) {
//         $rows[] = $row;
//     }

//     // $rows = $datas->fetch_assoc();
//     // var_dump($rows);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="dist/output.css" rel="stylesheet">
    <title>Data Nilai</title>
</head>

<body>

    <!-- <?php include 'component/nav.php' ?> -->

    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <?php if (isset($error)) : ?>
            <div id="aler" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                    <?= $error; ?>
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#aler" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        <?php endif; ?>
        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg max-w-7xl mx-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <caption class="p-5 text-2xl relative font-semibold isolate text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    Semua siswa yg terdaftar
                    <p class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400">Sekitar <?= count($rows); ?> orang </p>
                    <div class="bg-gradient-to-br from-sky-50 to-transparent dark:from-blue-900 w-full h-full absolute top-0 left-0 -z-10"></div>
                    <a href="views/add.php" class="text-gray-100 inline-block mt-3 bg-blue-600 hover:bg-primary-800 focus:ring-4 hover:bg-blue-700 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Tambah siswa
                    </a>
                </caption>
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nis
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama </th>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai hadir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai tugas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai formatif
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai uts
                        </th>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai uas
                        </th>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nilai akhir
                        </th>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Grade
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($rows as $data) : ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $i ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $data['nis']; ?>
                            </td>
                            </th>
                            <td class="px-6 py-4">
                                <?= $data['nama']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['kelas']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilai_kehadiran']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilai_tugas']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilai_formatif']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilai_uts']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilai_uas']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilai_akhir']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['result']; ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="views/detail.php?siswa=<?= $data['id']; ?>" class="underline-none text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="dist/flowbite.min.js"></script>
</body>

</html>