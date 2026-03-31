<?php
session_start();
require_once 'db.php';

// Security Check
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

// ඩේටාබේස් එකෙන් අදාළ ලිපියේ දත්ත ලබා ගැනීම
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM articles WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        header("Location: manage-articles.php");
        exit();
    }
} else {
    header("Location: manage-articles.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article - ZeroTech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen overflow-x-hidden">

    <?php include 'admin-sidebar.php'; ?>

    <main class="flex-1 p-5 md:p-12 overflow-y-auto">
        <header class="mb-10">
            <h1 class="text-xl md:text-2xl font-bold italic">Edit Article: <span class="text-emerald-400 font-normal">"<?php echo htmlspecialchars($article['title']); ?>"</span></h1>
            <p class="text-slate-500 text-sm">Update the information below to modify your content.</p>
        </header>

        <section class="bg-slate-900 border border-slate-800 rounded-2xl md:rounded-3xl p-6 md:p-8 max-w-4xl shadow-2xl">
            <form action="update-article.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="id" value="<?php echo $article['id']; ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-widest">Article Title</label>
                        <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required 
                            class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-widest">Category</label>
                        <input type="text" name="category" value="<?php echo htmlspecialchars($article['category']); ?>"
                            class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm">
                    </div>
                </div>

                <div class="bg-slate-800/30 p-5 md:p-6 rounded-2xl border border-slate-800">
                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-4 tracking-widest">Featured Image</label>
                    <div class="flex flex-col sm:flex-row gap-6 items-center sm:items-start">
                        <div class="w-full sm:w-48 h-32 bg-slate-800 rounded-xl overflow-hidden border border-slate-700 shadow-inner flex-shrink-0">
                            <img src="uploads/<?php echo $article['image_url']; ?>" class="w-full h-full object-cover" alt="Current Image">
                        </div>
                        <div class="flex-1 w-full">
                            <input type="file" name="image" accept="image/*" 
                                class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-xs text-slate-400 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-bold file:bg-emerald-500/10 file:text-emerald-400">
                            <p class="text-[10px] text-slate-500 mt-3 italic">* වෙනස් කිරීමට අවශ්‍ය නම් පමණක් අලුත් පින්තූරයක් තෝරන්න.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-widest">Content</label>
                    <textarea name="content" rows="10" required 
                        class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm leading-relaxed"><?php echo htmlspecialchars($article['content']); ?></textarea>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 border-t border-slate-800 pt-6">
                    <button type="submit" class="w-full sm:w-auto bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-bold py-4 px-10 rounded-xl transition shadow-lg shadow-emerald-500/20 uppercase text-[10px] tracking-widest">
                        Save Changes
                    </button>
                    <a href="manage-articles.php" class="w-full sm:w-auto bg-slate-800 hover:bg-slate-700 text-white font-bold py-4 px-10 rounded-xl transition uppercase text-[10px] tracking-widest text-center">
                        Cancel
                    </a>
                </div>
            </form>
        </section>
    </main>

</body>
</html>