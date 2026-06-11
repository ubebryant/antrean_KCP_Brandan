<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrean Online & Monitor Utama</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col justify-between">

    <header class="bg-blue-700 text-white p-4 shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-bold tracking-wide">SISTEM ANTREAN DIGITAL</h1>
        <div id="jam" class="text-xl font-mono bg-blue-800 px-4 py-1 rounded">00:00:00</div>
    </header>

    <main class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6 flex-grow">
        
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-2xl shadow-lg border-t-8 border-green-500 text-center">
                    <h2 class="text-xl font-bold text-gray-600 uppercase">Customer Service</h2>
                    <p id="display-cs" class="text-7xl font-extrabold text-green-600 my-4">CS-000</p>
                    <span class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded-full font-medium">Menuju Meja CS</span>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-lg border-t-8 border-blue-500 text-center">
                    <h2 class="text-xl font-bold text-gray-600 uppercase">Teller</h2>
                    <p id="display-teller" class="text-7xl font-extrabold text-blue-600 my-4">TL-000</p>
                    <span class="text-sm bg-gray-200 text-gray-700 px-3 py-1 rounded-full font-medium">Menuju Meja Teller</span>
                </div>
            </div>

            <div class="bg-white p-4 rounded-2xl shadow-lg flex-grow flex flex-col">
                <h3 class="text-md font-semibold text-gray-500 mb-2">Media Informasi</h3>
                <div class="relative w-full aspect-video bg-black rounded-xl overflow-hidden shadow-inner">
                    <iframe id="youtube-player" class="absolute top-0 left-0 w-full h-full" 
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1&playlist=dQw4w9WgXcQ&enablejsapi=1" 
                        title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col gap-5 border border-gray-200 overflow-y-auto max-h-[85vh]">
            <div>
                <h2 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">🎛️ Panel Kontrol Petugas</h2>
                
                <div class="mb-4 p-4 bg-green-50 rounded-xl border border-green-200">
                    <h3 class="font-bold text-green-800 mb-2">Bagian Customer Service</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="panggil('cs')" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-3 rounded-lg shadow transition cursor-pointer text-sm">
                            🔊 Panggil Berikutnya
                        </button>
                        <button onclick="ulang('cs')" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-3 rounded-lg shadow transition cursor-pointer text-sm">
                            🔄 Panggil Ulang
                        </button>
                    </div>
                </div>

                <div class="mb-4 p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <h3 class="font-bold text-blue-800 mb-2">Bagian Teller</h3>
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="panggil('teller')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded-lg shadow transition cursor-pointer text-sm">
                            🔊 Panggil Berikutnya
                        </button>
                        <button onclick="ulang('teller')" class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-3 rounded-lg shadow transition cursor-pointer text-sm">
                            🔄 Panggil Ulang
                        </button>
                    </div>
                </div>

                <div class="p-4 bg-red-50 rounded-xl border border-red-200">
                    <h3 class="font-bold text-red-800 mb-1.5 text-sm">Sistem Antrean</h3>
                    <button onclick="konfirmasiReset()" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-3 rounded-lg shadow transition text-sm cursor-pointer">
                        ⚠️ Reset Semua Antrean ke 0
                    </button>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <h3 class="font-bold text-gray-700 mb-2 flex items-center gap-1">📺 Atur Video YouTube</h3>
                <input id="input-url-youtube" type="text" 
                    class="w-full p-2 border rounded-lg text-sm focus:outline-blue-500 mb-2" 
                    placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ" />
                <button onclick="updateVideo()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 rounded-lg text-sm transition cursor-pointer">
                    Perbarui Video Monitor
                </button>
                <p class="text-xs text-gray-400 mt-1 italic">*Bisa pakai link browser biasa, link share (youtu.be), atau langsung ID videonya.</p>
            </div>

            <div class="mt-auto pt-4 border-t border-gray-100">
                <h3 class="font-bold text-gray-700 mb-2">⚙️ Atur Teks Pengumuman</h3>
                <textarea id="input-pengumuman" class="w-full p-2 border rounded-lg text-sm focus:outline-blue-500" rows="2" placeholder="Ketik pengumuman baru di sini..."></textarea>
                <button onclick="updatePengumuman()" class="mt-2 w-full bg-gray-800 hover:bg-gray-900 text-white font-medium py-2 rounded-lg text-sm transition cursor-pointer">
                    Simpan & Update Info
                </button>
            </div>
        </div>
    </main>

    <footer class="bg-gray-900 text-amber-400 p-3 shadow-inner flex items-center overflow-hidden">
        <div class="bg-red-600 text-white font-bold px-3 py-1 rounded text-sm shrink-0 mr-4 tracking-wider animate-pulse">
            INFO
        </div>
        <marquee id="marquee-text" class="text-lg font-medium tracking-wide">
            Selamat Datang di Layanan Kami. Harap antre dengan tertib dan siapkan dokumen identitas Anda (KTP/Buku Tabungan). Tetap jaga protokol kenyamanan bersama.
        </marquee>
    </footer>

    <script>
        // State data antrean
        let antreanCS = 0;
        let antreanTeller = 0;
        let hariSekarang = new Date().getDate();

        // Fungsi panggil nomor baru
        function panggil(tipe) {
            if (tipe === 'cs') {
                antreanCS++;
                updateDisplay('cs', antreanCS);
                suaraPanggilan('CS-' + String(antreanCS).padStart(3, '0'), 'Customer Service');
            } else if (tipe === 'teller') {
                antreanTeller++;
                updateDisplay('teller', antreanTeller);
                suaraPanggilan('TL-' + String(antreanTeller).padStart(3, '0'), 'Teller');
            }
        }

        // Fungsi panggil ulang
        function ulang(tipe) {
            if (tipe === 'cs' && antreanCS > 0) {
                suaraPanggilan('CS-' + String(antreanCS).padStart(3, '0'), 'Customer Service');
            } else if (tipe === 'teller' && antreanTeller > 0) {
                suaraPanggilan('TL-' + String(antreanTeller).padStart(3, '0'), 'Teller');
            }
        }

        function updateDisplay(tipe, nomor) {
            const kode = tipe === 'cs' ? 'CS-' : 'TL-';
            const elementId = tipe === 'cs' ? 'display-cs' : 'display-teller';
            document.getElementById(elementId).innerText = kode + String(nomor).padStart(3, '0');
        }

        function konfirmasiReset() {
            const yakin = confirm("Apakah Anda yakin ingin mereset semua nomor antrean kembali ke nol (0)?");
            if (yakin) { eksekusiReset(); }
        }

        function eksekusiReset() {
            antreanCS = 0;
            antreanTeller = 0;
            updateDisplay('cs', 0);
            updateDisplay('teller', 0);
            
            try {
                const utterance = new SpeechSynthesisUtterance("Sistem antrean telah dikosongkan.");
                utterance.lang = 'id-ID';
                window.speechSynthesis.speak(utterance);
            } catch(e) { console.log("Voice error"); }
        }

        // EKSTRAKSI ID & UPDATE VIDEO YOUTUBE
        function updateVideo() {
            const inputUrl = document.getElementById('input-url-youtube').value.trim();
            if (!inputUrl) {
                alert("Silakan masukkan URL atau ID Video YouTube terlebih dahulu!");
                return;
            }

            let videoId = "";

            try {
                if (inputUrl.includes("youtube.com/watch")) {
                    const urlParams = new URLSearchParams(new URL(inputUrl).search);
                    videoId = urlParams.get('v');
                } else if (inputUrl.includes("youtu.be/")) {
                    videoId = inputUrl.split("youtu.be/")[1].split(/[?#]/)[0];
                } else if (inputUrl.includes("youtube.com/embed/")) {
                    videoId = inputUrl.split("embed/")[1].split(/[?#]/)[0];
                } else {
                    videoId = inputUrl;
                }
            } catch (e) {
                videoId = inputUrl;
            }

            if (videoId && videoId.length === 11) {
                const player = document.getElementById('youtube-player');
                player.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&loop=1&playlist=${videoId}&enablejsapi=1`;
                document.getElementById('input-url-youtube').value = ""; 
            } else {
                alert("Format URL tidak valid. Pastikan link YouTube atau 11 karakter ID video benar!");
            }
        }

        // Fitur Suara Otomatis
        function suaraPanggilan(nomor, tujuan) {
            try {
                let ejaanNomor = nomor.replace('-', ' ').replace(/\b0+/g, ''); 
                if(ejaanNomor.endsWith(' ')) ejaanNomor += '0'; 
                
                const teks = `Nomor antrean, ${ejaanNomor}, silahkan menuju ke, ${tujuan}`;
                const utterance = new SpeechSynthesisUtterance(teks);
                utterance.lang = 'id-ID';
                utterance.rate = 0.9;     
                window.speechSynthesis.speak(utterance);
            } catch(e) {
                console.log("Suara gagal diputar. Interaksi pengguna diperlukan terlebih dahulu.");
            }
        }

        // Fungsi memperbarui teks pengumuman
        function updatePengumuman() {
            const inputText = document.getElementById('input-pengumuman').value;
            if (inputText.trim() !== "") {
                document.getElementById('marquee-text').innerText = inputText;
            }
        }

        // Jam Digital & Auto-Reset Tengah Malam (SUDAH DIPERBAIKI)
        setInterval(() => {
            const sekarang = new Date();
            const jam = String(sekarang.getHours()).padStart(2, '0');
            const menit = String(sekarang.getMinutes()).padStart(2, '0');
            const detik = String(sekarang.getSeconds()).padStart(2, '0');
            document.getElementById('jam').innerText = `${jam}:${menit}:${detik}`;

            // Perbaikan Bug: Mengubah Bird menjadi sekarang
            if (sekarang.getDate() !== hariSekarang) {
                hariSekarang = sekarang.getDate();
                eksekusiReset();
            }
        }, 1000);
    </script>
</body>
</html>
