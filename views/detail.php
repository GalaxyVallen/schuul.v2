<?php
require '../config/connect.php';

(isset($_GET['siswa']) && !empty($_GET['siswa'])) ? $id = $_GET['siswa'] : exit;

$query = "select * from nilai where nilai.id = {$id}";

$result = $connect->query($query) ?? exit('Siswa ga ada');

$data = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Detail</title>
</head>

<body class="antialised min-">
    <section class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
            <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Detail <?= $data['nama'] ?? 'Rei' ?></h2>
                <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400"></p>
            </div>

            <div class="bg-gradient-to-r from-sky-500/20 to-blue-500/20 backdrop-blur-sm w-full max-w-lg py-8 px-6 bg-white mx-auto border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center pb-5 px-4 pt-4">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg object-cover" src="https://placehold.co/600x400?text=G" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"> <?= $data['nama'] ?? 'Rei' ?></h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400"> <?= $data['kelas'] ?>
                    </span>
                    <!-- <div class="flex mt-4 space-x-3 md:mt-6">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add friend</a>
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700">Message</a>
                </div> -->
                </div>
            </div>

        </div>
    </section>
</body>

</html>