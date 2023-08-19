<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

session_start();

if (isset($_SESSION['auth'])) {
    header('Location: nilai.php');
    exit;
}

if (isset($_POST['go'])) {
    $nama = $_POST['nama'];
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'] ?? '';

    try {
        if (empty(trim($nama)) || empty(trim($nis)) || $kelas === 'x') {
            throw new Exception('Isi semua field!');
        }

        if (!preg_match('/^[0-9]+$/', $nis)) {
            throw new Exception('NIS harus berupa nomor!');
        }

        if (strlen($nis) !== 10) {
            throw new Exception('Panjang NIS harus tepat 10 karakter!');
        }

        if (empty($errors)) {
            // var_dump($kelas);
            // die;

            $_SESSION['nama'] = $nama;
            $_SESSION['nis'] = $nis;
            $_SESSION['kelas'] = $kelas;
            $_SESSION['auth'] = true;

            header('Location: nilai.php');
            exit;
        }

        throw new Exception("Error while processing ur req");
    } catch (\Throwable $e) {
        $errors = $e->getMessage();
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="../css/main.css" rel="stylesheet">
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
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Tambah Siswa</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">
                Why do you want to know their <span class="font-bold">secret</span>? </p>
        </div>

        <form action="" method="post" class="mx-auto mt-16 max-w-xl sm:mt-20">
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
                <div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="number" name="nis" onkeyup="updateFraction();" value="<?php if (!empty($_POST['nis'])) : ?><?= $_POST['nis']; ?><?php endif; ?>" id="floating_Nis" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        <label for="floating_Nis" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 invalid:text-red-500 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nis siswa</label>
                        <small class="text-gray-700 ml-2" id="fractionText"></small>
                    </div>
                </div>
                <div>
                    <div class="relative z-0 w-full mb-4 group">
                        <input type="text" name="nama" value="<?php if (!empty($_POST['nama'])) echo $_POST['nama'] ?>" id="floating_name" class=" block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        <label for="floating_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama siswa</label>
                    </div>
                </div>

                <div>
                    <label for="hs-select-label" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                    <select id="hs-select-label" name="kelas" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="x">Pilih kelas</option>
                        <!-- <option value="x">Pilih kelas</option> -->
                        <option value="XII Rpl-1" <?php echo (isset($_POST['kelas']) && $_POST['kelas'] == 'XII Rpl-1') ? 'selected' : ''; ?>>XII Rpl-1</option>
                        <option value="XII Rpl-2" <?php echo (isset($_POST['kelas']) && $_POST['kelas'] == 'XII Rpl-2') ? 'selected' : ''; ?>>XII Rpl-2</option>
                        <option value="XII Rpl-3" <?php echo (isset($_POST['kelas']) && $_POST['kelas'] == 'XII Rpl-3') ? 'selected' : ''; ?>>XII Rpl-3</option>
                    </select>
                </div>
            </div>
            <div class="mt-10">
                <input type="submit" name="go" value="Cari" class="cursor-pointer block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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

    <script src="../dist/flowbite.min.js"></script>
    <script>
        let timeoutId;

        function updateFraction() {
            const inputValue = document.getElementById('floating_Nis').value;
            const fractionText = document.getElementById('fractionText');

            fractionText.textContent = (!inputValue) ? 'Belum ada angka yang kamu masukkan' : 'Total ' + inputValue.length + ' angka yang kamu masukkan';
        }
        updateFraction();
    </script>
</body>

</html>