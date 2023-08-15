<?php

require 'config/connect.php';

$query = 'select * from nilai';

$datas = $connect->query($query) or die($connect);

if (mysqli_num_rows($datas) > 0) {
    $rows = [];
    while ($row = $datas->fetch_assoc()) {
        $rows[] = $row;
    }

    // $rows = $datas->fetch_assoc();
    // var_dump($rows);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Data Nilai</title>
</head>

<body>

    <?php include 'component/nav.php' ?>

    <div class="bg-white px-6 py-24 sm:py-32 lg:px-8">
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
                        <!-- <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th> -->
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
                                <a href="views/detail.php?siswa=<?= $data['id']; ?>" class="underline-none text-blue-600 hover:underline"><?= $data['nama']; ?></a>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['kelas']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilaiKehadiran']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilaiTugas']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilaiFormatif']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilaiUTS']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilaiUAS']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['nilaiAkhir']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $data['grade']; ?>
                            </td>
                            <!-- <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td> -->
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>