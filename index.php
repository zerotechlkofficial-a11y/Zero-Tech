<?php 
require_once 'db.php'; 

// 1. ලිපි 6ක් ලබා ගැනීම
$query = "SELECT * FROM articles ORDER BY created_at DESC LIMIT 6";
$result = $conn->query($query);

// 2. වීඩියෝ 4ක් ලබා ගැනීම
$video_query = "SELECT * FROM videos ORDER BY created_at DESC LIMIT 4";
$video_result = $conn->query($video_query);
?>
<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeroTech - Discover Google's Hidden Universe</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
        .gradient-text {
            background: linear-gradient(to right, #2dd4bf, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(to right, #2dd4bf, #10b981);
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
                    <a href="index.php" class="text-emerald-400">Home</a>
                    <a href="articles.php" class="hover:text-emerald-400 transition">Articles</a>
                    <a href="videos.php" class="hover:text-emerald-400 transition">Videos</a>
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
                <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-emerald-400 bg-slate-800">Home</a>
                <a href="articles.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Articles</a>
                <a href="videos.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Videos</a>
                <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">About Us</a>
                <div class="pt-4">
                    <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" class="block w-full text-center bg-emerald-500 text-slate-900 font-bold py-3 rounded-lg uppercase text-sm">Join WhatsApp Channel</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="py-16 md:py-28 px-4 text-center">
        <h1 class="text-3xl md:text-6xl font-extrabold tracking-tight mb-4 uppercase leading-tight">
            Discover Google's <br class="md:hidden"> <span class="gradient-text">Hidden Universe</span>
        </h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-sm md:text-lg mb-8 px-2">
            Exploring Known, Unknown, and Powerful Google Features. Connected Content for Tech Enthusiasts.
        </p>
        <a href="articles.php" class="btn-gradient inline-block px-8 py-4 rounded-full font-bold uppercase text-xs tracking-widest hover:scale-105 transition shadow-lg shadow-emerald-500/20">
            Start Exploring
        </a>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            <div class="lg:col-span-3 space-y-16 order-1">
                <section>
                    <h2 class="text-lg md:text-xl font-bold uppercase tracking-widest mb-8 border-l-4 border-emerald-500 pl-4">Latest Articles</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <?php if ($result->num_rows > 0): 
                            while($row = $result->fetch_assoc()): 
                                $img = !empty($row['image_url']) ? 'uploads/' . $row['image_url'] : 'https://via.placeholder.com/400x250?text=ZeroTech';
                        ?>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition group shadow-lg">
                                <div class="h-48 md:h-40 bg-slate-700 relative overflow-hidden">
                                    <img src="<?php echo $img; ?>" alt="<?php echo $row['title']; ?>" class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-emerald-500 text-slate-900 text-[10px] font-bold px-2 py-1 rounded uppercase"><?php echo $row['category']; ?></span>
                                    </div>
                                </div>
                                <div class="p-5">
                                    <h3 class="font-bold text-base md:text-lg leading-tight mb-3 line-clamp-2"><?php echo $row['title']; ?></h3>
                                    <p class="text-slate-400 text-xs mb-4 line-clamp-2"><?php echo strip_tags($row['content']); ?></p>
                                    <a href="view-article.php?id=<?php echo $row['id']; ?>" class="text-emerald-400 text-[10px] font-bold uppercase hover:underline">Read More →</a>
                                </div>
                            </div>
                        <?php endwhile; else: ?>
                            <p class="text-slate-500 italic col-span-3 text-center py-10">තාමත් ලිපි එකතු කර නැත...</p>
                        <?php endif; ?>
                    </div>
                </section>

                <section>
                    <h2 class="text-lg md:text-xl font-bold uppercase tracking-widest mb-8 border-l-4 border-emerald-500 pl-4">Featured Videos</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php if ($video_result->num_rows > 0): 
                            while($v_row = $video_result->fetch_assoc()): 
                        ?>
                            <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition group">
                                <div class="aspect-video relative overflow-hidden bg-slate-900">
                                    <img src="https://img.youtube.com/vi/<?php echo $v_row['video_url']; ?>/maxresdefault.jpg" 
                                         onerror="this.src='https://img.youtube.com/vi/<?php echo $v_row['video_url']; ?>/mqdefault.jpg'"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-80 group-hover:opacity-100">
                                    
                                    <a href="https://youtube.com/watch?v=<?php echo $v_row['video_url']; ?>" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black/40 group-hover:bg-black/20 transition">
                                        <div class="w-14 h-14 bg-red-600 text-white rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-4 bg-slate-900/50">
                                    <h3 class="font-bold text-sm text-slate-200 line-clamp-1 group-hover:text-emerald-400 transition"><?php echo $v_row['video_title']; ?></h3>
                                </div>
                            </div>
                        <?php endwhile; else: ?>
                            <p class="text-slate-500 italic col-span-2 text-center py-10">තාමත් වීඩියෝ එකතු කර නැත...</p>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

            <aside class="lg:col-span-1 space-y-8 order-2">
                <div class="bg-slate-800/30 border border-slate-700 p-6 rounded-3xl shadow-lg">
                    <h3 class="font-bold uppercase tracking-widest mb-4 text-[10px] text-emerald-400">Search Articles</h3>
                    <form action="search.php" method="GET" class="relative">
                        <input type="text" name="query" placeholder="Explore ZeroTech..." 
                               class="w-full bg-slate-900/50 border border-slate-700 rounded-xl py-3 pl-4 pr-12 text-sm focus:outline-none focus:border-emerald-500 transition placeholder:text-slate-600">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-emerald-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="bg-slate-800/30 border border-slate-700 p-6 rounded-3xl shadow-lg">
                    <h3 class="font-bold uppercase tracking-widest mb-6 text-[10px] text-emerald-400">Stay Connected</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4">
                        <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" class="flex items-center gap-4 p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl hover:bg-emerald-500/20 transition group">
                            <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center font-bold text-white shadow-lg shadow-emerald-500/20">W</div>
                            <div><p class="text-sm font-bold">WhatsApp</p><p class="text-[10px] text-slate-400 uppercase font-semibold">Join Channel</p></div>
                        </a>
                        <a href="#" class="flex items-center gap-4 p-4 bg-red-500/10 border border-red-500/20 rounded-xl hover:bg-red-500/20 transition group">
                            <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg shadow-red-600/20">Y</div>
                            <div><p class="text-sm font-bold">YouTube</p><p class="text-[10px] text-slate-400 uppercase font-semibold">Subscribe</p></div>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
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