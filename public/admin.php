<!DOCTYPE html>
<html x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Favicon -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="../src/output.css">
</head>

<body>
    <div id="security-key-form" class="flex flex-col items-center p-4 bg-gray-100 rounded shadow-md">
        <input type="text" id="security-key-input" class="mb-3 p-2 border border-gray-300 rounded w-full"
            placeholder="Enter security key">
        <button id="submit-security-key"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
    </div>
    <div id="admin-dashboard" class="flex h-screen bg-black hidden" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 flex-shrink-0 hidden w-60 pl-2 overflow-y-auto bg-black md:block">
            <div>
                <div class="text-white">
                    <div class="flex p-2  bg-black">
                        <div class="flex py-3 px-2 items-center">
                            <p class="text-2xl text-red-500 font-semibold">WorkFlow</p>
                            <p class="ml-2 font-semibold italic">
                                admin</p>
                        </div>
                    </div>
                    <div>
                        <ul class="mt-6 leading-10">
                            <li class="relative px-2 py-1 ">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-red-500"
                                    href=" #">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="ml-4">DASHBOARD</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>

        <aside
            class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto  bg-gray-900 dark:bg-black md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div>
                <div class="text-white">
                    <div class="flex p-2  bg-black">
                        <div class="flex py-3 px-2 items-center">
                            <p class="text-2xl text-red-500 font-semibold">SA</p>
                            <p class="ml-2 font-semibold italic">
                                DASHBOARD</p>
                        </div>
                    </div>
                    <div>
                        <ul class="mt-6 leading-10">
                            <li class="relative px-2 py-1 ">
                                <a class="inline-flex items-center w-full text-sm font-semibold text-white transition-colors duration-150 cursor-pointer hover:text-red-500"
                                    href=" #">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span class="ml-4">DASHBOARD</span>
                                </a>
                            </li>
                            <li class="relative px-2 py-1" x-data="{ Open : false  }">
                                <div class="inline-flex items-center justify-between w-full text-base font-semibold transition-colors duration-150 text-gray-500  hover:text-yellow-400 cursor-pointer"
                                    x-on:click="Open = !Open">
                                    <span
                                        class="inline-flex items-center  text-sm font-semibold text-white hover:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                        </svg>
                                        <span class="ml-4">ITEM</span>
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" x-show="!Open"
                                        class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" x-show="Open"
                                        class="ml-1  text-white w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>

                                <div x-show.transition="Open" style="display:none;">
                                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                                        x-transition:enter-start="opacity-25 max-h-0"
                                        x-transition:enter-end="opacity-100 max-h-xl"
                                        x-transition:leave="transition-all ease-in-out duration-300"
                                        x-transition:leave-start="opacity-100 max-h-xl"
                                        x-transition:leave-end="opacity-0 max-h-0"
                                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium  rounded-md shadow-inner  bg-red-400"
                                        aria-label="submenu">

                                        <li class="px-2 py-1 text-white transition-colors duration-150">
                                            <div class="px-1 hover:text-gray-800 hover:bg-gray-100 rounded-md">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                    </svg>
                                                    <a href="#"
                                                        class="w-full ml-2  text-sm font-semibold text-white hover:text-gray-800">Item
                                                        1</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        <div class="flex flex-col flex-1 w-full overflow-y-auto">
            <header class="z-40 py-4  bg-black  ">
                <div class="flex items-center justify-between h-8 px-6 mx-auto">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu" aria-label="Menu">
                        <x-heroicon-o-menu class="w-6 h-6 text-white" />
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>

                    <!-- Search Input -->
                    <div class="flex justify-center  mt-2 mr-4">
                        <div class="relative flex w-full flex-wrap items-stretch mb-3">
                            <input type="search" placeholder="Search" {{ $attributes }}
                                class="form-input px-3 py-2 placeholder-gray-400 text-gray-700 relative bg-white rounded-lg text-sm shadow outline-none focus:outline-none focus:shadow-outline w-full pr-10" />
                            <span
                                class="z-10 h-full leading-snug font-normal  text-center text-gray-400 absolute bg-transparent rounded text-base items-center justify-center w-8 right-0 pr-3 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -mt-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <ul class="flex items-center flex-shrink-0 space-x-6">

                        <!-- Notifications menu -->
                        <li class="relative">
                            <button
                                class="p-2 bg-white text-red-400 align-middle rounded-full hover:text-white hover:bg-red-400 focus:outline-none "
                                @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                                aria-label="Notifications" aria-haspopup="true">
                                <div class="flex items-cemter">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <!-- Notification badge -->
                                <span aria-hidden="true"
                                    class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"></span>
                            </button>
                        </li>

                        <!-- Profile menu -->
                        <li class="relative">
                            <button
                                class="p-2 bg-white text-red-400 align-middle rounded-full hover:text-white hover:bg-red-400 focus:outline-none "
                                @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                                aria-haspopup="true">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </button>
                            <template x-if="isProfileMenuOpen">
                                <ul x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                                    class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-red-400 border border-red-500 rounded-md shadow-md"
                                    aria-label="submenu">
                                    <li class="flex">
                                        <a class="text-white inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800"
                                            href="./logout.php">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Log out</span>
                                        </a>
                                    </li>
                                </ul>
                            </template>
                        </li>
                    </ul>

                </div>
            </header>
            <main class="">
                <div class="grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-50 border-4 border-red-500">

                    <div class="grid grid-cols-12 gap-6">
                        <div class="grid grid-cols-12 col-span-12 gap-6 xxl:col-span-9">
                            <div class="col-span-12 mt-8">
                                <div class="flex items-center h-10 intro-y">
                                    <h2 class="mr-5 text-lg font-medium truncate">Dashboard</h2>
                                </div>
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                        href="#">
                                        <div class="p-5">
                                            <div class="flex justify-between">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </div>
                                            <div class="ml-2 w-full flex-1">
                                                <div>
                                                    <div class="mt-3 text-3xl font-bold leading-8"><?php
                                                    include '../src/database/db.php';
                                                    $sql = "SELECT 
                                                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pendingCount,
                                                    SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as activeCount,
                                                    SUM(CASE WHEN status = 'refused' THEN 1 ELSE 0 END) as refusedCount,
                                                    SUM(CASE WHEN status = 'banned' THEN 1 ELSE 0 END) as bannedCount
                                                    FROM users";
                                                    $result = mysqli_query($conn, $sql);
                                                    $obj = mysqli_fetch_object($result);
                                                    $pendingCount = $obj->pendingCount;
                                                    $activeCount = $obj->activeCount;
                                                    $refusedCount = $obj->refusedCount;
                                                    $bannedCount = $obj->bannedCount;
                                                    echo $pendingCount + $activeCount + $refusedCount + $bannedCount;
                                                    ?></div>

                                                    <div class="mt-1 text-base text-gray-600">login requests</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                        href="#">
                                        <div class="p-5">
                                            <div class="flex justify-between">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                            </div>
                                            <div class="ml-2 w-full flex-1">
                                                <div>
                                                    <div class="mt-3 text-3xl font-bold leading-8"><?php
                                                    include '../src/database/db.php';
                                                    $sql = "SELECT 
                                                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pendingCount,
                                                    SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as activeCount,
                                                    SUM(CASE WHEN status = 'refused' THEN 1 ELSE 0 END) as refusedCount,
                                                    SUM(CASE WHEN status = 'banned' THEN 1 ELSE 0 END) as bannedCount
                                                    FROM users";
                                                    $result = mysqli_query($conn, $sql);
                                                    $obj = mysqli_fetch_object($result);
                                                    $pendingCount = $obj->pendingCount;
                                                    $activeCount = $obj->activeCount;
                                                    $refusedCount = $obj->refusedCount;
                                                    $bannedCount = $obj->bannedCount;
                                                    echo $activeCount + $bannedCount;
                                                    ?></div>

                                                    <div class="mt-1 text-base text-gray-600">Accepted requests</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                        href="#">
                                        <div class="p-5">
                                            <div class="flex justify-between">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                                </svg>
                                            </div>
                                            <div class="ml-2 w-full flex-1">
                                                <div>
                                                    <div class="mt-3 text-3xl font-bold leading-8"><?php
                                                    include '../src/database/db.php';
                                                    $sql = "SELECT 
                                                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pendingCount,
                                                    SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as activeCount,
                                                    SUM(CASE WHEN status = 'refused' THEN 1 ELSE 0 END) as refusedCount,
                                                    SUM(CASE WHEN status = 'banned' THEN 1 ELSE 0 END) as bannedCount
                                                    FROM users";
                                                    $result = mysqli_query($conn, $sql);
                                                    $obj = mysqli_fetch_object($result);
                                                    $pendingCount = $obj->pendingCount;
                                                    $activeCount = $obj->activeCount;
                                                    $refusedCount = $obj->refusedCount;
                                                    $bannedCount = $obj->bannedCount;
                                                    echo $pendingCount;
                                                    ?></div>

                                                    <div class="mt-1 text-base text-gray-600">in review</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                        href="#">
                                        <div class="p-5">
                                            <div class="flex justify-between">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                                </svg>
                                            </div>
                                            <div class="ml-2 w-full flex-1">
                                                <div>
                                                    <div class="mt-3 text-3xl font-bold leading-8">10£</div>

                                                    <div class="mt-1 text-base text-gray-600">income</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-span-12 mt-5">
                                <div class="grid gap-2 grid-cols-1 lg:grid-cols-2">
                                    <div class="bg-white shadow-lg p-4 w-[200%]" id="chartline"></div>
                                </div>
                            </div>
                            <div class="col-span-12 mt-5">
                                <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
                                    <div class="bg-white p-4 shadow-lg rounded-lg">
                                        <h1 class="font-bold text-base">Table</h1>
                                        <div class="mt-4">
                                            <div class="flex flex-col">
                                                <div class="-my-2 overflow-x-auto">
                                                    <div class="py-2 align-middle inline-block min-w-full">
                                                        <div
                                                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                                            <table class="min-w-full divide-y divide-gray-200">
                                                                <thead>
                                                                    <tr>
                                                                        <th
                                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                            <div class="flex cursor-pointer">
                                                                                <span class="mr-2">Email</span>
                                                                            </div>
                                                                        </th>
                                                                        <th
                                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                            <div class="flex cursor-pointer">
                                                                                <span class="mr-2">Date Of
                                                                                    Request</span>
                                                                            </div>
                                                                        </th>
                                                                        <th
                                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                            <div class="flex cursor-pointer">
                                                                                <span class="mr-2">STATUS</span>
                                                                            </div>
                                                                        </th>
                                                                        <th
                                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                            <div class="flex cursor-pointer">
                                                                                <span class="mr-2">Role</span>
                                                                            </div>
                                                                        </th>
                                                                        <th
                                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                                            <div class="flex cursor-pointer">
                                                                                <span class="mr-2">ACTION</span>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php
                                                                    include '../src/database/db.php';

                                                                    $sql = "SELECT * FROM users";
                                                                    $result = mysqli_query($conn, $sql);
                                                                    $loginrequestsnum = mysqli_num_rows($result);

                                                                    if (mysqli_num_rows($result) > 0) {
                                                                        // Output data of each row
                                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                                            echo "<tr>";
                                                                            echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>" . $row["email"] . "</td>";
                                                                            echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>" . $row["created_at"] . "</td>";
                                                                            echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>" . $row["status"] . "</td>";
                                                                            echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'>" . $row["role"] . "</td>";

                                                                            if ($row["status"] == "pending") {
                                                                                echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'><div class='flex space-x-4'><form action='' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='hidden' name='action' value='accept'><button class='py-2 px-4 border border-green-500 rounded-md text-green-500 hover:text-white hover:bg-green-500 focus:outline-none'>Accept</button></form><form action='' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='hidden' name='action' value='refuse'><button class='py-2 px-4 text-red-500 hover:bg-red-600 border hover:text-white border-red-500 rounded'>Refuse</button></form></div></td>";
                                                                            } elseif ($row["status"] == "active") {
                                                                                echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'><div class='flex space-x-4'><form action='' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='hidden' name='action' value='ban'><button class='py-2 px-4 text-red-500 hover:bg-red-600 border hover:text-white border-red-500 rounded'>Ban</button></form></div></td>";
                                                                            } elseif ($row["status"] == "banned") {
                                                                                echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'><div class='flex space-x-4'><form action='' method='post'><input type='hidden' name='id' value='" . $row['id'] . "'><input type='hidden' name='action' value='unban'><button class='py-2 px-4 border border-green-500 rounded-md text-green-500 hover:text-white hover:bg-green-500 focus:outline-none'>Unban</button></form></div></td>";
                                                                            } elseif ($row["status"] == "refused") {
                                                                                echo "<td class='px-6 py-4 whitespace-no-wrap text-sm leading-5'></td>";
                                                                            }
                                                                            echo "</tr>";
                                                                        }
                                                                    } else {
                                                                        echo "0 results";
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $id = $_POST['id'];
                                $action = $_POST['action'];

                                if ($action === 'accept') {
                                    $sql = "UPDATE users SET status = 'active' WHERE id = $id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo "<script>window.location.href='admin.php';</script>";
                                        exit();
                                    } else {
                                        echo 'Error accepting user';
                                    }
                                } elseif ($action === 'refuse') {
                                    $sql = "UPDATE users SET status = 'refused' WHERE id = $id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo "<script>window.location.href='admin.php';</script>";
                                        exit();
                                    } else {
                                        echo 'Error refusing user';
                                    }
                                } elseif ($action === 'ban') {
                                    $sql = "UPDATE users SET status = 'banned' WHERE id = $id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo "<script>window.location.href='admin.php';</script>";
                                        exit();
                                    } else {
                                        echo 'Error banning user';
                                    }
                                } elseif ($action === 'unban') {
                                    $sql = "UPDATE users SET status = 'active' WHERE id = $id";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result) {
                                        echo "<script>window.location.href='admin.php';</script>";
                                        exit();
                                    } else {
                                        echo 'Error unbanning user';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        const securityKeyInput = document.getElementById("security-key-input");
        const submitSecurityKeyButton = document.getElementById("submit-security-key");
        const adminDashboard = document.getElementById("admin-dashboard");
        const securityKeyForm = document.getElementById("security-key-form");

        submitSecurityKeyButton.addEventListener("click", (event) => {
            event.preventDefault();
            const userInput = securityKeyInput.value;

            fetch("validate_key.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: new URLSearchParams({ securityKey: userInput })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        adminDashboard.classList.remove('hidden');
                        securityKeyForm.classList.add('hidden');
                    } else {
                        alert(data.message || "Invalid security key.");
                    }
                })
                .catch(error => {
                    console.error("Error validating the key:", error);
                });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function data() {

            return {

                isSideMenuOpen: false,
                toggleSideMenu() {
                    this.isSideMenuOpen = !this.isSideMenuOpen
                },
                closeSideMenu() {
                    this.isSideMenuOpen = false
                },
                isNotificationsMenuOpen: false,
                toggleNotificationsMenu() {
                    this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
                },
                closeNotificationsMenu() {
                    this.isNotificationsMenuOpen = false
                },
                isProfileMenuOpen: false,
                toggleProfileMenu() {
                    this.isProfileMenuOpen = !this.isProfileMenuOpen
                },
                closeProfileMenu() {
                    this.isProfileMenuOpen = false
                },
                isPagesMenuOpen: false,
                togglePagesMenu() {
                    this.isPagesMenuOpen = !this.isPagesMenuOpen
                },

            }
        }
    </script>
    <script>
        var chart = document.querySelector('#chartline')
        var options = {
            series: [{
                name: 'Freelancers',
                type: 'area',
                data: [26, 20]
            }],
            chart: {
                height: 350,
                width: '100%',
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: [0.35, 1],
            },
            labels: ['Dec 01', 'Dec 02', 'Dec 03', 'Dec 04', 'Dec 05', 'Dec 06', 'Dec 07', 'Dec 08', 'Dec 09 ',
                'Dec 10', 'Dec 11'
            ],
            markers: {
                size: 0
            },
            yaxis: [{
                title: {
                    text: 'income',
                },
            },
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;
                    }
                }
            }
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
</body>

</html>