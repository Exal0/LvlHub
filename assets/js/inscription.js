console.log("qdqsqsd");



document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('successModal');
    
    const shouldOpen = document.getElementById('shouldShowModal');

    if (shouldOpen && modal) {
        modal.showModal();
    }
});


modal.addEventListener('click', (e) => {
    const dialogDimensions = modal.getBoundingClientRect();
    if (
        e.clientX < dialogDimensions.left ||
        e.clientX > dialogDimensions.right ||
        e.clientY < dialogDimensions.top ||
        e.clientY > dialogDimensions.bottom
    ) {
        modal.close();
    }
});


function resetInscription() {
 
    const modalSucces = document.getElementById('success-modal'); 
    const form = document.getElementById('registration-form');    

    // 2. On cache la modal
    if (modalSucces) {
        modalSucces.classList.add('hidden');
        modalSucces.classList.remove('flex');
    }
    if (form) {
        form.reset();
    }
}