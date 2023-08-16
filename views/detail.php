<?php
session_start();

require_once '../config/Database.php';

(isset($_GET['siswa']) && !empty($_GET['siswa'])) ? $id = $_GET['siswa'] : die;

$db =  new Database();

$query = "select * from nilai_siswa where nilai_siswa.id = {$id}";

try {
    $result = $db->getConnection()->query($query);

    if (!$result) {
        throw new Exception("Query error: " . $db->getConnection()->error);
    }

    if (mysqli_num_rows($result) == 0) {
        throw new Exception("No data found for id " . $_GET['siswa']);
    }
} catch (\Throwable $e) {
    $error = $e->getMessage();
    $_SESSION['error'] = $error;
    header('Location: ../index.php');
    exit();
}


$data = $result->fetch_assoc();

$db->closeConnection();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../dist/output.css" rel="stylesheet">
    <title>Detail</title>
</head>

<body class="antialised min-h-screen">
    <section class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Detail <?= $data['nama'] ?? 'Rei' ?></h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400"></p>
            </div>

            <div class="overflow-hidden relative max-w-md mx-auto bg-white shadow-lg ring-1 ring-black/5 rounded-xl flex items-center gap-6 dark:bg-slate-800 dark:highlight-white/5">
                <img class="absolute -left-6 w-28 h-28 rounded-full shadow-lg" src="https://placehold.co/300x300/000000/FFFFFF.webp?text=<?= strtoupper(mb_substr($data['nama'], 0, 1)); ?>">
                <div class="min-w-0 py-5 pl-28 pr-5">
                    <div class="text-slate-900 font-semibold text-sm sm:text-lg truncate dark:text-slate-200"><?= $data['nama']; ?></div>
                    <div class="text-slate-500 font-medium text-sm sm:text-base leading-tight truncate dark:text-slate-400">Kelas: <?= $data['kelas']; ?></div>
                </div>
            </div>

        </div>
    </section>

    <script src="../dist/flowbite.min.js"></script>

</body>

</html>