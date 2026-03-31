<?php 
require_once 'db.php'; 
$conn->set_charset("utf8mb4");

// 1. සෙවුම් වචනය ලබා ගැනීම
$search_query = isset($_GET['query']) ? trim($_GET['query']) : '';

// 2. සෙවුම් ක්‍රියාවලිය (Search Logic)
if (!empty($search_query)) {
    // SQL වල LIKE භාවිතා කරන්නේ අසම්පූර්ණ වචන සෙවීමටයි
    $search_term = "%" . $search_query . "%";
    
    $sql = "SELECT * FROM articles WHERE title LIKE ? OR content LIKE ? OR category LIKE ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // සෙවුම් වචනයක් නැත්නම් හිස් result එකක් පෙන්වන්න
    $result = false;
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results for "<?php echo htmlspecialchars($search_query); ?>" - ZeroTech</title>
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
                <a href="articles.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Articles</a>
                <a href="videos.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">Videos</a>
                <a href="about.php" class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:bg-slate-800">About Us</a>
                <div class="pt-4">
                    <a href="https://whatsapp.com/channel/0029VbCiBHHJ3jupQgSxvn3L" class="block w-full text-center bg-emerald-500 text-slate-900 font-bold py-3 rounded-lg uppercase text-sm">Join WhatsApp Channel</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
            
            <div class="lg:col-span-3">
                <header class="mb-10 md:mb-12">
                    <h1 class="text-2xl md:text-4xl font-bold leading-tight uppercase">Search Results for: <br class="md:hidden"> <span class="gradient-text italic">"<?php echo htmlspecialchars($search_query); ?>"</span></h1>
                    <p class="text-slate-500 text-xs md:text-sm mt-3 font-medium uppercase tracking-widest">
                        <?php echo ($result) ? $result->num_rows : 0; ?> articles found matching your query.
                    </p>
                </header>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                    <?php 
                    if ($result && $result->num_rows > 0): 
                        while($row = $result->fetch_assoc()): 
                            $img = !empty($row['image_url']) ? 'uploads/' . $row['image_url'] : 'https://via.placeholder.com/400x250?text=ZeroTech';
                    ?>
                        <div class="bg-slate-800/50 border border-slate-700 rounded-2xl overflow-hidden hover:border-emerald-500/50 transition group shadow-lg">
                            <div class="h-48 md:h-40 bg-slate-700 relative overflow-hidden">
                                <img src="<?php echo $img; ?>" alt="<?php echo $row['title']; ?>" class="object-cover w-full h-full group-hover:scale-110 transition duration-500">
                                <div class="absolute top-3 left-3">
                                    <span class="bg-emerald-500 text-slate-900 text-[10px] font-bold px-2 py-1 rounded uppercase"><?php echo htmlspecialchars($row['category']); ?></span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-base md:text-lg leading-tight mb-3 line-clamp-2 group-hover:text-emerald-400 transition"><?php echo htmlspecialchars($row['title']); ?></h3>
                                <p class="text-slate-400 text-xs mb-4 line-clamp-2"><?php echo strip_tags($row['content']); ?></p>
                                <a href="view-article.php?id=<?php echo $row['id']; ?>" class="text-emerald-400 text-[10px] font-bold uppercase hover:underline">Read More →</a>
                            </div>
                        </div>
                    <?php 
                        endwhile; 
                    else: 
                    ?>
                        <div class="col-span-full py-16 md:py-24 text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-slate-800 rounded-full mb-6 text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 md:h-10 md:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-xl md:text-2xl font-bold text-slate-300">No articles found!</h2>
                            <p class="text-slate-500 mt-2 text-sm">Try searching with different keywords like "Google" or "Hidden".</p>
                            <a href="index.php" class="inline-block mt-8 text-emerald-400 font-bold uppercase text-[10px] tracking-widest hover:underline">← Back to Home</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <aside class="lg:col-span-1 space-y-8 order-last lg:order-none">
                <div class="bg-slate-800/30 border border-slate-700 p-6 rounded-3xl shadow-lg">
                    <h3 class="font-bold uppercase tracking-widest mb-4 text-[10px] text-emerald-400">Search Again</h3>
                    <form action="search.php" method="GET" class="relative">
                        <input type="text" name="query" value="<?php echo htmlspecialchars($search_query); ?>" 
                               class="w-full bg-slate-900/50 border border-slate-700 rounded-xl py-3 pl-4 pr-12 text-sm focus:outline-none focus:border-emerald-500 transition">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 hover:text-emerald-400 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
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