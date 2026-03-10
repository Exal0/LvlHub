<?php
session_start();
require_once 'config/config.php';
require_once 'models/user.php';

$erreurs = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $userModel = new player($pdo, $username, '', '', 'user');
        $player = $userModel->login($username, $password);

        if ($player) {
            $_SESSION['username'] = $player->getUsername();
            $_SESSION['role'] = $player->getRole();

            header('Location: ../../index.php');
            exit();
        } else {
            $erreurs['login'] = "Identifiants Incorrects.";
        }
    } else {
        $erreurs['login'] = "Veuillez remplir tous les champs.";
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
        <div class="w-full max-w-md bg-[#0a0a0a]/90 border border-gray-800 backdrop-blur-xl p-10 shadow-2xl relative">
            
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-[#7000ff] to-transparent shadow-[0_0_15px_#7000ff]"></div>

            <div class="text-center mb-10">
                <h1 class="text-4xl font-black italic uppercase tracking-tighter text-white">
                    AUTH_<span class="text-[#7000ff] drop-shadow-[0_0_8px_#7000ff]">CONNECTION</span>
                </h1>
                <p class="text-[9px] uppercase tracking-[0.4em] text-gray-500 mt-2 italic">Vérification des accès requise</p>
            </div>

            <?php if (isset($erreurs['login'])): ?>
                <div class="bg-red-500/10 border-l-4 border-red-500 p-3 mb-6">
                    <p class="text-red-500 text-xs uppercase font-bold tracking-widest italic"><?= $erreurs['login'] ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="space-y-6">
                
                <div class="flex flex-col gap-2">
                    <label for="username" class="text-[10px] uppercase font-black tracking-widest text-[#00f2ff]">Identifiant</label>
                    <input type="text" name="username" id="username" placeholder="VOTRE_PSEUDO" required
                           class="bg-[#050505] border border-gray-800 p-4 text-white focus:outline-none focus:border-[#00f2ff] transition-all font-mono text-sm uppercase">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password" class="text-[10px] uppercase font-black tracking-widest text-[#00f2ff]">Code_Accès</label>
                    <input type="password" name="password" id="password" placeholder="********" required
                           class="bg-[#050505] border border-gray-800 p-4 text-white focus:outline-none focus:border-[#00f2ff] transition-all font-mono text-sm">
                </div>

                <div class="pt-4 flex flex-col gap-4">
                    <button type="submit" class="w-full bg-[#7000ff] text-white font-black uppercase tracking-tighter py-4 transform -skew-x-12 hover:bg-white hover:text-black hover:shadow-[0_0_25px_#7000ff] transition-all">
                        <span class="inline-block skew-x-12 italic text-lg">Établir la connexion</span>
                    </button>

                    <div class="flex justify-between items-center px-2">
                        <a href="./inscription.php" class="text-[10px] uppercase font-bold text-gray-500 hover:text-[#00f2ff] transition-colors tracking-widest">
                            Créer un compte
                        </a>
                        <a href="../../index.php" class="text-[10px] uppercase font-bold text-gray-600 hover:text-white transition-colors tracking-widest">
                            Retour
                        </a>
                    </div>
                </div>
            </form>
        </div>


    </main>

</body>
</html>