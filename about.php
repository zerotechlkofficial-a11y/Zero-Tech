<?php 
require_once 'db.php'; 
?>
<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - ZeroTech | Our Vision & Mission</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; line-height: 1.7; }
        .gradient-text {
            background: linear-gradient(to right, #2dd4bf, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        #mobile-menu { transition: all 0.3s ease-in-out; }
    </style>
</head>
<body class="selection:bg-emerald-500/30">

    <nav class="border-b border-slate-800 bg-slate-900/50 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-2">
                    <img src="logo.jpeg" alt="ZeroTech" class="w-10 h-10 rounded-full object-cover border-2 border-emerald-500 shadow-md"> 
                    <a href="index.php" class="text-lg md:text-xl font-bold tracking-tighter uppercase">Zero <span class="text-emerald-400">Tech</span></a>
                </div>
                
                <div class="hidden md:flex space-x-8 text-sm font-medium uppercase tracking-wide">
                    <a href="index.php" class="hover:text-emerald-400 transition">Home</a>
                    <a href="articles.php" class="hover:text-emerald-400 transition">Articles</a>
                    <a href="videos.php" class="hover:text-emerald-400 transition">Videos</a>
                    <a href="about.php" class="text-emerald-400">About Us</a>
                </div>

                <div class="hidden md:block">
                    <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" target="_blank" class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/50 px-4 py-2 rounded-lg text-xs font-bold uppercase hover:bg-emerald-500 hover:text-white transition">
                        WhatsApp Channel
                    </a>
                </div>

                <div class="md:hidden">
                    <button id="menu-btn" class="text-slate-300 hover:text-white focus:outline-none">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-slate-900 border-b border-slate-800">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Home</a>
                <a href="articles.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Articles</a>
                <a href="videos.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Videos</a>
                <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-emerald-400 bg-slate-800">About Us</a>
                <div class="pt-4">
                    <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" class="block w-full text-center bg-emerald-500 text-slate-900 font-bold py-3 rounded-lg uppercase text-sm">Join WhatsApp Channel</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="py-16 md:py-24 px-4 text-center">
        <span class="text-emerald-400 font-bold uppercase text-[10px] tracking-[0.3em] mb-4 block">The Story of ZeroTech</span>
        <h1 class="text-3xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight uppercase">
            Empowering Your <br> <span class="gradient-text">Digital Journey</span>
        </h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-lg px-2">
            අපි ZeroTech හරහා උත්සාහ කරන්නේ ලෝකයේ බලවත්ම සෙවුම් යන්ත්‍රය වන Google හි සැඟවුණු රහස් සහ තාක්ෂණික දැනුම සරලව ඔබ වෙත සමීප කිරීමටයි.
        </p>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-24">
            <div class="space-y-6 order-2 md:order-1">
                <h2 class="text-2xl md:text-3xl font-bold">What is ZeroTech?</h2>
                <p class="text-slate-400 text-base md:text-lg">
                    තාක්ෂණය සීඝ්‍රයෙන් වෙනස් වන ලෝකයක, Google පද්ධතියේ ඇති බොහෝ පහසුකම් අප එදිනෙදා ජීවිතයේදී නිසි ලෙස භාවිතා කරන්නේ නැත. 
                    ZeroTech නිර්මාණය වූයේ එම "Unknown" සහ "Powerful" විශේෂාංග පියවරෙන් පියවර ඔබ වෙත පැහැදිලි කර දීමටයි.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-emerald-500/10 text-emerald-400 rounded-full flex-shrink-0 flex items-center justify-center text-xs">✓</span>
                        <span class="text-slate-300 text-sm md:text-base">Google Search Hacks & Operators</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-emerald-500/10 text-emerald-400 rounded-full flex-shrink-0 flex items-center justify-center text-xs">✓</span>
                        <span class="text-slate-300 text-sm md:text-base">Productivity with Workspace Tools</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 bg-emerald-500/10 text-emerald-400 rounded-full flex-shrink-0 flex items-center justify-center text-xs">✓</span>
                        <span class="text-slate-300 text-sm md:text-base">Hidden Google Secrets & Easter Eggs</span>
                    </li>
                </ul>
            </div>
            <div class="relative order-1 md:order-2">
                <div class="absolute inset-0 bg-emerald-500 rounded-3xl blur-3xl opacity-10"></div>
                <img src="uploads/about-vision.jpeg" alt="Tech Vision" class="w-full h-auto rounded-3xl border border-slate-800 shadow-2xl relative z-10">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 mb-24">
            <div class="glass-card p-8 rounded-3xl">
                <div class="w-12 h-12 bg-emerald-500/20 text-emerald-400 rounded-2xl flex items-center justify-center mb-6 text-2xl">🎯</div>
                <h3 class="text-xl font-bold mb-4">Our Mission</h3>
                <p class="text-slate-500 text-sm">ශ්‍රී ලාංකික තාක්ෂණලෝලීන් හට ලෝක මට්ටමේ දැනුම සිංහල භාෂාවෙන් ලබා දීම.</p>
            </div>
            <div class="glass-card p-8 rounded-3xl">
                <div class="w-12 h-12 bg-blue-500/20 text-blue-400 rounded-2xl flex items-center justify-center mb-6 text-2xl">👁️</div>
                <h3 class="text-xl font-bold mb-4">Our Vision</h3>
                <p class="text-slate-500 text-sm">ඩිජිටල් සාක්ෂරතාවය ඉහළ නැංවීම මගින් සෑම දෙනාටම තාක්ෂණයෙන් උපරිම ඵල ලැබීමට මග පෙන්වීම.</p>
            </div>
            <div class="glass-card p-8 rounded-3xl sm:col-span-2 md:col-span-1">
                <div class="w-12 h-12 bg-purple-500/20 text-purple-400 rounded-2xl flex items-center justify-center mb-6 text-2xl">💎</div>
                <h3 class="text-xl font-bold mb-4">Core Values</h3>
                <p class="text-slate-500 text-sm">නිරවද්‍යතාවය, සරල බව සහ ප්‍රායෝගික තාක්ෂණික දැනුම සැමට ලබා දීම.</p>
            </div>
        </div>

        <section class="text-center bg-gradient-to-r from-emerald-500/10 to-teal-500/10 border border-emerald-500/20 px-6 py-12 md:p-16 rounded-[2.5rem] md:rounded-[4rem]">
            <h2 class="text-2xl md:text-4xl font-bold mb-6">Be a Part of Our Community</h2>
            <p class="text-slate-400 mb-10 max-w-xl mx-auto text-sm md:text-base">
                තාක්ෂණික ලෝකයේ අලුත්ම තොරතුරු එසැනින් දැනගැනීමට අපගේ WhatsApp චැනලය හා සම්බන්ධ වන්න.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-emerald-500 text-slate-900 font-bold px-8 py-4 rounded-2xl hover:scale-105 transition shadow-xl shadow-emerald-500/20 uppercase text-[10px] tracking-widest text-center">Join WhatsApp</a>
                <a href="#" class="bg-slate-800 text-white font-bold px-8 py-4 rounded-2xl hover:bg-slate-700 transition uppercase text-[10px] tracking-widest text-center">Subscribe YouTube</a>
            </div>
        </section>

    </main>

    <footer class="border-t border-slate-800 py-10 text-center text-slate-500 text-sm px-4">
        <p>ZeroTech &copy; <?php echo date('Y'); ?>. All Rights Reserved.</p>
    </footer>

    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            if(menu.classList.contains('hidden')) {
                icon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
            } else {
                icon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });
    </script>

</body>
</html>