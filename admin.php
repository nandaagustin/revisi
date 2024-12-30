<?php
session_start();
include "config.php";

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Define how many results per page
$limit = 5;

// Get the current page number from URL or set to 1 if not present
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset
$offset = ($page - 1) * $limit;

// Get the total number of records
$result_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kritik_saran");
$row_total = mysqli_fetch_assoc($result_total);
$total_records = $row_total['total'];

// Get the records for the current page
$result = mysqli_query($conn, "SELECT * FROM kritik_saran ORDER BY create_at DESC LIMIT $limit OFFSET $offset");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="fixed top-0 z-50 w-full bg-green-500 border-b border-gray-200 dark:bg-green-800 ">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="logo.png" class="h-10 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Kecamatan Bantarbolang</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">


                        <button id="theme-toggle" data-tooltip-target="tooltip-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div id="tooltip-toggle" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                            Toggle dark mode
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="#"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide dark:text-white truncate">Kelola Pengaduan</span>
                    </a>
                </li>

                <li>
                    <a href="logout.php" id="logout-link"
                        class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18V6h-5v12h5Zm0 0h2M4 18h2.5m3.5-5.5V12M6 6l7-2v16l-7-2V6Z" />
                            </svg>

                        </span>
                        <span class="ml-2 text-sm tracking-wide dark:text-white truncate">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64 bg-white dark:bg-gray-800">
        <div class="flex justify-center mt-6 items-center min-h-screen">
            <div class="max-w-5xl overflow-x-auto w-full table-container">
                <div class="relative max-h-[500px] overflow-y-auto border border-gray-300 rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <!-- Thead tetap di atas -->
                        <thead class="sticky top-0 z-10 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>

                                <th scope="col" class="px-6 py-3">Nama</th>
                                <th scope="col" class="px-6 py-3">Kritik</th>
                                <th scope="col" class="px-6 py-3">Saran</th>
                                <th scope="col" class="px-6 py-3">Balasan</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- Tbody dapat di-scroll -->
                        <tbody class="bg-white dark:bg-gray-800">
                            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?php echo htmlspecialchars($row['nama']); ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?php echo htmlspecialchars($row['kritik']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo htmlspecialchars($row['saran']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <?php echo !empty($row['balasan']) ? htmlspecialchars($row['balasan']) : '-'; ?>
                                        </td>
                                        <td class="px-6 py-2">
                                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                data-id="<?php echo htmlspecialchars($row['id']); ?>"
                                                data-nama="<?php echo htmlspecialchars($row['nama']); ?>"
                                                data-kritik="<?php echo htmlspecialchars($row['kritik']); ?>"
                                                data-saran="<?php echo htmlspecialchars($row['saran']); ?>"
                                                class="block text-white bg-green-700 dark:bg-green-800 hover:bg-green-800 dark:hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                Detail
                                            </button>

                                            <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow">
                                                        <div class="flex items-center justify-between p-4 border-b dark:border-gray-700 rounded-t">
                                                            <h3 class="text-base md:text-lg  font-semibold text-black dark:text-white">
                                                                Detail Kritik dan Saran dari <span id="modal-nama"></span>
                                                            </h3>

                                                            <button type="button" class="text-gray-400 dark:text-gray-300 bg-transparent hover:bg-gray-200 dark:hover:bg-gray-700 hover:text-gray-900 dark:hover:text-white rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <div class="p-4">
                                                            <div class="mb-4">
                                                                <label for="kritik" class="block text-base font-medium text-gray-900 dark:text-gray-300">Kritik</label>
                                                                <p id="modal-kritik" class="text-sm border bg-white dark:bg-gray-700  p-2 rounded-lg text-gray-900 dark:text-gray-200 border-gray-300 dark:border-gray-600">
                                                                    <!-- Kritik akan diinsert di sini -->
                                                                </p>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="saran" class="block text-base font-medium text-gray-900 dark:text-gray-300">Saran</label>
                                                                <p id="modal-saran" class="text-sm border bg-white dark:bg-gray-700  p-2 rounded-lg text-gray-900 dark:text-gray-200 border-gray-300 dark:border-gray-600">
                                                                    <!-- Saran akan diinsert di sini -->
                                                                </p>
                                                            </div>
                                                            <form action="proses_balasan.php" method="POST">
                                                                <input type="hidden" name="id" id="modal-id" value="" />
                                                                <div class="mb-4">
                                                                    <label for="balasan" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Balasan</label>
                                                                    <textarea
                                                                        id="balasan"
                                                                        name="balasan"
                                                                        rows="4"
                                                                        class="block w-full px-4 py-2 text-base text-gray-900 bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400"
                                                                        placeholder="Masukkan balasan..." required></textarea>
                                                                </div>
                                                                <button type="submit" class="inline-block px-6 py-2 text-white bg-green-500 hover:bg-green-600 dark:bg-green-500 dark:hover:bg-green-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-offset-2">Kirim Balasan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">No records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4">
                    <nav class="inline-flex items-center gap-3">
                        <?php
                        // Calculate total pages
                        $total_pages = ceil($total_records / $limit);
                        for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Event listener untuk semua tombol dengan data-modal-toggle
        document.querySelectorAll("[data-modal-toggle='crud-modal']").forEach(button => {
            button.addEventListener("click", function() {
                // Ambil data dari tombol yang diklik
                const nama = this.getAttribute("data-nama");
                const kritik = this.getAttribute("data-kritik");
                const saran = this.getAttribute("data-saran");
                const id = this.getAttribute("data-id");

                // Masukkan data ke dalam modal
                document.getElementById("modal-nama").textContent = nama;
                document.getElementById("modal-kritik").textContent = kritik;
                document.getElementById("modal-saran").textContent = saran;
                document.getElementById("modal-id").value = id;

                // Tampilkan modal
                document.getElementById("crud-modal").classList.remove("hidden");
            });
        });

        // Event listener untuk tombol close
        document.querySelectorAll("[data-modal-toggle='crud-modal']").forEach(button => {
            button.addEventListener("click", function() {
                // Sembunyikan modal
                document.getElementById("crud-modal").classList.add("hidden");
            });
        });
    </script>
    <script>
        // Ambil elemen tombol toggle dan ikon
        const themeToggle = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Simpan tema di localStorage
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            document.documentElement.classList.add('dark');
            darkIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            lightIcon.classList.remove('hidden');
        }

        // Toggle dark mode
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                darkIcon.classList.remove('hidden');
                lightIcon.classList.add('hidden');
            } else {
                localStorage.setItem('theme', 'light');
                darkIcon.classList.add('hidden');
                lightIcon.classList.remove('hidden');
            }
        });
    </script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah aksi default link

            // Tampilkan SweetAlert
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan logout dari sistem.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a550',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, arahkan ke halaman logout
                    window.location.href = 'logout.php';
                }
            });
        });
    </script>
</body>

</html>