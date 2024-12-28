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
    <header class="fixed top-0 z-40 left-0 w-full bg-white shadow">
        <?php include 'navbar.php'; ?>
    </header>
    <div class="flex z-50 h-full">
        <div class="w-64 bg-white h-full border-r">
            <?php include 'sidebar.php'; ?>
        </div>
        <main class="flex bg-white dark:bg-gray-800 items-center justify-center pt-24 overflow-y-auto w-full h-screen overflow-y-auto">
            <div class="max-w-5xl  overflow-x-auto w-full  table-container">
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
                                                    <div class="relative bg-white rounded-lg shadow">
                                                        <div class="flex items-center justify-between p-4 border-b rounded-t">
                                                            <h3 class="text-lg font-semibold text-black dark:text-black">
                                                                Detail Kritik dan Saran dari <span id="modal-nama"></span>
                                                            </h3>

                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center" data-modal-toggle="crud-modal">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <div class="p-4">
                                                            <div class="mb-4">
                                                                <label for="kritik" class="block text-base font-medium text-gray-900">Kritik</label>
                                                                <p id="modal-kritik" class="text-sm border p-2 rounded-lg text-gray-900 border-gray-300">
                                                                    <!-- Kritik akan diinsert di sini -->
                                                                </p>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="saran" class="block text-base font-medium text-gray-900">Saran</label>
                                                                <p id="modal-saran" class="text-sm border p-2 rounded-lg text-gray-900 border-gray-300">
                                                                    <!-- Saran akan diinsert di sini -->
                                                                </p>
                                                            </div>
                                                            <form action="proses_balasan.php" method="POST">
                                                                <input type="hidden" name="id" id="modal-id" value="" />
                                                                <div class="mb-4">
                                                                    <label for="balasan" class="block text-sm font-medium text-gray-900">Balasan</label>
                                                                    <textarea
                                                                        id="balasan"
                                                                        name="balasan"
                                                                        rows="4"
                                                                        class="block w-full px-4 py-2 text-base text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                                                        placeholder="Masukkan balasan..." required></textarea>
                                                                </div>
                                                                <button type="submit" class="inline-block px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Kirim Balasan</button>
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
                    <nav class="inline-flex items-center">
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

        </main>

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