<?php
session_start();

use ev\Models\Database;
use ev\Models\Functions;

require_once __DIR__ . '/../../vendor/autoload.php';

use Carbon\Carbon;

Carbon::setLocale('id_ID');

(isset($_GET['siswa']) && !empty($_GET['siswa'])) ? $id = $_GET['siswa'] : die;

$db =  new Database();

$query = "select * from nilai_siswa where nilai_siswa.id = {$id}";

try {
    $result = $db->getConnection()->query($query);

    if (!$result) {
        throw new InvalidArgumentException("Query error: " . $db->getConnection()->error);
    }

    if (mysqli_num_rows($result) == 0) {
        throw new InvalidArgumentException("No data found for id " . $_GET['siswa']);
    }

    $data = $result->fetch_object();

    $db->closeConnection();
} catch (\Throwable $e) {
    $error = $e->getMessage();
    $_SESSION['error'] = $error;
    header('Location: ../');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/main.css" rel="stylesheet">
    <title>Detail</title>
</head>

<body class="antialised min-h-screen">
    <section class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <?php if (isset($error)) : ?>
            <div id="aler" class="shadow-lg hover:shadow-xl duration-100 sm:max-w-7xl mx-auto flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
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
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <!-- <div class="overflow-hidden relative max-w-md mx-auto bg-white shadow-lg ring-1 ring-black/5 rounded-xl flex items-center gap-6 dark:bg-slate-800 dark:highlight-white/5">
                <img class="absolute -left-6 w-28 h-28 rounded-full shadow-lg" src="https://placehold.co/300x300/000000/FFFFFF.webp?text=<?= strtoupper(mb_substr($data->nama, 0, 1)); ?>">
                <div class="min-w-0 py-5 pl-28 pr-5">
                    <div class="text-slate-900 font-semibold text-sm sm:text-lg truncate dark:text-slate-200"><?= $data->nama; ?></div>
                    <div class="text-slate-500 font-medium text-sm sm:text-base leading-tight truncate dark:text-slate-400">Kelas: <?= $data->kelas; ?></div>
                </div>
                <span class="bg-gray-100 ml-auto mr-4 text-gray-800 font-semibold text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500">
                    <svg class="w-2.5 h-2.5 mr-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                    </svg>
                </span>
            </div> -->
            <!-- bg-slate-200/[0.25] -->

            <div class="max-w-2xl p-3 mx-auto bg-gradient-to-r from-gray-100 to-slate-200 backdrop-blur-sm dark:bg-gray-800 shadow-xl border rounded-lg overflow-hidden">
                <div class="grid grid-cols-2 gap-4">
                    <!-- <div class="mb-4 col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">NIS</dt>
                        <dd class="mt-1 text-gray-800 text-lg dark:text-white"><?= $data->nis ?></dd>
                    </div> -->
                    <div class="px-1 col-span-2">
                        <!-- <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</dt>
                        <dd class="mt-1 text-gray-800 text-lg dark:text-white"><?= $data->nama ?></dd> -->
                        <h1 class="text-gray-900 dark:text-white text-3xl md:text-5xl font-extrabold mb-2"><?= $data->nama ?></h1>
                        <p class="text-lg font-normal text-gray-600 dark:text-gray-500">Nis: <?= $data->nis ?></p>
                        <span class="text-gray-800 text-sm font-semibold mt-2 block dark:bg-gray-700 dark:text-gray-400">Dibuat
                            <?= Carbon::parse($data->tgl_nilai)->diffForHumans() ?> </span>
                        <hr class="h-px mt-3 -mb-2 bg-gray-400 border-0 dark:bg-gray-800">
                    </div>
                    <div class="grid border mb-0.5 border-gray-200 rounded-lg dark:border-gray-700 col-span-2 md:grid-cols-2">
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-tl-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Kelas</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->kelas ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-tr-lg md:rounded-t-none md:rounded-tr-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Attendance Grade</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->nilai_kehadiran ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-none md:rounded-t-none md:rounded-none md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Assignment Grade</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->nilai_tugas ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-none md:rounded-t-none md:rounded-none md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Formative Assessment Grade</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->nilai_formatif ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-none md:rounded-t-none md:rounded-none md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Midterm Exam Grade</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->nilai_uts ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-none md:rounded-t-none md:rounded-none md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Final Exam Grade</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->nilai_uas ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-bl-lg md:rounded-t-none md:rounded-bl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Overall Result</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white"><?= $data->result ?></dd>
                        </div>
                        <div class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-br-lg md:rounded-t-none md:rounded-br-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Final Score</dt>
                            <dd class="mt-1 text-gray-800 font-semibold dark:text-white <?= Functions::getClass($data->nilai_akhir); ?>"><?= $data->nilai_akhir ?></dd>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script src="../dist/flowbite.min.js"></script>

</body>

</html>