<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Centradist Partsindo Utama Palembang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1581090700227-1e37b1f61cfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');">
        <div class="bg-white bg-opacity-90 rounded-xl shadow-xl p-10 max-w-2xl text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat Datang di</h1>
            <h2 class="text-3xl font-semibold text-blue-700 mb-6">PT Centradist Partsindo Utama</h2>
            <p class="text-gray-700 mb-8">Sistem Manajemen Penjualan untuk meningkatkan efisiensi, akurasi, dan kecepatan operasional di Palembang.</p>

            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-200">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg transition duration-200">
                    Register
                </a>
            </div>
        </div>
    </div>

</body>
</html>
