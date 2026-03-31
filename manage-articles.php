<?php
session_start();
require_once 'db.php';

// Security Check
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

// සියලුම ලිපි අලුත්ම එකේ සිට පැරණි එක දක්වා ලබා ගැනීම
$query = "SELECT id, title, category, created_at FROM articles ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Articles - ZeroTech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
        /* ස්ක්‍රෝල් බාර් එක ලස්සන කිරීමට */
        .custom-scrollbar::-webkit-scrollbar { height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1e293b; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen overflow-x-hidden">

    <?php include 'admin-sidebar.php'; ?>

    <main class="flex-1 p-5 md:p-12 overflow-y-auto">
        
        <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-10">
            <div>
                <h1 class="text-2xl font-bold">Manage Articles</h1>
                <p class="text-slate-500 text-sm">View, edit, or remove your published content.</p>
            </div>
            <a href="admin-dashboard.php#add-article" class="w-full sm:w-auto text-center bg-emerald-500 text-slate-900 px-6 py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-emerald-400 transition shadow-lg shadow-emerald-500/10">
                + Add New
            </a>
        </header>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-slate-800/50 border-b border-slate-800 text-slate-400">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider">Title</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider">Category</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr class="hover:bg-slate-800/30 transition group">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-white line-clamp-1 group-hover:text-emerald-400 transition"><?php echo htmlspecialchars($row['title']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 bg-slate-800 text-emerald-400 text-[10px] font-bold rounded-full uppercase border border-emerald-500/20">
                                            <?php echo htmlspecialchars($row['category']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-xs text-slate-500">
                                        <?php echo date('M d, Y', strtotime($row['created_at'])); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center gap-3">
                                            <a href="edit-article.php?id=<?php echo $row['id']; ?>" class="p-2 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-lg hover:bg-blue-500 hover:text-white transition" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="p-2 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg hover:bg-red-500 hover:text-white transition" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500 italic text-sm">No articles found. Start sharing your knowledge!</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function confirmDelete(id) {
            if (confirm("අංජන, ඔබට විශ්වාසද? මෙම ලිපිය සදහටම මැකී යනු ඇත!")) {
                window.location.href = "delete-article.php?id=" + id;
            }
        }
    </script>

</body>
</html>