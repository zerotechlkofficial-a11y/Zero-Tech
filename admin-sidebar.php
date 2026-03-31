<?php
// දැනට ඉන්න පිටුව හඳුනාගැනීම (Highlight කිරීමට)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="w-full md:w-64 bg-slate-900 border-b md:border-b-0 md:border-r border-slate-800 p-4 md:p-6 flex-shrink-0 md:h-screen md:sticky md:top-0 z-50">
    
    <div class="flex items-center justify-between md:mb-10">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center font-bold text-white shadow-lg shadow-emerald-500/20">Z</div>
            <span class="text-xl font-bold tracking-tighter uppercase">Zero <span class="text-emerald-400">Tech</span></span>
        </div>

        <button id="sidebar-toggle" class="md:hidden text-slate-400 hover:text-white p-2 focus:outline-none transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path id="burger-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <nav id="sidebar-menu" class="hidden md:block mt-6 md:mt-0 space-y-2">
        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 ml-4">Main Menu</p>
        
        <a href="admin-dashboard.php" class="flex items-center px-4 py-3 rounded-xl transition duration-200 <?php echo ($current_page == 'admin-dashboard.php') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
            Dashboard
        </a>

        <a href="manage-articles.php" class="flex items-center px-4 py-3 rounded-xl transition duration-200 <?php echo ($current_page == 'manage-articles.php') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
            Manage Articles
        </a>

        <a href="manage-videos.php" class="flex items-center px-4 py-3 rounded-xl transition duration-200 <?php echo ($current_page == 'manage-videos.php') ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-bold' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
            Manage Videos
        </a>

        <div class="pt-6 md:pt-10">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em] mb-4 ml-4">System</p>
            <a href="logout.php" class="flex items-center px-4 py-3 rounded-xl text-red-400 hover:bg-red-500/10 transition duration-200">
                Logout
            </a>
        </div>
    </nav>
</aside>

<script>
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarMenu = document.getElementById('sidebar-menu');
    const burgerIcon = document.getElementById('burger-icon');

    sidebarToggle.addEventListener('click', () => {
        sidebarMenu.classList.toggle('hidden');
        
        // ඉරි 3 X එකකට මාරු කරන ලොජික් එක
        if (sidebarMenu.classList.contains('hidden')) {
            burgerIcon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
        } else {
            burgerIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        }
    });
</script>