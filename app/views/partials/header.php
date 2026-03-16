<?php 
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$display_name = $_SESSION['username'] ?? "";
?>

<header id="main-header" class="bg-[#020202]/95 backdrop-blur-md border-b border-[#00f2ff]/20 sticky top-0 z-[100] px-6 py-4 overflow-hidden transition-colors duration-500">
    <div class="max-w-7xl mx-auto relative h-10">
        
        <div id="header-main-content" class="flex justify-between items-center transition-all duration-500 transform translate-y-0 opacity-100">
            <a href="/LvlHub/index.php" class="text-2xl font-black italic tracking-tighter text-white group">
                LVL<span class="text-[#00f2ff] drop-shadow-[0_0_8px_#00f2ff]">HUB</span>
            </a>

            <nav class="hidden md:flex items-center gap-8 font-black uppercase text-xs tracking-[0.2em]">
                <a href="/LvlHub/index.php" class="hover:text-[#00f2ff] transition-colors italic">Accueil</a>
                
                <?php if (!empty($display_name)): ?>
                    <div class="flex items-center gap-6 border-l border-gray-800 pl-6">
                        <span class="text-gray-500 italic lowercase font-normal">agent/<b><?= htmlspecialchars($display_name) ?></b></span>
                        <a href="/LvlHub/app/views/dashboard.php" class="text-[#00f2ff] hover:brightness-125 transition">Dashboard</a>
                        <button id="logout-trigger" class="text-[#ff0055] hover:scale-110 transition cursor-pointer font-black italic tracking-widest">QUITTER</button>
                    </div>
                <?php else: ?>
                    <a href="/LvlHub/app/views/login.php" class="hover:text-[#00f2ff] transition">Connexion</a>
                    <a href="/LvlHub/app/views/inscription.php" class="px-6 py-2 bg-[#00f2ff] text-black transform -skew-x-12 hover:bg-white transition-all">
                        <span class="inline-block skew-x-12">S'inscrire</span>
                    </a>
                <?php endif; ?>
            </nav>

            <button id="burger-btn" class="md:hidden text-[#00f2ff]">
                <svg id="burger-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div id="logout-slide-bar" class="absolute inset-0 flex justify-between items-center transition-all duration-500 transform translate-y-full opacity-0 pointer-events-none">
            <div class="flex items-center gap-4">
                <span class="w-2 h-2 bg-[#ff0055] animate-pulse"></span>
                <span class="text-[#ff0055] font-black italic tracking-[0.3em] text-xs uppercase">Alerte : Interrompre la session ?</span>
            </div>
            
            <div class="flex gap-4">
                <a href="/LvlHub/logout.php" class="bg-[#ff0055] text-white px-6 py-2 text-[10px] font-black hover:bg-white hover:text-black transition uppercase tracking-widest">Confirmer</a>
                <button id="cancel-logout" class="border border-gray-600 text-gray-400 px-6 py-2 text-[10px] font-black hover:text-white hover:border-white transition uppercase tracking-widest">Annuler</button>
            </div>
        </div>

    </div>

    <div id="mobile-menu" class="hidden md:hidden mt-4 pt-4 border-t border-gray-900 flex flex-col gap-4">
        <a href="/LvlHub/index.php" class="text-white font-bold italic uppercase">Accueil</a>
        <?php if (!empty($display_name)): ?>
            <a href="/LvlHub/app/views/dashboard.php" class="text-white font-bold italic uppercase">Dashboard</a>
            <button id="logout-trigger-mobile" class="text-[#ff0055] font-bold italic uppercase text-left">Quitter</button>
        <?php endif; ?>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Éléments
    const header = document.getElementById('main-header');
    const mainContent = document.getElementById('header-main-content');
    const slideBar = document.getElementById('logout-slide-bar');
    const burgerBtn = document.getElementById('burger-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    // Déclencheurs
    const triggerDesktop = document.getElementById('logout-trigger');
    const triggerMobile = document.getElementById('logout-trigger-mobile');
    const cancelBtn = document.getElementById('cancel-logout');

    const showLogoutSlide = () => {
        // Animation Header
        header.classList.add('border-[#ff0055]/50');
        header.classList.remove('border-[#00f2ff]/20');
        
        // Switch de contenu
        mainContent.classList.add('-translate-y-full', 'opacity-0');
        slideBar.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
        slideBar.classList.add('translate-y-0', 'opacity-100');
    };

    const hideLogoutSlide = () => {
        // Reset Header
        header.classList.remove('border-[#ff0055]/50');
        header.classList.add('border-[#00f2ff]/20');

        // Switch de contenu
        mainContent.classList.remove('-translate-y-full', 'opacity-0');
        slideBar.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none');
        slideBar.classList.remove('translate-y-0', 'opacity-100');
    };

    // Events
    if (triggerDesktop) triggerDesktop.onclick = showLogoutSlide;
    if (triggerMobile) triggerMobile.onclick = showLogoutSlide;
    if (cancelBtn) cancelBtn.onclick = hideLogoutSlide;

    // Mobile Menu Toggle
    if (burgerBtn) {
        burgerBtn.onclick = () => {
            mobileMenu.classList.toggle('hidden');
        };
    }
});
</script>