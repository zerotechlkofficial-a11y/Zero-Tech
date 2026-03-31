<?php
session_start();
require_once 'db.php';

// Security Check
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

// Stats ලබා ගැනීම
$article_count = $conn->query("SELECT id FROM articles")->num_rows;
$video_count = $conn->query("SELECT id FROM videos")->num_rows;
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZeroTech Admin - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen overflow-x-hidden">

    <?php include 'admin-sidebar.php'; ?>

    <main class="flex-1 p-5 md:p-12">
        
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <h1 class="text-xl md:text-2xl font-bold">Welcome back, <?php echo $_SESSION['admin_user']; ?>! 👋</h1>
                <p class="text-slate-500 text-sm">Here's what's happening with ZeroTech today.</p>
            </div>
            <a href="index.php" target="_blank" class="w-full sm:w-auto text-center text-[10px] font-bold uppercase tracking-widest text-emerald-400 border border-emerald-400/30 px-5 py-2.5 rounded-xl hover:bg-emerald-400 hover:text-slate-900 transition">
                View Website
            </a>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-10">
            <div class="bg-slate-800/50 border border-slate-700 p-6 rounded-2xl">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-2">Total Articles</p>
                <h2 class="text-3xl md:text-4xl font-bold"><?php echo $article_count; ?></h2>
            </div>
            <div class="bg-slate-800/50 border border-slate-700 p-6 rounded-2xl">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-2">Total Videos</p>
                <h2 class="text-3xl md:text-4xl font-bold"><?php echo $video_count; ?></h2>
            </div>
        </div>

        <section id="add-article" class="bg-slate-900 border border-slate-800 rounded-2xl md:rounded-3xl p-6 md:p-8">
            <h2 class="text-lg font-bold mb-6 flex items-center gap-2">
                <span class="w-1.5 h-5 bg-emerald-500 rounded-full"></span>
                Add New Article
            </h2>
            
            <form action="save-article.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-wide">Article Title</label>
                        <input type="text" name="title" required class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-wide">Category</label>
                        <input type="text" name="category" placeholder="e.g. Google Search" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-wide">Featured Image</label>
                    <input type="file" name="image" accept="image/*" required class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-xs text-slate-400 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-emerald-500/10 file:text-emerald-400">
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-wide">Content</label>
                    <textarea name="content" rows="6" required class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm"></textarea>
                </div>

                <button type="submit" class="w-full md:w-auto bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-bold py-4 px-10 rounded-xl transition shadow-lg shadow-emerald-500/20 uppercase text-[10px] tracking-widest">
                    Publish Article
                </button>
            </form>
        </section>

    </main>

</body>
</html>