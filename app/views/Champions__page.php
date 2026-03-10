<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<?php include __DIR__ . '/partials/head.php'; ?>

<body class="bg-[#020202] text-white font-sans selection:bg-[#00f2ff]/30">

    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
        <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-[#00f2ff]/10 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[600px] h-[600px] bg-[#7000ff]/10 rounded-full blur-[150px]"></div>
    </div>

    <?php include __DIR__ . '/partials/header.php'; ?>

    <main class="relative z-10 pt-24 pb-20 px-4">
        
        <section class="max-w-7xl mx-auto text-center mb-16">
            <h1 class="text-6xl md:text-8xl font-black italic uppercase tracking-tighter mb-4 text-white">
                ARCHIVES_<span class="text-transparent bg-clip-text bg-gradient-to-b from-[#00f2ff] to-[#0066ff] drop-shadow-[0_0_15px_rgba(0,242,255,0.5)]">CHAMPIONS</span>
            </h1>
            <p class="text-[#00f2ff] max-w-2xl mx-auto italic tracking-[0.2em] uppercase text-xs opacity-70">Réseau Ionia // Noxus // Protocole de recherche activé</p>
        </section>

        <section class="max-w-6xl mx-auto mb-12 space-y-8">
            <div class="flex flex-wrap justify-center gap-4">
                <?php 
                $roles = [
                    'all' => ['Tous', 'Coy_Emote.png'],
                    'fighter' => ['Combattant', 'Fighter_icon.png'],
                    'mage' => ['Mage', 'Mage_icon.png'],
                    'marksman' => ['Tireur', 'Marksman_icon.png'],
                    'assassin' => ['Assassin', 'Slayer_icon.png'],
                    'support' => ['Support', 'Support_icon.png'],
                    'tank' => ['Tank', 'Tank_icon.png'],
                ];
                foreach ($roles as $id => $data): ?>
                    <button id="filter-<?= $id ?>" 
                            class="group flex flex-col items-center gap-2 p-4 bg-[#0a0a0a] border border-gray-800 hover:border-[#00f2ff] hover:shadow-[0_0_15px_rgba(0,242,255,0.2)] transition-all min-w-[100px] clip-path-polygon">
                        <img src="/LvlHub/assets/images/roles_lol/<?= $data[1] ?>" alt="<?= $data[0] ?>" class="w-10 h-10 brightness-50 group-hover:brightness-100 group-hover:scale-110 transition-all">
                        <span class="text-[9px] uppercase font-black tracking-widest text-gray-500 group-hover:text-[#00f2ff]"><?= $data[0] ?></span>
                    </button>
                <?php endforeach; ?>
            </div>

            <div class="flex justify-center">
                <div class="relative w-full max-w-md group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-[#00f2ff] to-[#7000ff] opacity-20 group-hover:opacity-50 transition duration-500 blur"></div>
                    <input type="search" placeholder="SCANNER UN CHAMPION..." id="search-champion"
                        class="relative w-full bg-[#050505] border border-gray-800 rounded-none px-6 py-4 text-[#00f2ff] placeholder-[#00f2ff]/30 focus:outline-none focus:border-[#00f2ff] transition-all uppercase text-sm tracking-widest">
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto">
            <div id="champions-container" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                </div>
        </section>
    </main>

    <div id="champion-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="modal-overlay absolute inset-0 bg-black/95 backdrop-blur-md"></div>
        <div class="relative bg-[#0a0a0a] border-2 border-[#00f2ff]/20 w-full max-w-6xl overflow-hidden shadow-[0_0_50px_rgba(0,0,0,1)] flex flex-col md:flex-row max-h-[90vh]">
            
            <button id="modal-close" class="absolute top-0 right-0 z-50 bg-[#00f2ff] text-black w-12 h-12 flex items-center justify-center hover:bg-white transition-colors font-bold">✕</button>
            
            <div class="md:w-1/2 h-64 md:h-auto overflow-hidden relative border-r border-[#00f2ff]/20">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] to-transparent z-10"></div>
                <img id="modal-splash" src="" alt="" class="w-full h-full object-cover">
            </div>

            <div class="md:w-1/2 p-8 md:p-12 overflow-y-auto text-left relative">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <span class="text-6xl font-black italic">LVL_HUB</span>
                </div>
                
                <h2 id="modal-name" class="text-6xl font-black italic uppercase tracking-tighter mb-1 text-[#00f2ff]"></h2>
                <p id="modal-title" class="text-white uppercase tracking-[0.3em] font-bold text-xs mb-8 opacity-60"></p>
                
                <div id="modal-roles" class="flex gap-2 mb-10"></div>
                
                <div class="space-y-8">
                    <div class="border-l-2 border-[#00f2ff] pl-4">
                        <h4 class="text-[#00f2ff] text-[10px] uppercase font-black tracking-widest mb-3 italic">Data_Lore</h4>
                        <p id="modal-lore" class="text-gray-400 leading-relaxed italic text-sm"></p>
                    </div>
                    <div>
                        <h4 class="text-[#7000ff] text-[10px] uppercase font-black tracking-widest mb-4 italic">Capacités_Actives</h4>
                        <div id="modal-spells" class="flex gap-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>
    <script src="/LvlHub/assets/js/champions.js"></script>
</body>
</html>