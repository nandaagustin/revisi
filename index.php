<?php include 'config.php';
$status = isset($_GET['status_kirim']) ? $_GET['status_kirim'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        @keyframes fallIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fall {
            animation: fallIn 1s ease-out forwards;
        }
    </style>
</head>

<body>
    <div class="py-16 bg-cover bg-center flex justify-center h-full" style="background-image: url('backround.jpg')" ;>
        <div class="bg-white w-full p-8 max-w-[360px] lg:max-w-3xl 2xl:max-w-4xl lg:py-12 lg:px-16 rounded-xl shadow-xl">
            <?php if ($status == 'success'): ?>
                <script>
                    Swal.fire({
                        title: 'Terima Kasih!',
                        text: 'Kritik dan saran Anda berhasil dikirim.',
                        icon: 'success',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'bg-green-600 text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300'
                        }
                    });
                </script>
            <?php elseif ($status == 'error'): ?>
                <script>
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Terjadi kesalahan, coba lagi nanti.',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'bg-red-600 text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300'
                        }
                    });
                </script>
            <?php endif; ?>

            <!-- Close Button -->
            <div class="flex justify-end mt-2">
                <a href="login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="23" width="20.5" viewBox="0 0 448 512">
                        <path fill="green"
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                </a>
            </div>

            <!-- Title -->
            <div class="text-center mb-8 text-2xl lg:text-3xl font-semibold text-gray-800">
                Berikan Kritik & Saran Anda!
            </div>

            <!-- Form -->
            <div class="space-y-6">
                <form action="proses_kritik.php" method="post">
                    <!-- Name Input -->
                    <div>
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" id="nama" name="nama"
                            class="block w-full p-3 mb-4 text-gray-900 border border-green-300 rounded-md bg-gray-50 text-sm shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition ease-in-out"
                            required placeholder="Masukkan Nama Anda">
                    </div>

                    <!-- Kritik Input -->
                    <div>
                        <label for="kritik" class="block mb-2 text-sm font-medium text-gray-900">Kritik</label>
                        <textarea id="kritik" rows="4" name="kritik"
                            class="block p-3 w-full text-sm mb-4 text-gray-900 bg-gray-50 rounded-lg border border-green-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition ease-in-out"
                            placeholder="Masukkan Kritik Anda!" required></textarea>
                    </div>

                    <!-- Saran Input -->
                    <div>
                        <label for="saran" class="block mb-2 text-sm font-medium text-gray-900">Saran</label>
                        <textarea id="saran" rows="4" name="saran"
                            class="block p-3 w-full text-sm mb-4 text-gray-900 bg-gray-50 rounded-lg border border-green-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 transition ease-in-out"
                            placeholder="Masukkan Saran Anda!" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center mt-8">
                        <button type="submit"
                            class="w-full text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-6 py-3 transition ease-in-out">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="bg-gradient-to-r from-green-200 via-green-100 to-blue-200 px-8 lg:px-32 pb-24">
        <div class="text-center pt-9 pb-10 lg:pt-16 ">
            <h1 class="kritik-saran-item text-green-700 text-lg lg:text-3xl font-bold">Kritik dan Saran Pengguna</h1>
            <p class="kritik-saran-item text-base lg:text-lg text-gray-600 font-semibold">Bersama Membangun yang Lebih Baik</p>
        </div>

        <div class="flex flex-col justify-center items-center min-h-screen pb-6">
            <?php
            // Jumlah card per halaman
            $limit = 5;

            // Tentukan halaman saat ini, default ke halaman 1 jika tidak ada parameter 'page'
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Hitung offset berdasarkan halaman yang dipilih
            $offset = ($page - 1) * $limit;

            // Query untuk mengambil data dengan limit dan offset
            $result = mysqli_query($conn, "SELECT * FROM kritik_saran ORDER BY create_at DESC LIMIT $limit OFFSET $offset");

            while ($row = mysqli_fetch_assoc($result)) :
            ?>
                <!-- Card Container -->
                <div class="bg-white kritik-saran-item w-full max-w-4xl shadow-lg border border-gray-200 rounded-lg p-4 lg:p-6 mb-3 lg:mb-5">

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="md:text-lg text-base font-semibold text-green-700"><?php echo $row['nama']; ?></h3>
                            <p class="md:text-sm text-xs text-gray-500"><?php echo $row['create_at']; ?></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm0-4h-2V7h2v8z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-gray-500 text-xs md:text-sm">Kritik & Saran</span>
                        </div>
                    </div>
                    <!-- Kritik & Saran -->
                    <div class="lg:mb-4 mb-3">
                        <p class="text-gray-700 mb-2 text-sm md:text-base">
                            <span class="text-green-700 ">Kritik : </span> <?php echo $row['kritik']; ?>
                        </p>
                        <p class="text-gray-700 text-sm md:text-base">
                            <span class="text-blue-700 ">Saran : </span> <?php echo $row['saran']; ?>
                        </p>
                    </div>
                    <!-- Balasan Section -->
                    <?php if ($row['balasan']) : ?>
                        <div class="mt-6 bg-green-50 border border-green-300 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <!-- Updated Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 13a1 1 0 01-1 1H5.414l-3.707 3.707A1 1 0 010 16.293V3a1 1 0 011-1h16a1 1 0 011 1v10zm-5-5a1 1 0 00-1 1v2a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 00-1-1h-2z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div>
                                    <p class="text-blue-700 font-semibold">Balasan:</p>
                                    <p class="text-gray-700"><?php echo $row['balasan']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>

            <!-- Pagination Controls -->
            <div class="flex justify-center mt-6 mb-14">
                <div class="flex items-center space-x-2">
                    <?php
                    // Hitung total jumlah card
                    $total_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kritik_saran");
                    $total_row = mysqli_fetch_assoc($total_result);
                    $total_cards = $total_row['total'];

                    // Hitung jumlah halaman yang dibutuhkan
                    $total_pages = ceil($total_cards / $limit);

                    // Tombol Prev
                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '" class="px-4 py-2 bg-green-600 text-white hover:bg-green-800  rounded-lg">Sebelumnya</a>';
                    }

                    // Tombol Next
                    if ($page < $total_pages) {
                        echo '<a href="?page=' . ($page + 1) . '" class="px-4 py-2 bg-green-600 text-white hover:bg-green-800 rounded-lg">Selanjutnya</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="flex  justify-center pb-16">
            
            <div class="lg:w-[900px] lg:h-[700px] w-[300px] h-[400px]">
            <p class="lg:text-3xl text-lg font-bold text-green-700 py-5 text-center">Lokasi Kantor Kecamatan Bantarbolang</p>
            <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.7875193353407!2d109.37563087481068!3d-7.034242092967677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fe809d63ff30b%3A0x6526ecbee267187!2sKantor%20Kecamatan%20Bantarbolang!5e0!3m2!1sid!2sid!4v1734242374914!5m2!1sid!2sid"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>


    </div>
    <!--Footer container-->
    <footer
        class="flex flex-col items-center  bg-[#0a382d] text-left text-surface  text-white">
        <div class="mx-auto w-full p-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 mr-24 md:mb-0">
                    <a href="index.php" class="flex items-center">
                        <img src="logo.png" class="h-16 lg:h-20 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl lg:text-2xl font-semibold whitespace-nowrap dark:text-white">Kecamatan Bantarbolang</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-xs md:text-base font-semibold uppercase text-white">Alamat</h2>
                        <ul class="text-white text-xs md:text-base font-normal">
                            <li>
                                <a href="https://maps.app.goo.gl/enaUjietn8RcSzfP9" class="hover:underline">Jl. Raya Bantarbolang No 17 Pemalang</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-xs md:text-base  font-semibold  uppercase text-white">Jam Operasional</h2>
                        <ul class=" text-white text-xs md:text-base font-normal">
                            <li class="mb-2">
                                Senin-Jum'at 08.00-16.00
                            </li>
                            <li>
                                Hari Libur: Buka sesuai jadwal terkini
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-xs md:text-base font-semibold  uppercase text-white">Tentang Kami</h2>
                        <ul class=" text-white text-xs md:text-base font-normal">
                            <li class="mb-4">
                                Website ini dibuat untuk membantu masyarakat sekitar memberikan Kritik & Saran
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="my-2 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-2" />
        </div>
        <div class="container flex justify-center items-center space-x-2" >
            <!-- Social media icons container -->
          
                <a
                    href="https://facebook.com/bantarbolang17"
                    type="button"
                    class="rounded-full bg-transparent p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-neutral-100 focus:outline-none focus:ring-0 dark:text-white dark:hover:bg-secondary-900"
                    data-twe-ripple-init>
                    <span class="[&>svg]:h-5 [&>svg]:w-5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 320 512">
                            <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc. -->
                            <path
                                d="M80 299.3V512H196V299.3h86.5l18-97.8H196V166.9c0-51.7 20.3-71.5 72.7-71.5c16.3 0 29.4 .4 37 1.2V7.9C291.4 4 256.4 0 236.2 0C129.3 0 80 50.5 80 159.4v42.1H14v97.8H80z" />
                        </svg>
                    </span>
                </a>

                <a
                    href="https://bantarbolang.pemalangkab.go.id"
                    type="button"
                    class="rounded-full bg-transparent p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-neutral-100 focus:outline-none focus:ring-0 dark:text-white dark:hover:bg-secondary-900"
                    data-twe-ripple-init>
                    <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 488 512">
                            <path
                                d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                        </svg>
                    </span>
                </a>

                <a
                    href="https://www.instagram.com/kecbolang17/"
                    type="button"
                    class="rounded-full bg-transparent p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-neutral-100 focus:outline-none focus:ring-0 dark:text-white dark:hover:bg-secondary-900"
                    data-twe-ripple-init>
                    <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor"
                            viewBox="0 0 448 512">
                            <path
                                d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                        </svg>
                    </span>
                </a>

                <a
                    href="https://twitter.com/kecbolang17"
                    type="button"
                    class="rounded-full bg-transparent p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-neutral-100 focus:outline-none focus:ring-0 dark:text-white dark:hover:bg-secondary-900"
                    data-twe-ripple-init>
                    <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                        <svg  aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z" />
                        </svg>

                    </span>
                </a>

                <a
                    href="https:// youtube.com/@kecbantarbolang17"
                    type="button"
                    class="rounded-full bg-transparent p-3 font-medium uppercase leading-normal text-surface transition duration-150 ease-in-out hover:bg-neutral-100 focus:outline-none focus:ring-0 dark:text-white dark:hover:bg-secondary-900"
                    data-twe-ripple-init>
                    <span class="mx-auto [&>svg]:h-5 [&>svg]:w-5">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M21.7 8.037a4.26 4.26 0 0 0-.789-1.964 2.84 2.84 0 0 0-1.984-.839c-2.767-.2-6.926-.2-6.926-.2s-4.157 0-6.928.2a2.836 2.836 0 0 0-1.983.839 4.225 4.225 0 0 0-.79 1.965 30.146 30.146 0 0 0-.2 3.206v1.5a30.12 30.12 0 0 0 .2 3.206c.094.712.364 1.39.784 1.972.604.536 1.38.837 2.187.848 1.583.151 6.731.2 6.731.2s4.161 0 6.928-.2a2.844 2.844 0 0 0 1.985-.84 4.27 4.27 0 0 0 .787-1.965 30.12 30.12 0 0 0 .2-3.206v-1.516a30.672 30.672 0 0 0-.202-3.206Zm-11.692 6.554v-5.62l5.4 2.819-5.4 2.801Z" clip-rule="evenodd" />
                        </svg>

                    </span>
                </a>
            
        </div>

        <!--Copyright section-->
        <div class="w-full bg-[#0a382d] text-xs md:text-sm p-4 text-center">
            © 2024 Copyright:
            <a href="https://tw-elements.com/">Kecamatan Bantarbolang</a>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.kritik-saran-item');

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fall'); // Add animation class
                        observer.unobserve(entry.target); // Stop observing after animation starts
                    }
                });
            }, {
                threshold: 0.4
            }); // Trigger when 50% of the element is visible

            items.forEach(item => {
                observer.observe(item); // Observe each item
            });
        });
    </script>

</body>

</html>