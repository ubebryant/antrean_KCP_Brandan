<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Petugas - Bank SUMUT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap');
        .font-digital { font-family: 'Orbitron', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

    <header class="bg-white p-4 shadow flex justify-between items-center border-b-2 border-orange-500">
        <div class="flex items-center gap-3">
            <img src="Logo_Bank_Sumut.png" alt="Logo Bank SUMUT" class="h-10">
            <h1 class="text-blue-900 font-black tracking-wide hidden sm:block">PANEL KONTROL ANTREAN</h1>
        </div>
        <span class="text-xs bg-orange-500 text-white px-3 py-1 rounded-full font-bold uppercase tracking-wider">Mode Admin</span>
    </header>

    <section class="max-w-6xl mx-auto w-full px-6 pt-6">
        <div class="bg-slate-800 text-white p-4 rounded-2xl shadow-md grid grid-cols-2 gap-4 border-b-4 border-blue-900">
            <div class="text-center border-r border-slate-700 py-1">
                <p class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Live Monitor CS</p>
                <p id="live-cs" class="text-3xl font-digital text-white mt-1">CS-000</p>
            </div>
            <div class="text-center py-1">
                <p class="text-xs font-bold text-orange-400 uppercase tracking-widest">Live Monitor Teller</p>
                <p id="live-teller" class="text-3xl font-digital text-white mt-1">TL-000</p>
            </div>
        </div>
    </section>

    <main class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto w-full flex-grow">
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-lg border-t-8 border-emerald-500">
                <h3 class="text-emerald-700 font-black mb-4 tracking-wide">CUSTOMER SERVICE (CS)</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button onclick="panggil('cs')" class="bg-emerald-600 text-white font-bold py-5 rounded-2xl hover:bg-emerald-700 transition shadow-lg active:scale-95 cursor-pointer">PANGGIL BERIKUTNYA</button>
                    <button onclick="ulang('cs')" class="bg-orange-500 text-white font-bold py-5 rounded-2xl hover:bg-orange-600 transition shadow-lg active:scale-95 cursor-pointer">PANGGIL ULANG</button>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-lg border-t-8 border-blue-900">
                <h3 class="text-blue-900 font-black mb-4 tracking-wide">TELLER LAYANAN</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <button onclick="panggil('teller')" class="bg-blue-900 text-white font-bold py-5 rounded-2xl hover:bg-blue-950 transition shadow-lg active:scale-95 cursor-pointer">PANGGIL BERIKUTNYA</button>
                    <button onclick="ulang('teller')" class="bg-orange-500 text-white font-bold py-5 rounded-2xl hover:bg-orange-600 transition shadow-lg active:scale-95 cursor-pointer">PANGGIL ULANG</button>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-3xl shadow-lg">
                <h3 class="font-black text-gray-700 mb-4">⚙️ PENGATURAN MONITOR UTAMA</h3>
                
                <label class="block text-sm font-bold text-gray-500 mb-1">ID Video YouTube / Link</label>
                <input id="input-url-youtube" type="text" class="w-full p-4 bg-gray-50 border rounded-xl mb-4 focus:ring-2 focus:ring-blue-500 text-sm" placeholder="Masukkan ID atau Link YouTube...">
                <button onclick="updateVideo()" class="w-full bg-gray-800 text-white font-bold py-3 rounded-xl mb-6 cursor-pointer text-sm">UPDATE VIDEO INFO</button>

                <label class="block text-sm font-bold text-gray-500 mb-1">Teks Pengumuman Berjalan</label>
                <textarea id="input-pengumuman" class="w-full p-4 bg-gray-50 border rounded-xl mb-4 text-sm" rows="3" placeholder="Ketik kalimat pengumuman baru di sini..."></textarea>
                <button onclick="updatePengumuman()" class="w-full bg-gray-800 text-white font-bold py-3 rounded-xl cursor-pointer text-sm">UPDATE TEKS BERJALAN</button>
            </div>

            <button onclick="konfirmasiReset()" class="w-full bg-red-100 text-red-600 font-bold py-4 rounded-2xl border-2 border-red-300 hover:bg-red-600 hover:text-white transition cursor-pointer text-sm">⚠️ RESET NOMOR ANTRIAN KE 0</button>
        </div>
    </main>

    <script>
        let hariSekarang = new Date().getDate();

        // Fungsi memperbarui angka live display di panel petugas
        function perbaruiLiveStatus() {
            const cs = localStorage.getItem('antreanCS') || 0;
            const teller = localStorage.getItem('antreanTeller') || 0;
            
            document.getElementById('live-cs').innerText = 'CS-' + String(cs).padStart(3, '0');
            document.getElementById('live-teller').innerText = 'TL-' + String(teller).padStart(3, '0');
        }

        function panggil(tipe) {
            let key = tipe === 'cs' ? 'antreanCS' : 'antreanTeller';
            let nomor = (parseInt(localStorage.getItem(key)) || 0) + 1;
            localStorage.setItem(key, nomor);
            
            perbaruiLiveStatus(); // Langsung sinkronkan tampilan lokal admin

            let kode = tipe === 'cs' ? 'C S ' : 'Teller ';
            let tujuan = tipe === 'cs' ? 'Customer Service' : 'Teller';
            suaraPanggilan(kode + nomor, tujuan);
        }

        function ulang(tipe) {
            let key = tipe === 'cs' ? 'antreanCS' : 'antreanTeller';
            let nomor = localStorage.getItem(key) || 0;
            
            if(nomor > 0) {
                let kode = tipe === 'cs' ? 'C S ' : 'Teller ';
                let tujuan = tipe === 'cs' ? 'Customer Service' : 'Teller';
                suaraPanggilan(kode + nomor, tujuan);
            }
        }

        function updateVideo() {
            let val = document.getElementById('input-url-youtube').value.trim();
            if(!val) return alert("Isi link terlebih dahulu!");

            let videoId = val;
            try {
                if (val.includes("v=")) {
                    videoId = new URL(val).searchParams.get("v");
                } else if (val.includes("youtu.be/")) {
                    videoId = val.split("youtu.be/")[1].split(/[?#]/)[0];
                } else if (val.includes("embed/")) {
                    videoId = val.split("embed/")[1].split(/[?#]/)[0];
                }
            } catch(e) {}

            if(videoId && videoId.length === 11) {
                localStorage.setItem('youtubeVideoId', videoId);
                document.getElementById('input-url-youtube').value = "";
                alert('Video monitor utama berhasil diperbarui!');
            } else {
                alert("Format link/ID video tidak valid.");
            }
        }

        function updatePengumuman() {
            let val = document.getElementById('input-pengumuman').value.trim();
            if(val) { 
                localStorage.setItem('teksPengumuman', val); 
                document.getElementById('input-pengumuman').value = "";
                alert('Teks pengumuman monitor berhasil diperbarui!'); 
            }
        }

        function konfirmasiReset() {
            if(confirm("Apakah Anda yakin ingin mereset seluruh nomor antrean hari ini ke nol (0)?")) {
                localStorage.setItem('antreanCS', 0);
                localStorage.setItem('antreanTeller', 0);
                perbaruiLiveStatus();
                alert('Sistem antrean berhasil dikosongkan!');
            }
        }

        function suaraPanggilan(nomor, tujuan) {
            try {
                const teks = `Nomor antrean, ${nomor}, silahkan menuju ke, ${tujuan}`;
                const utterance = new SpeechSynthesisUtterance(teks);
                utterance.lang = 'id-ID';
                utterance.rate = 0.85;
                window.speechSynthesis.speak(utterance);
            } catch(e){}
        }

        // Pantau perubahan dari tab lain (jika di-reset dari tempat lain)
        window.addEventListener('storage', perbaruiLiveStatus);
        
        // Muat data status saat pertama kali halaman admin dibuka
        window.onload = perbaruiLiveStatus;

        // Otomatis reset data lokal jika berganti hari
        setInterval(() => {
            const sekarang = new Date();
            if (sekarang.getDate() !== hariSekarang) {
                hariSekarang = sekarang.getDate();
                localStorage.setItem('antreanCS', 0);
                localStorage.setItem('antreanTeller', 0);
                perbaruiLiveStatus();
            }
        }, 1000);
    </script>
</body>
</html>
