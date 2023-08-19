<?php
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nilai <?= $nama ?></title>
</head>

<body class="antialiased">

    <?= $_SERVER['DOCUMENT_ROOT']; ?>

    <!-- <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Input Nilai <?= $nama ?: 'Asuka' ?></h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">This where u add and calculate the
                <span class="font-semibold"><?= $nama ?: 'Asuka' ?></span> grades
            </p>
        </div>
        <form class="mx-auto mt-16 max-w-xl sm:mt-20" action="result.php" method="post">
            <div class=" mx-auto w-96">
                <div class="mt-2 w-full">
                    <div class="mb-3">
                        <label for="username" class="block text-base font-semibold mt-3 leading-6 text-gray-900">Jumlah kehadiran</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="hadir" id="" class="block flex-1 px-3 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="block text-base font-semibold mt-3 leading-6 text-gray-900">Nilai tugas</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="tugas" id="" class="block flex-1 px-3 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="block text-base font-semibold mt-3 leading-6 text-gray-900">Nilai formatif</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="formatif" id="" class="block flex-1 px-3 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="block text-base font-semibold mt-3 leading-6 text-gray-900">Nilai UTS</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="uts" id="" class="block flex-1 px-3 border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="block text-base font-semibold leading-6 text-gray-900">Nilai UAS</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="uas" id="" class="block flex-1 px-3 border-0 bg-transparent py-1.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <input type="submit" value="Kirim" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                </div>
                <input type="hidden" name="nama" value="<?= $nama ?>">
                <input type="hidden" name="nis" value="<?= $nis ?>">
                <input type="hidden" name="kelas" value="<?= $kelas ?>">
            </div>
        </form>
    </div> -->

</body>

</html>