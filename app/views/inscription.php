<?php
session_start();
require_once 'config/config.php';
require_once 'models/user.php';

$showSuccessModal = true;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST["username"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $password = trim($_POST["password"] ?? '');
    $confirm_password = trim($_POST["confirmPassword"] ?? '');

    if (empty($email)) {
        $errors["email"] = "Vous devez rentrer un Email";
    }

    if (empty($username)) {
        $errors["username"] = "Vous devez rentrer un nom d'utilisateur";
    }

    if ($password != $confirm_password) {
        $errors["password"] = "les mots de passe ne correspondent pas";
    }

    if (empty($errors)) {
        $userModel = new player($pdo, $username, $email, password_hash($password, PASSWORD_DEFAULT));
        if ($userModel->exists()) {
            $errors["email"] = "Ce nom d'utilisateur ou cet email est déjà pris.";
        } else {
            if ($userModel->register()) {
                $showSuccessModal = true;
            } else {
                $errors[] = "Erreur technique lors de l'inscription.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include __DIR__ . '/partials/headpage.php'; ?>

<body class="bg-[#0a0a0f]">
    <main>

        <div class="p-8">
            <h1 class="text-3xl font-bold underline text-blue-600 mb-6 text-center">
                Formulaire d'inscription
            </h1>

            <div class="flex justify-center">
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="flex flex-col space-y-4">

                    <!-- <?php foreach ($errors as $error) : ?>
                        <p class="text-red-500"><?= $error ?></p>
                    <?php endforeach; ?> -->

                    <div class="grid grid-cols-2 gap-x-20 gap-y-6 ">

                        <div class="flex flex-col">
                            <label for="username" class="text-white">Nom d'utilisateur</label>
                            <input type="text" name="username" id="username" placeholder="username" class="border p-2 bg-white" value="<?= htmlspecialchars($username ?? '') ?>">
                            <?php if (isset($errors['username'])): ?>
                                <span class="text-red-500 text-sm mt-1"><?= $errors['username'] ?></span>
                            <?php endif; ?>
                        </div>


                        <div class="flex flex-col">
                            <label for="email" class="text-white">Email</label>
                            <input type="email" name="email" id="email" placeholder="email" class="border p-2 bg-white" value="<?= htmlspecialchars($email ?? '') ?>">

                            <?php if (isset($errors['email'])): ?>
                                <span class="text-red-500 text-sm mt-1"><?= $errors['email'] ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col">
                            <label for="password" class="text-white">Mot de passe</label>
                            <input type="password" name="password" id="password" placeholder="password" class="border p-2 bg-white">


                        </div>

                        <div class="flex flex-col">
                            <label for="confirm_password" class="text-white">Confirmer le mot de passe</label>
                            <input type="password" name="confirmPassword" id="confirm_password" placeholder="Confirmer" class="border p-2 bg-white">
                            <?php if (isset($errors['password'])): ?>
                                <span class="text-red-500 text-sm mt-1"><?= $errors['password'] ?></span>
                            <?php endif; ?>
                        </div>

                    </div>
                    <input type="submit" value="S'inscrire" class="bg-blue-600 text-white p-2 rounded cursor-pointer mt-4">
                </form>
            </div>
        </div>
    </main>

    <?php if ($showSuccessModal): ?>
        <div id="shouldShowModal" class="hidden"></div>
    <?php endif; ?>

    <dialog id="successModal" class="rounded-xl bg-[#0a0a0f] text-white p-8 shadow-2xl backdrop:bg-black/80 backdrop:backdrop-blur-sm">
        <div class="">
            <h2>Inscription Réussite ! </h2>
            <a href="./login.php">Se connecter</a>
        </div>
    </dialog>

    <script src="../../assets/js/inscription.js"></script>
</body>

</html>