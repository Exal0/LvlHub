<?php
session_start();
require_once 'config/config.php';
require_once 'models/user.php';

$showSuccessModal = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST["username"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $confirm_password = trim($_POST["confirmPassword"] ?? '');

    if (empty($email)) { $errors["email"] = "Email requis."; }
    if (empty($username)) { $errors["username"] = "Nom d'utilisateur requis."; }
    if ($password != $confirm_password) { $errors["password"] = "Les mots de passe divergent."; }

    if (empty($errors)) {
        $userModel = new player($pdo, $username, $email, password_hash($password, PASSWORD_DEFAULT), 'user');
        if ($userModel->exists()) {
            $errors["email"] = "Identifiants déjà utilisés.";
        } else {
            if ($userModel->register()) {
                $showSuccessModal = true;
            } else {
                $errors[] = "Erreur technique.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include __DIR__ . '/partials/headpage.php'; ?>
    <script src="https://cdn.tailwindcss.com"></script>
  
</head>

<body class="bg-[#020202] text-gray-300 font-sans min-h-screen overflow-x-hidden flex flex-col">

  
    <main class="relative z-10 flex-grow flex items-center justify-center p-6">
        <div class="w-full max-w-4xl bg-[#0a0a0a]/80 border border-gray-800 backdrop-blur-xl p-8 md:p-12 shadow-2xl relative">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#00f2ff] to-transparent shadow-[0_0_15px_#00f2ff]"></div>

            <div class="text-center mb-10">
                <h1 class="text-4xl md:text-5xl font-black italic uppercase tracking-tighter text-white">
                    INITIALISER_<span class="text-[#00f2ff] drop-shadow-[0_0_8px_#00f2ff]">PROFIL</span>
                </h1>
                <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mt-2 italic">Enregistrement sur le réseau LVLHUB</p>
            </div>

            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <div class="flex flex-col gap-2">
                        <label for="username" class="text-[10px] uppercase font-black tracking-widest text-[#00f2ff]">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" placeholder="AGENT_NAME" 
                               class="bg-[#050505] border border-gray-800 p-3 text-white focus:outline-none focus:border-[#00f2ff] transition-all font-mono text-sm"
                               value="<?= htmlspecialchars($username ?? '') ?>">
                        <?php if (isset($errors['username'])): ?>
                            <span class="text-[#ff0055] text-[10px] uppercase font-bold italic"><?= $errors['username'] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-[10px] uppercase font-black tracking-widest text-[#00f2ff]">Adresse Email</label>
                        <input type="email" name="email" id="email" placeholder="EMAIL@NETWORK.COM" 
                               class="bg-[#050505] border border-gray-800 p-3 text-white focus:outline-none focus:border-[#00f2ff] transition-all font-mono text-sm"
                               value="<?= htmlspecialchars($email ?? '') ?>">
                        <?php if (isset($errors['email'])): ?>
                            <span class="text-[#ff0055] text-[10px] uppercase font-bold italic"><?= $errors['email'] ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-[10px] uppercase font-black tracking-widest text-[#7000ff]">Mot de passe</label>
                        <input type="password" name="password" id="password" placeholder="********" 
                               class="bg-[#050505] border border-gray-800 p-3 text-white focus:outline-none focus:border-[#7000ff] transition-all font-mono text-sm">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="confirm_password" class="text-[10px] uppercase font-black tracking-widest text-[#7000ff]">Confirmation</label>
                        <input type="password" name="confirmPassword" id="confirm_password" placeholder="********" 
                               class="bg-[#050505] border border-gray-800 p-3 text-white focus:outline-none focus:border-[#7000ff] transition-all font-mono text-sm">
                        <?php if (isset($errors['password'])): ?>
                            <span class="text-[#ff0055] text-[10px] uppercase font-bold italic"><?= $errors['password'] ?></span>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="flex flex-col md:flex-row gap-4 pt-6">
                    <button type="submit" class="flex-grow bg-[#00f2ff] text-black font-black uppercase tracking-tighter py-4 transform -skew-x-12 hover:bg-white hover:shadow-[0_0_20px_#00f2ff] transition-all">
                        <span class="inline-block skew-x-12 italic text-lg">Confirmer l'inscription</span>
                    </button>
                    
                    <a href="./login.php" class="md:w-1/3 flex items-center justify-center border border-gray-700 text-gray-400 font-black uppercase tracking-tighter py-4 transform -skew-x-12 hover:border-white hover:text-white transition-all">
                        <span class="inline-block skew-x-12 italic text-sm">Connexion</span>
                    </a>
                </div>

                <div class="text-center pt-4">
                    <a href="../../index.php" class="text-[10px] uppercase tracking-[0.3em] text-gray-600 hover:text-[#00f2ff] transition-colors">
                        [ ESC_RETOUR_AU_MENU ]
                    </a>
                </div>
            </form>
        </div>
    </main>

    <dialog id="successModal" class="fixed inset-0 w-full h-full bg-transparent p-0 backdrop:bg-black/95 backdrop:backdrop-blur-md">
        <div class="flex items-center justify-center min-h-full p-4">
            <div class="bg-[#0a0a0a] border-2 border-[#00f2ff] w-full max-w-sm p-10 text-center relative shadow-[0_0_50px_rgba(0,242,255,0.2)]">
                <div class="mx-auto flex items-center justify-center h-20 w-20 border-2 border-[#00f2ff] mb-6 text-[#00f2ff] drop-shadow-[0_0_10px_#00f2ff]">
                    <svg class="h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-white italic uppercase tracking-tighter mb-2">Accès_Autorisé</h2>
                <p class="text-gray-500 font-mono text-xs uppercase mb-8">Votre profil a été injecté avec succès dans le réseau.</p>

                <a href="./login.php" class="block w-full bg-[#00f2ff] text-black font-black py-4 uppercase tracking-tighter hover:bg-white shadow-[0_0_15px_rgba(0,242,255,0.4)] transition-all">
                    Se Connecter
                </a>
            </div>
        </div>
    </dialog>

    <?php if ($showSuccessModal): ?>
        <script>document.getElementById('successModal').showModal();</script>
    <?php endif; ?>

    <script src="../../assets/js/inscription.js"></script>
</body>
</html>