<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include 'app/views/partials/head.php'; ?>
  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#020202] text-gray-300 font-sans overflow-x-hidden">

  <?php include 'app/views/partials/header.php'; ?>

  <main class="relative z-10 px-6">

    <section class="max-w-7xl mx-auto pt-40 pb-24 flex flex-col items-center text-center">
      <span class="px-5 py-1 border-l-4 border-[#00f2ff] bg-[#00f2ff]/5 text-[#00f2ff] text-[10px] font-black uppercase tracking-[0.3em] mb-8 shadow-[0_0_15px_rgba(0,242,255,0.2)]">
        Système LVLHUB // Online
      </span>

      <h1 class="relative text-7xl md:text-9xl font-black mb-8 tracking-tighter italic uppercase leading-[0.9] text-white">
        <div class="absolute inset-0 bg-[#00f2ff]/20 blur-[60px] animate-pulse z-0"></div>
        
        <span class="relative z-10">LEVEL </span>
        <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-[#00f2ff] via-white to-[#00f2ff] bg-[length:200%_auto] animate-gradient-x drop-shadow-[0_0_15px_rgba(0,242,255,0.4)]">
          UP
        </span>
        <br>
        <span class="relative z-10 text-[#7000ff] drop-shadow-[0_0_15px_rgba(112,0,255,0.5)]">TOGETHER</span>
      </h1>

      <p class="max-w-2xl text-gray-500 text-sm md:text-base font-mono uppercase tracking-widest leading-relaxed mb-12 opacity-80">
        > Décortiquer les mécaniques<br>
        > Optimiser les builds<br>
        > Dominer le classement_
      </p>

      <div class="flex flex-wrap justify-center gap-6">
        <a href="app/views/Champions__page.php" class="group relative px-10 py-5 bg-[#00f2ff] text-black font-black uppercase tracking-tighter transition-all hover:bg-white hover:shadow-[0_0_30px_#00f2ff] transform -skew-x-12">
          <span class="inline-block skew-x-12 italic">Explorer les Champions</span>
        </a>
        <a href="gamepage.php" class="px-10 py-5 border border-white/20 hover:border-[#7000ff] hover:text-[#7000ff] text-white font-black uppercase tracking-tighter transition-all transform -skew-x-12 backdrop-blur-md">
          <span class="inline-block skew-x-12 italic text-sm">Parcourir les Jeux</span>
        </a>
      </div>
    </section>

    <section class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 pb-32">

      <div class="relative p-8 bg-[#0a0a0a]/80 border border-gray-800 group hover:border-[#00f2ff] transition-all duration-500 backdrop-blur-md">
        <div class="w-14 h-14 border border-[#00f2ff]/30 flex items-center justify-center mb-8 text-[#00f2ff] group-hover:bg-[#00f2ff] group-hover:text-black transition-all shadow-[0_0_10px_rgba(0,242,255,0.2)]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
        </div>
        <h3 class="text-2xl font-black italic uppercase text-white mb-4 tracking-tighter">Builds Meta</h3>
        <p class="text-gray-500 text-xs leading-relaxed font-mono uppercase tracking-wider">Optimisation des protocoles d'équipement testés en conditions réelles.</p>
      </div>

      <div class="relative p-8 bg-[#0a0a0a]/80 border border-gray-800 group hover:border-[#7000ff] transition-all duration-500 backdrop-blur-md">
        <div class="w-14 h-14 border border-[#7000ff]/30 flex items-center justify-center mb-8 text-[#7000ff] group-hover:bg-[#7000ff] group-hover:text-black transition-all shadow-[0_0_10px_rgba(112,0,255,0.2)]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
        </div>
        <h3 class="text-2xl font-black italic uppercase text-white mb-4 tracking-tighter">Réseau_Com</h3>
        <p class="text-gray-500 text-xs leading-relaxed font-mono uppercase tracking-wider">Interface d'échange cryptée entre agents de haut niveau.</p>
      </div>

      <div class="relative p-8 bg-[#0a0a0a]/80 border border-gray-800 group hover:border-[#00f2ff] transition-all duration-500 backdrop-blur-md">
        <div class="w-14 h-14 border border-[#00f2ff]/30 flex items-center justify-center mb-8 text-[#00f2ff] group-hover:bg-[#00f2ff] group-hover:text-black transition-all shadow-[0_0_10px_rgba(0,242,255,0.2)]">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2" /></svg>
        </div>
        <h3 class="text-2xl font-black italic uppercase text-white mb-4 tracking-tighter">Analytique</h3>
        <p class="text-gray-500 text-xs leading-relaxed font-mono uppercase tracking-wider">Monitoring précis des flux de données et performances de patch.</p>
      </div>

    </section>
  </main>

  <?php include 'app/views/partials/footer.php'; ?>
  
</body>
</html>