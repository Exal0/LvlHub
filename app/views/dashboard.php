<?php
session_start();
require_once 'config/config.php';
require_once 'models/user.php';

$showUser = [];

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SESSION['role'] == 'admin') {
    $admin = new admin($pdo, '', '', $_SESSION['role']);
    $showUser = $admin->showUser();
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete'){
        $del_player = trim($_POST['player_id']);
        $delete_user = $admin->deleteUser($del_player);
        header('Location: dashboard.php');
        exit();
 }
}


 if ($_SESSION['role'] == 'SuperAdmin') {
    $SuperAdmin = new superadmin($pdo, '', '', $_SESSION['role']);
    $showUser = $SuperAdmin->showUser();
 
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['action']) && $_POST['action'] == 'update_role') {
         $update_role = trim($_POST['new_role']);
         $update_role = $SuperAdmin->updateRole($_POST['player_id'], $update_role);
         header('Location: dashboard.php'); exit();
     
 }
 }


if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['action']) && $_POST['action'] == 'update_username') {
    $change_username = trim($_POST['new_username']);
    $player = new player($pdo, $_SESSION['username'], '', '', 'user');
    $change_username = $player->changeUser($change_username, $_SESSION['id']);
    header('Location: login.php');
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>HUD - LVLHUB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#0b0e14] text-gray-300 font-mono min-h-screen flex flex-col">

    <?php include __DIR__ . '/partials/header.php'; ?>

    <main class="flex-1 mb-8 max-w-5xl mx-auto mt-12 p-8 border border-gray-800 bg-[#0d1117]/80 backdrop-blur-md relative overflow-hidden">

       <?php if ($_SESSION['role'] == 'user') : ?>
            <div class="absolute top-0 left-0 w-full h-1 bg-[#00f2ff] shadow-[0_0_15px_#00f2ff]"></div>

            <h1 class="text-4xl font-black text-white italic tracking-tighter mb-10">
                USER_<span class="text-[#00f2ff]">SYSTEM</span>
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="p-6 bg-[#161b22] border-l-4 border-[#7000ff] group hover:border-[#00f2ff] transition-all">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-[#7000ff] group-hover:text-[#00f2ff]">Identifiant_Session</p>
                    <p class="text-2xl font-bold text-white mt-1"><?= htmlspecialchars($_SESSION['username']) ?></p>
                </div>

                <div class="p-6 bg-[#161b22] border-l-4 border-[#7000ff] group hover:border-[#00f2ff] transition-all">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-[#7000ff] group-hover:text-[#00f2ff]">Privilèges_Accès</p>
                    <p class="text-2xl font-bold text-[#00f2ff] mt-1 shadow-[#00f2ff] uppercase"><?= htmlspecialchars($_SESSION['role']) ?></p>
                </div>
            </div>

            <div class="mb-12">
                <h2 class="mb-6 text-lg font-black text-white italic tracking-tighter uppercase">
                    Favoris_<span class="text-[#7000ff]">Champions</span>
                </h2>
                
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    <div class="aspect-[3/4] bg-[#161b22] border border-dashed border-gray-700 flex flex-col items-center justify-center group hover:border-[#7000ff] transition-all cursor-pointer">
                        <span class="text-3xl text-gray-700 group-hover:text-[#7000ff] mb-2">+</span>
                        <p class="text-[9px] text-gray-600 uppercase tracking-widest">Ajouter_Favori</p>
                    </div>
                    
                    <div class="aspect-[3/4] bg-[#1c2128] border-b-2 border-[#7000ff] relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <p class="absolute bottom-3 left-3 text-xs font-bold text-white uppercase tracking-tighter group-hover:text-[#00f2ff]">Nom_Champion</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex gap-4 border-t border-gray-800 pt-8">
                <a href="../../index.php" class="group flex items-center gap-2 text-sm border border-gray-700 px-6 py-3 hover:border-white transition">
                    <span class="group-hover:translate-x-[-3px] transition-transform">←</span> RETOUR_RACINE
                </a>
                <button id="openModal" class="group flex items-center gap-2 text-sm border border-[#00f2ff] text-[#00f2ff] px-6 py-3 hover:bg-[#00f2ff] hover:text-black transition font-bold">
                    MODIFIER_PSEUDO <span class="group-hover:translate-x-[3px] transition-transform">→</span>
                </button>
            </div>

            <div id="modalOverlay" class="hidden fixed inset-0 bg-black/95 backdrop-blur-md flex items-center justify-center z-[150]">
                <div class="bg-[#0d1117] border-2 border-[#00f2ff] p-8 w-full max-w-md relative shadow-[0_0_50px_rgba(0,242,255,0.1)]">
                    <h2 class="text-2xl font-black text-white italic mb-6 tracking-tighter">PROTOCOLE_<span class="text-[#00f2ff]">RENOMMAGE</span></h2>
                    <form action="" method="POST" class="flex flex-col gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="text-[10px] uppercase text-gray-500 tracking-[0.3em]">Nouvelle_Entrée</label>
                            <input type="text" name="new_username" class="bg-[#161b22] border border-gray-800 p-4 text-white focus:border-[#00f2ff] outline-none transition font-mono" placeholder="PSEUDO_SYSTEM..." required>
                        </div>
                        <div class="flex gap-4">
                            <input type="hidden" name="player_id" value="<?= $_SESSION['id'] ?>">
                            <input type="hidden" name="action" value="update_username">
                            <button type="submit" class="flex-1 bg-[#00f2ff] text-black font-black py-4 hover:tracking-[0.2em] transition-all uppercase text-xs">INITIALISER</button>
                            <button type="button" id="closeModal" class="flex-1 border border-gray-800 text-gray-500 py-4 hover:text-white hover:bg-red-900/20 transition uppercase text-xs">ANNULER</button>
                        </div>
                    </form>
                </div>
            </div>
        
<?php elseif ($_SESSION['role'] == 'admin') : ?>
            <div class="absolute top-0 left-0 w-full h-1 bg-[#00f2ff] shadow-[0_0_15px_#00f2ff]"></div>
            
            <h1 class="text-4xl font-black text-white italic tracking-tighter mb-10">
                ADMIN_<span class="text-[#00f2ff]">SYSTEM</span>
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="p-6 bg-[#161b22] border-l-4 border-[#7000ff] group hover:border-[#00f2ff] transition-all">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-[#7000ff] group-hover:text-[#00f2ff]">Name_Session</p>
                    <p class="text-2xl font-bold text-white mt-1"><?= htmlspecialchars($_SESSION['username']) ?></p>
                </div>
                <div class="p-6 bg-[#161b22] border-l-4 border-[#7000ff] group hover:border-[#00f2ff] transition-all">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-[#7000ff] group-hover:text-[#00f2ff]">Privilèges_Accès</p>
                    <p class="text-2xl font-bold text-[#00f2ff] mt-1 shadow-[#00f2ff]"><?= htmlspecialchars($_SESSION['role']) ?></p>
                </div>
            </div>

            <h2 class="mb-6 text-lg font-black text-white italic tracking-tighter uppercase">
                Gestion_<span class="text-[#00f2ff]">Utilisateurs</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($showUser as $value) : ?>
                    <div class="p-5 bg-[#161b22] border-l-4 border-[#7000ff] hover:border-[#00f2ff] relative group transition-all">
                        <div class="mb-4">
                            <h3 class="text-white font-bold text-xl uppercase tracking-widest">
                                <?= htmlspecialchars($value['username']) ?>
                            </h3>
                            <p class="text-[10px] text-gray-500 italic">
                                ID_FLUX: <?= htmlspecialchars($value['email']) ?>
                            </p>
                        </div>

                        <div class="mt-4 border-t border-gray-800 pt-4 flex items-center justify-between">
                            <span class="text-[9px] uppercase text-gray-500 tracking-[0.2em]">Status: <?= htmlspecialchars($value['role']) ?></span>
                            
                            <?php if ($value['role'] == 'user') : ?>
                                <form action="" method="post" onsubmit="return confirm('Confirmer la suppression ?');">
                                    <input type="hidden" name="player_id" value="<?= $value['player_id'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="text-[#ff0055] hover:bg-[#ff0055] hover:text-white border border-[#ff0055] px-3 py-1 text-[9px] font-bold transition-all uppercase tracking-tighter">
                                        TERMINER_PROCESS
                                    </button>
                                </form>
                            <?php else : ?>
                                <span class="text-[9px] text-[#7000ff] italic">ACCÈS_RESTREINT</span>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        <?php elseif ($_SESSION['role'] == 'SuperAdmin') : ?>
            <div class="absolute top-0 left-0 w-full h-1 bg-[#ff0055] shadow-[0_0_15px_#ff0055]"></div>
            <h1 class="text-4xl font-black text-white italic tracking-tighter mb-10">SUPER_ADMIN_<span class="text-[#ff0055]">SYSTEM</span></h1>

            <h2 class="mb-6 text-lg font-black text-white italic tracking-tighter uppercase">Contrôle_Total_<span class="text-[#ff0055]">Utilisateurs</span></h2>
            <div class="grid grid-cols-3 gap-10">
                <?php foreach ($showUser as $value) : ?>
                    <div class="p-5 bg-[#161b22] border-l-4 border-[#ff0055] relative group">
                        <div class="mb-4">
                            <h3 class="text-white font-bold text-xl uppercase tracking-widest"><?= htmlspecialchars($value['username']) ?></h3>
                            <p class="text-[10px] text-gray-500 italic"><?= htmlspecialchars($value['role']) ?></p>
                        </div>

                        <form action="" method="POST" class="mt-4 border-t border-gray-800 pt-4 flex flex-col gap-3">
                            <input type="hidden" name="player_id" value="<?= $value['player_id'] ?>">
                            <label class="text-[9px] uppercase text-[#ff0055] tracking-widest font-bold">Modifier_Privilèges</label>
                            <div class="flex gap-2">
                                <select name="new_role" class="flex-1 bg-[#0d1117] border border-gray-700 text-[10px] p-2 text-white outline-none focus:border-[#ff0055] transition">
                                    <option value="user" <?= $value['role'] == 'user' ? 'selected' : '' ?>>USER</option>
                                    <option value="admin" <?= $value['role'] == 'admin' ? 'selected' : '' ?>>ADMIN</option>
                                    <option value="SuperAdmin" <?= $value['role'] == 'SuperAdmin' ? 'selected' : '' ?>>SUPERADMIN</option>
                                </select>
                                <input type="hidden" name="action" value="update_role">
                                <button type="submit" class="bg-[#ff0055] text-white px-3 py-2 text-[10px] font-bold hover:bg-white hover:text-black transition">MAJ</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>

    </main>

    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openBtn = document.getElementById('openModal');
            const closeBtn = document.getElementById('closeModal');
            const overlay = document.getElementById('modalOverlay');

            if (openBtn) openBtn.onclick = () => overlay.classList.remove('hidden');
            if (closeBtn) closeBtn.onclick = () => overlay.classList.add('hidden');
            window.onclick = (e) => {
                if (e.target === overlay) overlay.classList.add('hidden');
            };
        });
    </script>
</body>

</html>