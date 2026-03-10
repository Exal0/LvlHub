<?php
session_start();
if (!isset($_SESSION['username'])) { header('Location: login.php'); exit(); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HUD - LVLHUB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b0e14] text-gray-300 font-mono">

 <?php include __DIR__ . '/partials/headpage.php'; ?>

    <main class="max-w-5xl mx-auto mt-12 p-8 border border-gray-800 bg-[#0d1117]/80 backdrop-blur-md relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-[#00f2ff] shadow-[0_0_15px_#00f2ff]"></div>
        
        <h1 class="text-4xl font-black text-white italic tracking-tighter mb-10">
            DASHBOARD_<span class="text-[#00f2ff]">SYSTEM</span>
        </h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-6 bg-[#161b22] border-r-2 border-b-2 border-[#7000ff] group hover:border-[#00f2ff] transition-all">
                <p class="text-[10px] uppercase tracking-[0.2em] text-[#7000ff] group-hover:text-[#00f2ff]">Identifiant_Session</p>
                <p class="text-2xl font-bold text-white mt-1"><?= htmlspecialchars($_SESSION['username']) ?></p>
            </div>

            <div class="p-6 bg-[#161b22] border-r-2 border-b-2 border-[#7000ff] group hover:border-[#00f2ff] transition-all">
                <p class="text-[10px] uppercase tracking-[0.2em] text-[#7000ff] group-hover:text-[#00f2ff]">Privilèges_Accès</p>
                <p class="text-2xl font-bold text-[#00f2ff] mt-1 shadow-[#00f2ff]"><?= htmlspecialchars($_SESSION['role']) ?></p>
            </div>
        </div>

        <div class="mt-12 flex gap-4">
            <a href="../../index.php" class="group flex items-center gap-2 text-sm border border-gray-700 px-6 py-3 hover:border-white transition">
                <span class="group-hover:translate-x-[-3px] transition-transform">←</span> RETOUR_RACINE
            </a>
        </div>
    </main>

</body>
</html>