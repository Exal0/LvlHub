console.log("dfp");


const openBtn = document.getElementById('openModal');
const closeBtn = document.getElementById('closeModal');
const overlay = document.getElementById('modalOverlay');

openBtn.addEventListener('click', () => overlay.classList.remove('hidden'));
closeBtn.addEventListener('click', () => overlay.classList.add('hidden'));

// Fermer si on clique sur l'overlay noir
overlay.addEventListener('click', (e) => {
    if(e.target === overlay) overlay.classList.add('hidden');
});