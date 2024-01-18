// Definisci la funzione handlePhotoUpload prima di chiamarla
function handlePhotoUpload(event) {
    const fileInput = document.getElementById('photoInput');
    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('postImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    function openGallery() {
        document.getElementById('photoInput').click();
    }
    
    function handlePhotoUpload(event) {
        const fileInput = document.getElementById('photoInput');
        const file = fileInput.files[0];
    
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('postImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
    
    function handleConfirmation() {
        console.log("Funzione handleConfirmation chiamata");
        const photoInput = document.getElementById('photoInput');
        const descriptionInput = document.getElementById('descriptionInput');
        const confirmationMessage = document.getElementById('confirmationMessage');

        if (photoInput.files.length === 0 || descriptionInput.value.trim() === '') {
            alert('Compila tutti i campi prima di confermare.');
            return;
        }

        // Mostra il messaggio di conferma
        confirmationMessage.style.display = 'block';

        // Aggiorna il testo del messaggio di conferma
        confirmationMessage.innerText = 'Il post è stato inviato con successo!';

        // Resetta i campi
        photoInput.value = '';
        document.getElementById('postImage').src = '../icon/aggiungi-foto.svg';
        descriptionInput.value = '';

        // Nascondi il messaggio dopo 2,5 secondi
        setTimeout(function() {
            confirmationMessage.style.display = 'none';
        }, 2500);
    }      
    document.getElementById('confirmButton').addEventListener('click', handleConfirmation);
    document.getElementById('photoInput').addEventListener('change', handlePhotoUpload);
});