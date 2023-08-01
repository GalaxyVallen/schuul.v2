<?php
$nis = '002120';
$nama = 'Asuka';
$kelas = 'XII Rpl 2';

$nilaiKehadiran = 10;
$resHadir = ($nilaiKehadiran / 14) * 5;
$nilaiTugas = 80;
$resTugas = $nilaiTugas * 0.1;
$nilaiFormatif = 86;
$resFormatif = $nilaiFormatif * .15;
$nilaiUts = 90;
$resUts =  $nilaiUts * .3;
$nilaiUas = 88;
$resUas = $nilaiUas * .4;

$nilaiAkhir = null;

$nilaiAkhir = number_format($resHadir + $resTugas + $resFormatif = $resUts + $resUas, 2);

$result = 'F';
if ($nilaiAkhir >= 90 || $nilaiAkhir <= 100) {
    $result = 'A';
    $col = 'text-green-600';
} elseif ($nilaiAkhir >= 82 || $nilaiAkhir <= 90) {
    $result = 'B';
    $col = 'text-green-600';
} elseif ($nilaiAkhir >= 79 || $nilaiAkhir <= 82) {
    $result = 'C';
    $col = 'text-yellow-600';
} elseif ($nilaiAkhir >= 50 || $nilaiAkhir <= 79) {
    $result = 'D';
    $col = 'text-red-600';
} else {
    $result;
    $col = 'text-red-600';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Nilai <?= $nama ?></title>
</head>

<body>

    <div class="container mx-auto">
        <ul class="w-96 relative rounded-lg mt-48 flex flex-col shadow hover:shadow-lg">
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-base bg-black text-white border font-bold -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                Nilai dari <?= $nama ?>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                NIs: <?= $nis ?>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Nama: <?= $nama ?>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Kelas: <?= $kelas ?>
            </li>
            <li class="<?= $col ?> absolute bottom-4 right-4 text-8xl">
                <?= $result ?>
            </li>
        </ul>
        <ul class="w-96 rounded-lg mt-8 flex flex-col shadow hover:shadow-lg">
            <li class="inline-flex items-center gap-x-2 py-3 px-4 text-base bg-black text-white border font-bold -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                Detali
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 hover:bg-gray-50 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Kehadiran: <?= ceil($resHadir) ?> / 5 <small class="text-gray-500">(<?= number_format($resHadir, 2) ?>)</small>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 hover:bg-gray-50 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Nilai tugas: <span class="text-green-600"><?= $resTugas ?>0</span>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 hover:bg-gray-50 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Nilai formatif: <span class="<?= ($resFormatif <= 60 || $resFormatif >= 60) ? 'text-yellow-500' : 'text-red-600'; ?>"><?= floor($resFormatif) ?></span>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 hover:bg-gray-50 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Nilai UAS: <span class="<?= ($resUas >= 80) ? 'text-green-600' : 'text-red-600'; ?>"><?= floor($resUas) ?></span>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 hover:bg-gray-50 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Nilai UTS: <span class="<?= ($resUts >= 80) ? 'text-green-600' : 'text-red-600'; ?>"><?= $resUts ?></span>
            </li>
            <li class="inline-flex items-center gap-x-2 py-3 px-4 hover:bg-gray-50 text-base font-medium bg-white border text-gray-700 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-gray-700 dark:border-gray-700 dark:text-white">
                Nilai akhir: <span class="<?= ($nilaiAkhir >= 80) ? 'text-green-600' : 'text-red-600'; ?>"><?= $nilaiAkhir ?></span>
            </li>
        </ul>
    </div>
</body>

</html>