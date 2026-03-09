console.log("qdqsqsd");



document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('successModal');
    
    const shouldOpen = document.getElementById('shouldShowModal');

    if (shouldOpen && modal) {
        modal.showModal();
    }
});