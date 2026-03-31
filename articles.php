<?php 
require_once 'db.php'; 
$conn->set_charset("utf8mb4");

// ඩේටාබේස් එකෙන් සියලුම ලිපි ලබා ගැනීම (සීමාවක් නොමැතිව)
$query = "SELECT * FROM articles ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Articles - ZeroTech | Knowledge Hub</title>
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
                    <a href="articles.php" class="text-emerald-400">Articles</a>
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
                <a href="index.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Home</a>
                <a href="articles.php" class="block px-3 py-2 rounded-md text-base font-medium text-emerald-400 bg-slate-800">Articles</a>
                <a href="videos.php" class="block px-3 py-2 rounded-md text-base font-medium text-emerald-400 bg-slate-800">Videos</a>
                <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">About Us</a>
                <div class="pt-4">
                    <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" class="block w-full text-center bg-emerald-500 text-slate-900 font-bold py-3 rounded-lg uppercase text-sm">Join WhatsApp</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="py-12 md:py-20 bg-slate-900/30 border-b border-slate-800/50 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-2xl md:text-5xl font-extrabold uppercase tracking-tight mb-4 leading-tight">
                Explore Our <span class="gradient-text">Knowledge Hub</span>
            </h1>
            <p class="text-slate-500 max-w-xl mx-auto text-xs md:text-base">
                Google හි සැඟවුණු රහස් සහ තාක්ෂණික දැනුම අඩංගු සියලුම ලිපි මෙතැනින් කියවන්න.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        
        <div class="flex flex-col sm:flex-row justify-between items-center mb-8 md:mb-12 gap-4">
            <h2 class="text-base md:text-lg font-bold uppercase tracking-widest border-l-4 border-emerald-500 pl-4">All Stories</h2>
            <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest bg-slate-800/50 px-3 py-1 rounded-full border border-slate-800">
                <?php echo $result->num_rows; ?> Articles Total
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
            <?php 
            if ($result->num_rows > 0): 
                while($row = $result->fetch_assoc()): 
                    $img = !empty($row['image_url']) ? 'uploads/' . $row['image_url'] : 'https://via.placeholder.com/400x250?text=ZeroTech';
            ?>
                <div class="bg-slate-800/30 border border-slate-800 rounded-2xl overflow-hidden hover:border-emerald-500/30 transition-all duration-300 group hover:-translate-y-1">
                    <div class="h-48 relative overflow-hidden">
                        <img src="<?php echo $img; ?>" alt="<?php echo $row['title']; ?>" class="object-cover w-full h-full group-hover:scale-110 transition duration-500 opacity-90 group-hover:opacity-100">
                        <div class="absolute top-3 left-3">
                            <span class="bg-emerald-500 text-slate-900 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider"><?php echo htmlspecialchars($row['category']); ?></span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-base md:text-lg leading-tight mb-3 line-clamp-2 group-hover:text-emerald-400 transition"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="text-slate-500 text-[11px] mb-4 line-clamp-2"><?php echo strip_tags($row['content']); ?></p>
                        <div class="flex justify-between items-center pt-4 border-t border-slate-800">
                            <a href="view-article.php?id=<?php echo $row['id']; ?>" class="text-emerald-400 text-[10px] font-bold uppercase hover:underline">Read Story →</a>
                            <span class="text-[10px] text-slate-600 font-medium"><?php echo date('M d', strtotime($row['created_at'])); ?></span>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile; 
            else: 
            ?>
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-500 italic text-sm">තාමත් කිසිදු ලිපියක් එකතු කර නොමැත.</p>
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