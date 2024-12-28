<!-- component -->
<div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
    <div class="fixed flex flex-col top-0 left-0 w-64 bg-white dark:bg-gray-800 h-full border-r dark:border-gray-600">
        <div class="flex items-center justify-center h-14 border-b">
            <div>Dashboard Admin</div>
        </div>
        <div class="overflow-y-auto overflow-x-hidden flex-grow">
            <ul class="flex flex-col py-4 space-y-1">
                <li class="px-5 pt-6">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light dark:text-white tracking-wide text-gray-500">Menu</div>
                    </div>
                </li>


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
    </div>
</div>