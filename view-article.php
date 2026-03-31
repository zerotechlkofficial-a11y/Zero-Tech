<?php 
require_once 'db.php'; 
$conn->set_charset("utf8mb4");

// 1. URL එක හරහා ලැබෙන ID එක ලබා ගැනීම සහ ආරක්ෂාව පරීක්ෂා කිරීම
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // ඩේටාබේස් එකෙන් අදාළ ලිපිය පමණක් ලබා ගැනීම
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - ZeroTech</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; line-height: 1.8; }
        .gradient-text {
            background: linear-gradient(to right, #2dd4bf, #10b981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        /* ලිපියේ අන්තර්ගතය සඳහා අකුරු ප්‍රමාණයන් */
        .article-content { font-size: 1.05rem; color: #cbd5e1; }
        @media (min-width: 768px) { .article-content { font-size: 1.15rem; } }
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
                        WhatsApp
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

    <main class="max-w-4xl mx-auto px-5 py-10 md:py-20">
        
        <div class="mb-6 flex flex-wrap items-center gap-3">
            <span class="bg-emerald-500 text-slate-900 text-[9px] md:text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                <?php echo htmlspecialchars($article['category']); ?>
            </span>
            <span class="text-slate-500 text-[11px] md:text-xs font-medium uppercase tracking-widest">
                Published: <?php echo date('M d, Y', strtotime($article['created_at'])); ?>
            </span>
        </div>

        <h1 class="text-2xl md:text-5xl font-extrabold leading-tight mb-8 md:mb-12 uppercase tracking-tight">
            <?php echo htmlspecialchars($article['title']); ?>
        </h1>

        <div class="w-full aspect-video rounded-2xl md:rounded-[2.5rem] overflow-hidden mb-10 md:mb-16 border border-slate-800 shadow-2xl">
            <?php $img = !empty($article['image_url']) ? 'uploads/' . $article['image_url'] : 'https://via.placeholder.com/1200x600'; ?>
            <img src="<?php echo $img; ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full h-full object-cover">
        </div>

        <article class="article-content space-y-6 leading-relaxed text-justify md:text-left">
            <?php 
                echo nl2br(htmlspecialchars($article['content'])); 
            ?>
        </article>

        <hr class="my-12 md:my-20 border-slate-800">

        <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
            <a href="articles.php" class="text-emerald-400 font-bold uppercase text-[10px] tracking-[0.2em] hover:underline flex items-center gap-2 group">
                <span class="group-hover:-translate-x-1 transition-transform">←</span> Back to Articles
            </a>
            <div class="text-center sm:text-right">
                <p class="text-slate-500 text-[10px] uppercase font-bold tracking-widest italic">ZeroTech - Discover Google's Hidden Universe</p>
            </div>
        </div>

    </main>

    <footer class="border-t border-slate-800 py-10 text-center text-slate-500 text-[11px] px-4 uppercase tracking-[0.1em]">
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