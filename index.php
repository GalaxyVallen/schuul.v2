<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script> -->
    <title>Data siswa</title>
</head>
<!-- //masukin data siswa -->

<body class="antialiased">
    <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Cari Siswa</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Why do you want to know their <span class="font-bold">secret</span>? </p>
        </div>

        <form action="nilai.php" method="get" class="mx-auto mt-16 max-w-xl sm:mt-20">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6">
                <div>
                    <div class="flex mb-3 justify-between items-center">
                        <label for="first-name" class="block text-base font-semibold leading-6 text-gray-900">Nis</label>
                        <span class="inline-block text-sm text-gray-500">Wajib</span>
                    </div>
                    <div class="mt-2.5">
                        <input type="text" name="nis" id="first-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <div class="flex mb-3 justify-between items-center">
                        <label for="email" class="block text-base font-semibold leading-6 text-gray-900">Nama siswa</label>
                        <span class="inline-block text-sm text-gray-500">Wajib</span>
                    </div>
                    <div class="mt-2.5">
                        <input type="text" name="nama" id="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <div class="flex mb-3 justify-between items-center">
                        <label for="hs-select-label" class="block text-base font-semibold dark:text-white">Kelas</label>
                        <span class="inline-block text-sm text-gray-500">Wajib</span>
                    </div>
                    <select id="hs-select-label" name="kelas" class="py-3 ring-1 ring-inset ring-gray-300 px-2 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400">
                        <option>Pilih kelas</option>
                        <option value="XII Rpl-1">XII Rpl-1</option>
                        <option value="XII Rpl-2">XII Rpl-2</option>
                        <option value="XII Rpl-3">XII Rpl-3</option>
                    </select>
                </div>
            </div>
            <div class="mt-10">
                <input type="submit" value="Cari" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            </div>
        </form>
    </div>


    <!-- <form action="" method="get">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-square" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
        </svg>
        <input type="text" name="nis">
    </form> -->

</body>

</html>