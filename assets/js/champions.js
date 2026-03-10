const VERSION = '14.1.1'; 
const LANG = 'fr_FR';  
let allChampions = [];

const championContainer = document.getElementById("champions-container");
const modal = document.getElementById("champion-modal");

// 1. FETCH DES DONNÉES
console.log("🚀 LvlHub Engine: Loading...");

fetch(`https://ddragon.leagueoflegends.com/cdn/${VERSION}/data/${LANG}/champion.json`)
  .then(res => res.json())
  .then(data => {
    allChampions = Object.values(data.data);
    displayChampions(allChampions);
  })
  .catch(err => console.error("Erreur API:", err));

// 2. AFFICHAGE DE LA GRILLE
function displayChampions(champions) {
  if (!championContainer) return;
  championContainer.innerHTML = ""; 

  champions.forEach(champ => {
    const card = document.createElement('div');
    card.className = "group relative bg-gray-900/40 border border-white/10 rounded-2xl overflow-hidden hover:border-blue-500/50 transition-all duration-300 cursor-pointer aspect-[3/4]";

    card.innerHTML = `
        <div class="w-full h-full overflow-hidden">
            <img src="https://ddragon.leagueoflegends.com/cdn/img/champion/loading/${champ.id}_0.jpg" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="${champ.name}">
        </div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-transparent to-transparent flex flex-col justify-end p-5">
            <h3 class="text-2xl font-black italic uppercase text-white group-hover:text-blue-400 transition-colors">${champ.name}</h3>
            <p class="text-blue-400 text-[10px] uppercase font-bold tracking-widest">${champ.title}</p>
        </div>`;

    card.addEventListener("click", () => openModal(champ));
    championContainer.appendChild(card);
  });
}

// 3. MODAL
function openModal(champ) {
  const modalSplash = document.getElementById("modal-splash");
  const modalName = document.getElementById("modal-name");
  const modalTitle = document.getElementById("modal-title");
  const modalLore = document.getElementById("modal-lore");
  const modalRoles = document.getElementById("modal-roles");
  const modalSpells = document.getElementById("modal-spells");

  modalName.textContent = champ.name;
  modalTitle.textContent = champ.title;
  modalLore.textContent = champ.blurb;
  modalSplash.src = `https://ddragon.leagueoflegends.com/cdn/img/champion/splash/${champ.id}_0.jpg`;

  modalRoles.innerHTML = "";
  champ.tags.forEach(tag => {
    modalRoles.innerHTML += `<span class="px-3 py-1 bg-blue-500/10 border border-blue-500/30 text-blue-400 text-[10px] font-bold rounded-md uppercase tracking-widest">${tag}</span>`;
  });

  modalSpells.innerHTML = "<div class='text-gray-600 animate-pulse'>...</div>";
  fetch(`https://ddragon.leagueoflegends.com/cdn/${VERSION}/data/${LANG}/champion/${champ.id}.json`)
    .then(res => res.json())
    .then(data => {
      const spells = data.data[champ.id].spells;
      modalSpells.innerHTML = ""; 
      spells.forEach(s => {
        modalSpells.innerHTML += `<img src="https://ddragon.leagueoflegends.com/cdn/${VERSION}/img/spell/${s.image.full}" class="w-12 h-12 rounded-lg border border-white/10 hover:border-blue-400 transition-all" title="${s.name}">`;
      });
    });

  modal.classList.remove("hidden");
  modal.classList.add("flex");
  document.body.style.overflow = "hidden";
}

// 4. FILTRES ET RECHERCHE
const setupFilter = (id, role) => {
  const btn = document.getElementById(id);
  if (btn) {
    btn.addEventListener("click", () => {
      const filtered = role === 'all' ? allChampions : allChampions.filter(c => c.tags.includes(role));
      displayChampions(filtered);
    });
  }
};

setupFilter("filter-all", "all");
setupFilter("filter-fighter", "Fighter");
setupFilter("filter-mage", "Mage");
setupFilter("filter-marksman", "Marksman");
setupFilter("filter-assassin", "Assassin");
setupFilter("filter-support", "Support");
setupFilter("filter-tank", "Tank");

const search = document.getElementById("search-champion");
if (search) {
  search.addEventListener("input", (e) => {
    const q = e.target.value.toLowerCase();
    displayChampions(allChampions.filter(c => c.name.toLowerCase().includes(q)));
  });
}

// 5. FERMETURE
const close = () => {
  modal.classList.add("hidden");
  modal.classList.remove("flex");
  document.body.style.overflow = "auto";
};

document.getElementById("modal-close")?.addEventListener("click", close);
modal.querySelector(".modal-overlay")?.addEventListener("click", close);