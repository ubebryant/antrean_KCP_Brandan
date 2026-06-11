<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Monitor Antrean - PT. Bank SUMUT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap');
        .font-digital { font-family: 'Orbitron', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 font-sans h-screen w-screen flex flex-col overflow-hidden select-none box-border p-0 m-0">

    <header class="h-[10vh] min-h-[60px] bg-white px-6 shadow-md flex justify-between items-center border-b-2 border-slate-200 z-10 flex-shrink-0 box-border">
        <div class="flex items-center gap-4 h-full py-2">
            <img src="Logo_Bank_Sumut.png" 
                 alt="Logo Bank SUMUT" 
                 class="h-full max-h-[50px] md:max-h-[60px] w-auto object-contain">
            <div class="h-8 w-[2px] bg-slate-300"></div>
            <div>
                <h1 class="text-lg md:text-xl font-black tracking-tighter text-[#00205B] leading-none">KANTOR CABANG</h1>
                <p class="text-[10px] font-bold text-slate-500 tracking-widest uppercase mt-0.5">Layanan Antrean Digital</p>
            </div>
        </div>
        <div id="jam" class="text-xl md:text-2xl font-digital bg-[#00205B] text-white px-5 py-1.5 rounded-xl border border-blue-800 shadow-inner">
            00:00:00
        </div>
    </header>

    <div class="h-[7vh] min-h-[40px] bg-[#00205B] text-white px-6 flex items-center shadow-md border-b-4 border-[#F37021] z-10 flex-shrink-0 box-border">
        <div class="bg-[#F37021] text-white font-black px-3 py-1 rounded-md text-[11px] md:text-xs shrink-0 mr-4 shadow-md tracking-wide">
            INFO TERKINI
        </div>
        <div class="flex-grow overflow-hidden flex items-center">
            <marquee id="marquee-text" class="text-sm md:text-lg font-bold tracking-wide italic text-orange-300">
                Selamat Datang di PT. Bank SUMUT. Kepercayaan Anda adalah Prioritas Kami. Harap siapkan dokumen identitas Anda untuk mempercepat proses layanan. Terima kasih.
            </marquee>
        </div>
    </div>

    <main class="h-[83vh] p-4 grid grid-cols-1 lg:grid-cols-12 gap-4 flex-shrink-0 box-border overflow-hidden">
        
        <div class="lg:col-span-4 flex flex-col gap-4 h-full overflow-hidden box-border">
            
            <div class="flex-1 bg-white rounded-[1.5rem] shadow-xl border-l-[10px] border-emerald-500 p-4 flex flex-col justify-between items-center overflow-hidden box-border">
                <h2 class="text-sm md:text-base font-black text-slate-400 uppercase tracking-widest text-center">CUSTOMER SERVICE</h2>
                <div class="bg-slate-50 w-full flex-grow flex justify-center items-center shadow-inner my-2 rounded-2xl min-h-[50px] overflow-hidden">
                    <p id="display-cs" class="text-5xl md:text-6xl xl:text-7xl font-digital text-emerald-600 drop-shadow-sm tracking-tight leading-none">CS-000</p>
                </div>
                <div class="bg-emerald-100 text-emerald-700 text-[11px] md:text-xs font-black px-5 py-1.5 rounded-full border border-emerald-400 animate-pulse text-center w-auto">
                    MENUJU MEJA CS
                </div>
            </div>

            <div class="flex-1 bg-white rounded-[1.5rem] shadow-xl border-l-[10px] border-[#00205B] p-4 flex flex-col justify-between items-center overflow-hidden box-border">
                <h2 class="text-sm md:text-base font-black text-slate-400 uppercase tracking-widest text-center">TELLER</h2>
                <div class="bg-slate-50 w-full flex-grow flex justify-center items-center shadow-inner my-2 rounded-2xl min-h-[50px] overflow-hidden">
                    <p id="display-teller" class="text-5xl md:text-6xl xl:text-7xl font-digital text-[#00205B] drop-shadow-md tracking-tight leading-none">TL-000</p>
                </div>
                <div class="bg-blue-100 text-[#00205B] text-[11px] md:text-xs font-black px-5 py-1.5 rounded-full border border-[#00205B] text-center w-auto">
                    MENUJU MEJA TELLER
                </div>
            </div>
            
        </div>

        <div class="lg:col-span-8 h-full bg-black rounded-[1.5rem] shadow-xl overflow-hidden border-2 border-white relative box-border">
            <iframe id="youtube-player" class="absolute top-0 left-0 w-full h-full object-cover" 
                src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1&loop=1&playlist=dQw4w9WgXcQ&enablejsapi=1" 
                title="Video Media" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
            </iframe>
        </div>
    </main>

    <script>
        function sinkronisasiData() {
            const cs = localStorage.getItem('antreanCS') || 0;
            const teller = localStorage.getItem('antreanTeller') || 0;
            const videoId = localStorage.getItem('youtubeVideoId') || 'dQw4w9WgXcQ';
            const teksInfo = localStorage.getItem('teksPengumuman');

            document.getElementById('display-cs').innerText = 'CS-' + String(cs).padStart(3, '0');
            document.getElementById('display-teller').innerText = 'TL-' + String(teller).padStart(3, '0');

            const player = document.getElementById('youtube-player');
            if (!player.src.includes(videoId)) {
                player.src = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1&loop=1&playlist=${videoId}&enablejsapi=1`;
            }

            if (teksInfo) document.getElementById('marquee-text').innerText = teksInfo;
        }

        window.addEventListener('storage', sinkronisasiData);
        window.onload = sinkronisasiData;

        setInterval(() => {
            const sekarang = new Date();
            document.getElementById('jam').innerText = sekarang.toLocaleTimeString('id-ID', { hour12: false });
        }, 1000);
    </script>
</body>
</html>
