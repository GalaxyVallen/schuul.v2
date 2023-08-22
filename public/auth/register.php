<?php
session_start();

use ev\Models\Database;

require_once __DIR__ . '/../../vendor/autoload.php';

if (isset($_SESSION['auth']) && isset($_SESSION['username'])) {
  header('Location: /');
  exit;
}

if (isset($_POST['go'])) {
  $name = htmlspecialchars($_POST['nama']);
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);

  try {
    $db = new Database();
    $conn = $db->getConnection();

    if (empty(trim($name)) || empty(trim($username)) || empty(trim($email)) || empty(trim($password))) {
      throw new InvalidArgumentException('Semua field harus diisi');
    }
    if (strlen($password) < 8) {
      throw new InvalidArgumentException('Panjang password harus 8 karakter');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      throw new InvalidArgumentException('Format email tidak valid');
    }

    $qe = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stateEmail = $conn->prepare($qe);
    $stateEmail->bind_param('s', $email);
    $stateEmail->execute();
    $stateEmail->bind_result($dbEmail);
    $stateEmail->fetch();
    $stateEmail->close();

    if ($dbEmail > 0) {
      throw new InvalidArgumentException("Email {$email} sudah terdaftar.");
    }

    $qe = "SELECT COUNT(*) FROM users WHERE username = ?";
    $stateUser = $conn->prepare($qe);
    $stateUser->bind_param('s', $username);
    $stateUser->execute();
    $stateUser->bind_result($dbUsername);
    $stateUser->fetch();
    $stateUser->close();

    if ($dbUsername > 0) {
      throw new InvalidArgumentException("Username {$username} sudah terdaftar.");
    }

    //di ceknya belakangan

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, name, email, password) VALUES (?, ?, ?, ?)";

    $username = mysqli_real_escape_string($conn, $username);
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $hash = mysqli_real_escape_string($conn, $hash);

    $stmt = $conn->prepare($query);

    //ssss for type of the all values param
    $stmt->bind_param("ssss", $username, $name, $email, $hash);
    if ($stmt->execute()) {
      $_SESSION['enter'] = "Welcome {$name}! Silahkan lanjutkan..";
      header('Location: login.php');
      exit;
    } else {
      throw new InvalidArgumentException("Gagal menambahkan data.");
    }

    $stmt->close();
    $db->closeConnection();
    exit;
  } catch (\Throwable $th) {
    $error = $th->getMessage();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/main.css" rel="stylesheet">
  <title>Sign up</title>
</head>

<body class="antialiased">
  <div class="isolate bg-white px-6 py-24 sm:py-32 lg:px-8">
    <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]" aria-hidden="true">
      <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[340.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#00CC99] to-[#6600FF] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]" style="clip-path: polygon(76% 16%, 47% 9%, 38% 28%, 0% 0%, 0% 25%, 11% 50%, 5% 100%, 25% 90%, 43% 79%, 42% 97%, 75% 91%, 69% 73%, 57% 43%, 96% 33%);"></div>
    </div>
    <div class="max-w-xl p-5 mx-auto">
      <div class="mx-auto text-center">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Sign up</h2>
      </div>
      <div class="mx-auto mt-10 sm:mt-15">
        <?php if (!empty($error)) : ?>
          <div id="aler" class="shadow-lg hover:shadow-xl duration-100 sm:max-w-7xl mx-auto flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Alert</span>
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
        <form class="grid grid-cols-1 gap-x-8 gap-y-6" action="" method="POST">
          <div class="mt-1 border-2 border-transparent border-l-red-600 bg-red-50 py-1 pl-2 text-sm text-red-600">
            <!-- error -->
          </div>
          <div class="relative z-0">
            <input value="<?php if (!empty($_POST['username'])) echo $_POST['username'] ?>" type="text" id="floating_usr" name="username" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="floating_usr" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
          </div>
          <div class="relative z-0 mt-2">
            <input value="<?php if (!empty($_POST['nama'])) echo $_POST['nama'] ?>" type="text" id="floating_nm" name="nama" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="floating_nm" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
          </div>
          <div class="relative z-0 mt-2">
            <input value="<?php if (!empty($_POST['email'])) echo $_POST['email'] ?>" type="email" id="floating_ml" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="floating_ml" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
          </div>
          <div class="relative z-0 mt-2">
            <input type="password" id="floating_pas" name="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="floating_pas" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
          </div>
          <div class="mt-4">
            <input type="submit" name="go" value="Sign up" class="cursor-pointer block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
          </div>
        </form>
        <p class="mt-5 text-center text-sm text-gray-500">
          Already a member?
          <a href="login.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Sign in!!</a>
        </p>
      </div>
    </div>
  </div>
  </div>

  <script src="../dist/flowbite.min.js"></script>
</body>

</html>