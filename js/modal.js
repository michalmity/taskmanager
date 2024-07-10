
function hideModal() {
    document.getElementById('modal').style.display = 'none';
}

function showModal() {
    document.getElementById('modal').style.display = 'block';
}

document.getElementById('modal-close').addEventListener('click', hideModal);

// Zavřít modal při kliknutí mimo modalní okno
window.onclick = function(event) {
    if (event.target == document.getElementById('modal')) {
        hideModal();
    }
}

