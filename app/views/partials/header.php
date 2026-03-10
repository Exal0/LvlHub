<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$display_name = $_SESSION['username'] ?? "";
?>

<header class="bg-[#020202]/90 backdrop-blur-md border-b border-[#00f2ff]/20 sticky top-0 z-[100] px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        
        <a href="/LvlHub/index.php" class="text-2xl font-black italic tracking-tighter text-white group">
            LVL<span class="text-[#00f2ff] drop-shadow-[0_0_8px_#00f2ff]">HUB</span>
        </a>

        <nav class="hidden md:flex items-center gap-8 font-black uppercase text-xs tracking-[0.2em]">
            <a href="/LvlHub/index.php" class="hover:text-[#00f2ff] transition-colors italic">Accueil</a>
            
            <?php if (!empty($display_name)): ?>
                <div class="flex items-center gap-6 border-l border-gray-800 pl-6">
                    <span class="text-gray-500 italic">Agent: <b class="text-white"><?= htmlspecialchars($display_name) ?></b></span>
                    <a href="/LvlHub/app/views/dashboard.php" class="text-[#00f2ff] hover:brightness-125 transition">Dashboard</a>
                    <a href="/LvlHub/logout.php" class="text-[#ff0055] hover:brightness-125 transition">Quitter</a>
                </div>
            <?php else: ?>
                <a href="/LvlHub/app/views/login.php" class="hover:text-[#00f2ff] transition">Connexion</a>
                <a href="/LvlHub/app/views/inscription.php" class="px-6 py-2 bg-[#00f2ff] text-black transform -skew-x-12 hover:bg-white transition-all shadow-[0_0_15px_rgba(0,242,255,0.3)]">
                    <span class="inline-block skew-x-12">S'inscrire</span>
                </a>
            <?php endif; ?>
        </nav>

        <button id="burger-btn" class="md:hidden text-[#00f2ff] focus:outline-none p-2 border border-[#00f2ff]/30 rounded">
            <svg id="burger-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 w-full bg-[#0a0a0a] border-b border-[#00f2ff]/50 p-6 flex flex-col gap-6 animate-fade-in shadow-[0_10px_30px_rgba(0,0,0,0.8)]">
        <a href="/LvlHub/index.php" class="text-lg font-bold italic uppercase tracking-widest text-white border-b border-gray-900 pb-2">Accueil</a>
        
        <?php if (!empty($display_name)): ?>
            <div class="space-y-4">
                <p class="text-[10px] text-gray-500 uppercase tracking-widest">Connecté en tant que : <span class="text-[#00f2ff]"><?= htmlspecialchars($display_name) ?></span></p>
                <a href="/LvlHub/app/views/dashboard.php" class="block text-white font-bold hover:text-[#00f2ff]">MON DASHBOARD</a>
                <a href="/LvlHub/logout.php" class="block text-[#ff0055] font-bold">DÉCONNEXION</a>
            </div>
        <?php else: ?>
            <a href="/LvlHub/app/views/login.php" class="block text-white font-bold hover:text-[#00f2ff]">CONNEXION</a>
            <a href="/LvlHub/app/views/inscription.php" class="block w-full text-center py-4 bg-[#00f2ff] text-black font-black italic uppercase tracking-tighter">S'INSCRIRE</a>
        <?php endif; ?>
    </div>
</header>

<script>
    const burgerBtn = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const burgerIcon = document.getElementById('burger-icon');

    burgerBtn.addEventListener('click', () => {
        const isHidden = mobileMenu.classList.contains('hidden');
        
        if (isHidden) {
            mobileMenu.classList.remove('hidden');
            // Change l'icône en "X"
            burgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
        } else {
            mobileMenu.classList.add('hidden');
            // Remet l'icône "Burger"
            burgerIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />';
        }
    });
</script>