<?php
session_start();
require_once 'db.php';

// Security Check
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: zerotech-access.php");
    exit();
}

// සියලුම වීඩියෝ ලබා ගැනීම
$query = "SELECT * FROM videos ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="si">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Videos - ZeroTech Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #0f172a; color: #f8fafc; }
        .custom-scrollbar::-webkit-scrollbar { height: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #1e293b; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>
</head>
<body class="flex flex-col md:flex-row min-h-screen overflow-x-hidden">

    <?php include 'admin-sidebar.php'; ?>

    <main class="flex-1 p-5 md:p-12 overflow-y-auto">
        
        <header class="mb-10">
            <h1 class="text-2xl font-bold">Manage Videos</h1>
            <p class="text-slate-500 text-sm">Add YouTube links to showcase Google feature videos.</p>
        </header>

        <section class="bg-slate-900 border border-slate-800 rounded-2xl md:rounded-3xl p-6 md:p-8 mb-12 shadow-xl">
            <h2 class="text-lg font-bold mb-6 flex items-center gap-2 text-emerald-400 uppercase tracking-widest text-[10px]">
                <span class="w-1.5 h-4 bg-emerald-500 rounded-full"></span>
                Add New Video
            </h2>
            <form action="save-video.php" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div class="md:col-span-1">
                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-widest">Video Title</label>
                    <input type="text" name="video_title" required class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm">
                </div>
                <div class="md:col-span-1">
                    <label class="block text-[10px] font-bold uppercase text-slate-500 mb-2 tracking-widest">YouTube URL</label>
                    <input type="url" name="video_url" placeholder="https://youtube.com/..." required class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 focus:border-emerald-500 outline-none transition text-sm">
                </div>
                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-600 text-slate-900 font-bold py-3.5 px-8 rounded-xl transition shadow-lg shadow-emerald-500/20 uppercase text-[10px] tracking-widest">
                    Save Video
                </button>
            </form>
        </section>

        <div class="bg-slate-900 border border-slate-800 rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left min-w-[500px]">
                    <thead>
                        <tr class="bg-slate-800/50 border-b border-slate-800 text-slate-400">
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider">Preview</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider">Title</th>
                            <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-wider text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr class="hover:bg-slate-800/30 transition group">
                                    <td class="px-6 py-4">
                                        <div class="w-24 h-14 bg-slate-800 rounded-lg overflow-hidden border border-slate-700 shadow-inner">
                                            <img src="https://img.youtube.com/vi/<?php echo $row['video_url']; ?>/mqdefault.jpg" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-sm text-slate-200"><?php echo htmlspecialchars($row['video_title']); ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="p-2.5 bg-red-500/10 text-red-400 border border-red-500/20 rounded-lg hover:bg-red-500 hover:text-white transition" title="Delete Video">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="px-6 py-12 text-center text-slate-500 italic text-sm">No videos found. Time to add some!</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function confirmDelete(id) {
            if (confirm("අංජන, මෙම වීඩියෝව ඉවත් කිරීමට ඔබට විශ්වාසද?")) {
                window.location.href = "delete-video.php?id=" + id;
            }
        }
    </script>

</body>
</html>