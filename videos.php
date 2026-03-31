<?php 
require_once 'db.php'; 
$conn->set_charset("utf8mb4");

// ඩේටාබේස් එකෙන් සියලුම වීඩියෝ ලබා ගැනීම
$query = "SELECT * FROM videos ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos - ZeroTech | Discover Google Features</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
        .gradient-text {
            background: linear-gradient(to right, #2dd4bf, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
                    <a href="videos.php" class="text-emerald-400">Videos</a>
                    <a href="about.php" class="hover:text-emerald-400 transition">About Us</a>
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
                <a href="videos.php" class="block px-3 py-2 rounded-md text-base font-medium text-emerald-400 bg-slate-800">Videos</a>
                <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">About Us</a>
                <div class="pt-4">
                    <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" class="block w-full text-center bg-emerald-500 text-slate-900 font-bold py-3 rounded-lg uppercase text-sm">Join WhatsApp Channel</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="py-12 md:py-20 bg-slate-900/30 border-b border-slate-800/50 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold uppercase tracking-tight mb-4">
                Video <span class="gradient-text">Tutorials</span>
            </h1>
            <p class="text-slate-500 max-w-xl mx-auto text-sm md:text-base">
                Google විශේෂාංග සහ රහස් වීඩියෝ මගින් පහසුවෙන් ඉගෙන ගන්න.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-base md:text-lg font-bold uppercase tracking-widest border-l-4 border-emerald-500 pl-4">Latest Uploads</h2>
            <span class="text-[10px] text-slate-500 font-bold uppercase tracking-[0.2em]"><?php echo $result->num_rows; ?> Videos</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            if ($result->num_rows > 0): 
                while($v_row = $result->fetch_assoc()): 
            ?>
                <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition-all duration-300 group shadow-lg">
                    <div class="aspect-video relative overflow-hidden bg-slate-900">
                        <img src="https://img.youtube.com/vi/<?php echo $v_row['video_url']; ?>/maxresdefault.jpg" 
                             onerror="this.src='https://img.youtube.com/vi/<?php echo $v_row['video_url']; ?>/mqdefault.jpg'"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100"
                             alt="<?php echo htmlspecialchars($v_row['video_title']); ?>">
                        
                        <a href="https://youtube.com/watch?v=<?php echo $v_row['video_url']; ?>" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black/40 group-hover:bg-black/20 transition">
                            <div class="w-14 h-14 bg-red-600 text-white rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-sm md:text-base text-slate-200 line-clamp-2 group-hover:text-emerald-400 transition mb-3">
                            <?php echo htmlspecialchars($v_row['video_title']); ?>
                        </h3>
                        <div class="flex justify-between items-center text-[10px] text-slate-500 uppercase font-bold tracking-wider">
                            <span>YouTube Link</span>
                            <span><?php echo date('M d, Y', strtotime($v_row['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile; 
            else: 
            ?>
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-500 italic">තාමත් කිසිදු වීඩියෝවක් එකතු කර නොමැත.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="border-t border-slate-800 py-10 text-center text-slate-500 text-sm px-4 mt-12">
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