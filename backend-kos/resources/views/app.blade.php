<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kos GenZ — Kelola Kos Lebih Mudah</title> @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-white text-slate-900 antialiased"> {{-- ========================================================= NAVBAR
    ========================================================== --}} <header class="fixed inset-x-0 top-0 z-50">
        <nav
            class="mx-auto mt-4 flex max-w-7xl items-center justify-between rounded-2xl border border-slate-200/70 bg-white/90 px-6 py-4 shadow-sm backdrop-blur-xl">
            {{-- Logo --}} <a href="/" class="flex items-center gap-3">
                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-600/20">
                    <i data-lucide="home" class="h-5 w-5"></i>
                </div>
                <div>
                    <div class="text-lg font-bold tracking-tight text-slate-900"> Kos<span
                            class="text-indigo-600">GenZ</span> </div>
                    <p class="-mt-1 text-[10px] font-medium uppercase tracking-wider text-slate-400"> Property
                        Management </p>
                </div>
            </a> {{-- Navigation --}} <div class="hidden items-center gap-8 md:flex"> <a href="#fitur"
                    class="text-sm font-medium text-slate-600 transition hover:text-indigo-600"> Fitur </a> <a
                    href="#cara-kerja" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600"> Cara
                    Kerja </a> <a href="#peran"
                    class="text-sm font-medium text-slate-600 transition hover:text-indigo-600"> Untuk Siapa </a> <a
                    href="#tentang" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600"> Tentang
                </a> </div> {{-- Actions --}} <div class="flex items-center gap-3"> <a href="/login"
                    class="hidden px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:text-indigo-600 sm:block">
                    Masuk </a> <a href="/register"
                    class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700 hover:shadow-indigo-600/30">
                    Mulai Sekarang </a> </div>
        </nav>
    </header> {{-- ========================================================= HERO
    ========================================================== --}} <main>
        <section class="relative overflow-hidden pt-40"> {{-- Background decoration --}} <div
                class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
                <div
                    class="absolute left-1/2 top-0 h-[500px] w-[900px] -translate-x-1/2 rounded-full bg-indigo-50 blur-3xl">
                </div>
                <div class="absolute -right-32 top-72 h-80 w-80 rounded-full bg-violet-50 blur-3xl"></div>
                <div class="absolute -left-32 top-96 h-80 w-80 rounded-full bg-blue-50 blur-3xl"></div>
            </div>
            <div class="mx-auto grid max-w-7xl items-center gap-16 px-6 pb-24 lg:grid-cols-2 lg:px-8"> {{-- Hero text
                --}} <div>
                    <div
                        class="mb-6 inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-4 py-2 text-sm font-medium text-indigo-700">
                        <span class="flex h-2 w-2 rounded-full bg-indigo-600"></span> Platform manajemen kos modern
                    </div>
                    <h1
                        class="max-w-3xl text-5xl font-bold leading-[1.08] tracking-tight text-slate-950 sm:text-6xl lg:text-7xl">
                        Kelola Kos <span class="text-indigo-600">Lebih Mudah.</span> Tinggal Lebih Nyaman. </h1>
                    <p class="mt-7 max-w-xl text-lg leading-8 text-slate-500"> Kos GenZ membantu owner mengelola
                        properti, kamar, penghuni, tagihan, pembayaran, dan maintenance dalam satu platform yang
                        sederhana. </p>
                    <div class="mt-9 flex flex-col gap-3 sm:flex-row"> <a href="/register"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5 text-sm font-semibold text-white shadow-xl shadow-indigo-600/20 transition hover:-translate-y-0.5 hover:bg-indigo-700">
                            Mulai Menggunakan Kos GenZ <i data-lucide="arrow-right"
                                class="h-4 w-4 transition group-hover:translate-x-1"></i> </a> <a href="#fitur"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3.5 text-sm font-semibold text-slate-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-600">
                            Jelajahi Fitur </a> </div> {{-- Trust --}} <div
                        class="mt-10 flex items-center gap-4 text-sm text-slate-400">
                        <div class="flex -space-x-2">
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-indigo-100 text-xs font-bold text-indigo-600">
                                O </div>
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-blue-100 text-xs font-bold text-blue-600">
                                T </div>
                            <div
                                class="flex h-8 w-8 items-center justify-center rounded-full border-2 border-white bg-violet-100 text-xs font-bold text-violet-600">
                                A </div>
                        </div> <span> Satu platform untuk seluruh kebutuhan kos </span>
                    </div>
                </div> {{-- Dashboard mockup --}} <div class="relative"> {{-- Glow --}} <div
                        class="absolute inset-10 rounded-3xl bg-indigo-500/20 blur-3xl"></div>
                    <div
                        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl shadow-slate-900/10">
                        {{-- Browser header --}} <div
                            class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                            <div class="flex gap-1.5"> <span class="h-3 w-3 rounded-full bg-slate-200"></span> <span
                                    class="h-3 w-3 rounded-full bg-slate-200"></span> <span
                                    class="h-3 w-3 rounded-full bg-slate-200"></span> </div>
                            <div class="rounded-lg bg-slate-50 px-4 py-1.5 text-xs text-slate-400"> dashboard.kosgenz.id
                            </div>
                            <div class="w-12"></div>
                        </div> {{-- Dashboard --}} <div class="flex"> {{-- Sidebar --}} <aside
                                class="hidden w-48 border-r border-slate-100 bg-slate-50/70 p-4 sm:block">
                                <div class="mb-7 flex items-center gap-2">
                                    <div
                                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-600 text-white">
                                        <i data-lucide="home" class="h-3.5 w-3.5"></i>
                                    </div> <span class="text-xs font-bold"> KosGenZ </span>
                                </div>
                                <div class="space-y-1">
                                    <div
                                        class="flex items-center gap-2 rounded-lg bg-indigo-50 px-3 py-2 text-xs font-semibold text-indigo-600">
                                        <i data-lucide="layout-dashboard" class="h-3.5 w-3.5"></i> Dashboard
                                    </div>
                                    <div class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400"> <i
                                            data-lucide="building-2" class="h-3.5 w-3.5"></i> Properti </div>
                                    <div class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400"> <i
                                            data-lucide="door-open" class="h-3.5 w-3.5"></i> Kamar </div>
                                    <div class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400"> <i
                                            data-lucide="users" class="h-3.5 w-3.5"></i> Penghuni </div>
                                    <div class="flex items-center gap-2 px-3 py-2 text-xs text-slate-400"> <i
                                            data-lucide="receipt" class="h-3.5 w-3.5"></i> Tagihan </div>
                                </div>
                            </aside> {{-- Main dashboard --}} <div class="flex-1 bg-white p-5 sm:p-7">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-[10px] font-medium text-slate-400"> Selamat datang kembali </p>
                                        <h3 class="mt-1 text-base font-bold text-slate-900"> Dashboard Owner </h3>
                                    </div>
                                    <div
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-50 text-indigo-600">
                                        <i data-lucide="bell" class="h-4 w-4"></i>
                                    </div>
                                </div> {{-- Stats --}} <div class="mt-6 grid grid-cols-2 gap-3">
                                    <div class="rounded-xl border border-slate-100 p-4">
                                        <div class="flex items-center justify-between"> <span
                                                class="text-[10px] text-slate-400"> Total Kamar </span> <i
                                                data-lucide="door-open" class="h-3.5 w-3.5 text-indigo-500"></i> </div>
                                        <p class="mt-2 text-xl font-bold"> 48 </p>
                                        <p class="mt-1 text-[9px] text-emerald-500"> 42 terisi </p>
                                    </div>
                                    <div class="rounded-xl border border-slate-100 p-4">
                                        <div class="flex items-center justify-between"> <span
                                                class="text-[10px] text-slate-400"> Pendapatan </span> <i
                                                data-lucide="wallet" class="h-3.5 w-3.5 text-indigo-500"></i> </div>
                                        <p class="mt-2 text-xl font-bold"> Rp24,8jt </p>
                                        <p class="mt-1 text-[9px] text-emerald-500"> +12.4% </p>
                                    </div>
                                </div> {{-- Chart --}} <div class="mt-4 rounded-xl border border-slate-100 p-4">
                                    <div class="flex items-center justify-between">
                                        <p class="text-[10px] font-semibold"> Pendapatan Bulanan </p> <span
                                            class="text-[9px] text-slate-400"> 6 bulan terakhir </span>
                                    </div>
                                    <div class="mt-5 flex h-24 items-end gap-2">
                                        <div class="h-[40%] flex-1 rounded-t bg-indigo-100"></div>
                                        <div class="h-[55%] flex-1 rounded-t bg-indigo-200"></div>
                                        <div class="h-[48%] flex-1 rounded-t bg-indigo-200"></div>
                                        <div class="h-[70%] flex-1 rounded-t bg-indigo-300"></div>
                                        <div class="h-[62%] flex-1 rounded-t bg-indigo-400"></div>
                                        <div class="h-[85%] flex-1 rounded-t bg-indigo-600"></div>
                                    </div>
                                </div> {{-- Maintenance --}} <div class="mt-4 rounded-xl border border-slate-100 p-4">
                                    <div class="flex items-center justify-between">
                                        <p class="text-[10px] font-semibold"> Maintenance Request </p> <span
                                            class="rounded-full bg-amber-50 px-2 py-1 text-[8px] font-semibold text-amber-600">
                                            3 Pending </span>
                                    </div>
                                    <div class="mt-3 space-y-2">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-red-50">
                                                <i data-lucide="wrench" class="h-3.5 w-3.5 text-red-500"></i>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-[9px] font-semibold"> AC tidak dingin </p>
                                                <p class="text-[8px] text-slate-400"> Kamar A-12 </p>
                                            </div> <span class="text-[8px] text-amber-500"> Pending </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> {{-- ========================================================= ROLE SECTION
        ========================================================== --}} <section id="peran"
            class="border-y border-slate-100 bg-slate-50/50 py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center"> <span class="text-sm font-semibold text-indigo-600"> DIBUAT
                        UNTUK SEMUA </span>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl"> Satu platform, <span
                            class="text-indigo-600">tiga peran.</span> </h2>
                    <p class="mt-4 leading-7 text-slate-500"> Kos GenZ menghubungkan setiap pihak yang terlibat dalam
                        pengelolaan dan kehidupan di kos. </p>
                </div>
                <div class="mt-14 grid gap-6 md:grid-cols-3"> {{-- Owner --}} <div
                        class="group rounded-2xl border border-slate-200 bg-white p-7 transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/5">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 transition group-hover:bg-indigo-600 group-hover:text-white">
                            <i data-lucide="building-2" class="h-6 w-6"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-bold"> Owner </h3>
                        <p class="mt-3 leading-7 text-slate-500"> Kelola properti, kamar, tenant, kontrak, tagihan,
                            pembayaran, dan maintenance dari satu dashboard. </p> <a href="/register"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-indigo-600"> Kelola
                            properti <i data-lucide="arrow-right" class="h-4 w-4"></i> </a>
                    </div> {{-- Tenant --}} <div
                        class="group rounded-2xl border border-slate-200 bg-white p-7 transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/5">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                            <i data-lucide="user-round" class="h-6 w-6"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-bold"> Tenant </h3>
                        <p class="mt-3 leading-7 text-slate-500"> Pantau kontrak, tagihan, pembayaran, dan laporkan
                            masalah kos dengan lebih mudah. </p> <a href="/register"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-blue-600"> Mulai
                            sebagai tenant <i data-lucide="arrow-right" class="h-4 w-4"></i> </a>
                    </div> {{-- Admin --}} <div
                        class="group rounded-2xl border border-slate-200 bg-white p-7 transition hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/5">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-violet-50 text-violet-600 transition group-hover:bg-violet-600 group-hover:text-white">
                            <i data-lucide="shield-check" class="h-6 w-6"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-bold"> Admin </h3>
                        <p class="mt-3 leading-7 text-slate-500"> Pantau operasional platform, organization, pengguna,
                            dan aktivitas sistem dari panel administrasi. </p> <a href="/login"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-violet-600"> Masuk
                            sebagai admin <i data-lucide="arrow-right" class="h-4 w-4"></i> </a>
                    </div>
                </div>
            </div>
        </section> {{-- ========================================================= FEATURES
        ========================================================== --}} <section id="fitur" class="py-24">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="max-w-2xl"> <span class="text-sm font-semibold text-indigo-600"> FITUR UTAMA </span>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl"> Semua kebutuhan kos <span
                            class="text-indigo-600">dalam satu tempat.</span> </h2>
                    <p class="mt-4 leading-7 text-slate-500"> Tidak perlu berpindah-pindah aplikasi. Kos GenZ menyatukan
                        berbagai kebutuhan pengelolaan kos dalam satu ekosistem. </p>
                </div>
                <div class="mt-14 grid gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-4">
                    @php $features = [['icon' => 'building-2', 'title' => 'Property Management', 'description' => 'Kelola berbagai properti dan informasi kos dalam satu dashboard.'], ['icon' => 'door-open', 'title' => 'Room Management', 'description' => 'Pantau status kamar, ketersediaan, dan penghuni dengan mudah.'], ['icon' => 'users', 'title' => 'Tenant Management', 'description' => 'Kelola data penghuni dan hubungan tenant dengan organization.'], ['icon' => 'file-text', 'title' => 'Contract Management', 'description' => 'Kelola kontrak dan periode tinggal tenant secara terorganisir.'], ['icon' => 'receipt', 'title' => 'Invoice', 'description' => 'Buat dan pantau tagihan tenant secara terstruktur.'], ['icon' => 'credit-card', 'title' => 'Payment', 'description' => 'Catat dan pantau pembayaran dengan lebih mudah.'], ['icon' => 'wrench', 'title' => 'Maintenance', 'description' => 'Tenant dapat melaporkan masalah dan owner dapat menanganinya.'], ['icon' => 'bell', 'title' => 'Notification', 'description' => 'Pastikan informasi penting sampai kepada pengguna.'],]; @endphp
                    @foreach ($features as $feature)
                        <div class="group">
                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-100 text-slate-700 transition group-hover:bg-indigo-600 group-hover:text-white">
                                <i data-lucide="{{ $feature['icon'] }}" class="h-5 w-5"></i>
                            </div>
                            <h3 class="mt-5 font-semibold"> {{ $feature['title'] }} </h3>
                            <p class="mt-2 text-sm leading-6 text-slate-500"> {{ $feature['description'] }} </p>
                    </div> @endforeach
                </div>
            </div>
        </section> {{-- ========================================================= HOW IT WORKS
        ========================================================== --}} <section id="cara-kerja"
            class="bg-slate-950 py-24 text-white">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center"> <span class="text-sm font-semibold text-indigo-400"> CARA
                        KERJA </span>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl"> Mulai dalam beberapa langkah
                        sederhana. </h2>
                    <p class="mt-4 leading-7 text-slate-400"> Kos GenZ dirancang agar proses pengelolaan kos tidak
                        terasa rumit. </p>
                </div>
                <div class="relative mt-16 grid gap-12 md:grid-cols-3"> {{-- connector --}} <div
                        class="absolute left-[20%] right-[20%] top-7 hidden border-t border-slate-700 md:block"></div>
                    <div class="relative text-center">
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-700 bg-slate-900 text-lg font-bold text-indigo-400">
                            01 </div>
                        <h3 class="mt-6 text-lg font-semibold"> Buat Akun </h3>
                        <p class="mx-auto mt-3 max-w-xs text-sm leading-6 text-slate-400"> Daftarkan akun dan mulai
                            menggunakan Kos GenZ. </p>
                    </div>
                    <div class="relative text-center">
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-700 bg-slate-900 text-lg font-bold text-indigo-400">
                            02 </div>
                        <h3 class="mt-6 text-lg font-semibold"> Kelola Kos </h3>
                        <p class="mx-auto mt-3 max-w-xs text-sm leading-6 text-slate-400"> Tambahkan properti, kamar,
                            tenant, dan kebutuhan lainnya. </p>
                    </div>
                    <div class="relative text-center">
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-700 bg-slate-900 text-lg font-bold text-indigo-400">
                            03 </div>
                        <h3 class="mt-6 text-lg font-semibold"> Pantau Semuanya </h3>
                        <p class="mx-auto mt-3 max-w-xs text-sm leading-6 text-slate-400"> Pantau operasional dan
                            aktivitas kos dari dashboard. </p>
                    </div>
                </div>
            </div>
        </section> {{-- ========================================================= CTA
        ========================================================== --}} <section id="tentang" class="py-24">
            <div class="mx-auto max-w-5xl px-6 lg:px-8">
                <div
                    class="relative overflow-hidden rounded-3xl bg-indigo-600 px-8 py-16 text-center shadow-2xl shadow-indigo-600/20 sm:px-16">
                    <div class="absolute -left-20 -top-20 h-60 w-60 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="absolute -bottom-20 -right-20 h-60 w-60 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="relative">
                        <div
                            class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-white">
                            <i data-lucide="home" class="h-7 w-7"></i>
                        </div>
                        <h2 class="mx-auto mt-7 max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Pengelolaan kos yang lebih sederhana dimulai dari sini. </h2>
                        <p class="mx-auto mt-5 max-w-xl leading-7 text-indigo-100"> Gabungkan pengelolaan properti,
                            tenant, pembayaran, dan maintenance dalam satu platform. </p>
                        <div class="mt-8"> <a href="/register"
                                class="inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3.5 text-sm font-semibold text-indigo-600 shadow-lg transition hover:-translate-y-0.5 hover:bg-indigo-50">
                                Mulai Menggunakan Kos GenZ <i data-lucide="arrow-right" class="h-4 w-4"></i> </a> </div>
                    </div>
                </div>
            </div>
        </section>
    </main> {{-- ========================================================= FOOTER
    ========================================================== --}} <footer class="border-t border-slate-100 bg-white">
        <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
            <div class="flex flex-col justify-between gap-8 md:flex-row">
                <div class="max-w-sm"> <a href="/" class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white"> <i
                                data-lucide="home" class="h-4 w-4"></i> </div> <span class="text-lg font-bold"> Kos<span
                                class="text-indigo-600">GenZ</span> </span>
                    </a>
                    <p class="mt-4 text-sm leading-6 text-slate-500"> Platform manajemen kos yang membantu owner dan
                        tenant mengelola kebutuhan tempat tinggal dengan lebih mudah. </p>
                </div>
                <div class="flex gap-16">
                    <div>
                        <h4 class="text-sm font-semibold"> Produk </h4>
                        <div class="mt-4 space-y-3"> <a href="#fitur"
                                class="block text-sm text-slate-500 hover:text-indigo-600"> Fitur </a> <a
                                href="#cara-kerja" class="block text-sm text-slate-500 hover:text-indigo-600"> Cara
                                Kerja </a> </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold"> Akun </h4>
                        <div class="mt-4 space-y-3"> <a href="/login"
                                class="block text-sm text-slate-500 hover:text-indigo-600"> Masuk </a> <a
                                href="/register" class="block text-sm text-slate-500 hover:text-indigo-600"> Daftar </a>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mt-10 flex flex-col justify-between gap-4 border-t border-slate-100 pt-8 text-sm text-slate-400 sm:flex-row">
                <p> © {{ date('Y') }} Kos GenZ. All rights reserved. </p>
                <p> Built for better property management. </p>
            </div>
        </div>
    </footer>
    <script> lucide.createIcons(); </script>
</body>

</html>