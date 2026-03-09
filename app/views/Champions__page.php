<?php 

?>

<!DOCTYPE html>
<html lang="en">

<?php include __DIR__ . '/partials/head.php'; ?>

<body>

<?php include __DIR__ . '/partials/header.php'; ?>

<main>
    <section class="w-100p">
        <div>
            <h1 class="text-white">Liste des champions LoL</h1>

            <div class="w-100">
                <div class="flex gap-10 direction-column">

                    <div class="flex justify-center gap-6">

                        <button id="filter-all" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Coy_Emote.png" alt="Tous">
                            <span>Tous</span>
                        </button>

                        <button id="filter-fighter" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Fighter_icon.png" alt="Fighter">
                            <span>Combattant</span>
                        </button>

                        <button id="filter-mage" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Mage_icon.png" alt="Mage">
                            <span>Mage</span>
                        </button>

                        <button id="filter-marksman" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Marksman_icon.png" alt="Marksman">
                            <span>Tireur</span>
                        </button>

                        <button id="filter-assassin" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Slayer_icon.png" alt="Assassin">
                            <span>Assassin</span>
                        </button>

                        <button id="filter-support" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Support_icon.png" alt="Support">
                            <span>Support</span>
                        </button>

                        <button id="filter-tank" class="filter-btn">
                            <img src="/LvlHub/assets/images/roles_lol/Tank_icon.png" alt="Tank">
                            <span>Tank</span>
                        </button>

                    </div>

                    <div class="flex justify-center">
                        <input 
                            type="search"
                            placeholder="Entrez un nom"
                            id="search-champion"
                            class="search-champion w-40p"
                        >
                    </div>

                </div>
            </div>
        </div>

        <div class="w-100p flex justify-center">
            <div class="champions-container" id="champions-container"></div>
        </div>

    </section>

    <!-- point d'ancrage pour les champions -->
    <div id="champions" class="champions-grid"></div>

    <!-- Modal -->
    <div id="champion-modal" class="modal hidden">

        <div class="modal-overlay"></div>

        <div class="lol-modal">
            <button id="modal-close" class="lol-close">✕</button>

            <div class="lol-left">
                <img id="modal-splash" alt="">
            </div>

            <div class="lol-right">
                <h2 id="modal-name" class="lol-name"></h2>
                <p id="modal-title" class="lol-title"></p>

                <div id="modal-roles" class="lol-roles"></div>

                <p id="modal-lore" class="lol-lore"></p>

                <div id="modal-spells" class="lol-spells"></div>
            </div>

        </div>

    </div>

</main>

<footer>
    <?php include __DIR__ . '/partials/footer.php'; ?>
</footer>

<script src="/LvlHub/assets/js/champions.js"></script>

</body>
</html>