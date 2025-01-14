function confirmButton(message) {
    return confirm(message);
}

// Ambil elemen input file dan elemen gambar preview
const fileInput = document.getElementById('fileInput');
const previewImage = document.getElementById('previewImage');
const buttonHapusProfile = document.querySelector('.hapusProfile');
const cekHapusProfileInput = document.querySelector('#hapusProfile');

if(buttonHapusProfile) {

    buttonHapusProfile.addEventListener('click', (e) => {
        e.preventDefault();
        previewImage.src = "img/profile/default.jpg";
        buttonHapusProfile.style.display = 'none';
        fileInput.value = "";
        cekHapusProfileInput.value = "true";
    })

    buttonHapusProfile.style.display = 'none';
    let nameFileNow = previewImage.src.split('/');
    nameFileNow = nameFileNow.pop()
    if(nameFileNow != 'default.jpg') {
        buttonHapusProfile.style.display = 'block';
    }
}


// Fungsi untuk menampilkan gambar baru
const showPreview = (file) => {
    const reader = new FileReader();
    reader.onload = (event) => {
        // Ubah sumber gambar preview dengan Base64 dari file
        previewImage.src = event.target.result;
    };
    
    if(buttonHapusProfile) {

        buttonHapusProfile.style.display = 'block';
    }
    reader.readAsDataURL(file); // Baca file sebagai Data URL (Base64)
};

// Event listener untuk input file
fileInput.addEventListener('change', function () {
    const file = fileInput.files[0]; // Ambil file pertama dari input
    if (file) {
        previewImage.style.display = 'block';
        // Jika file dipilih, tampilkan preview
        showPreview(file);
    }
});

// **Contoh Penggunaan: Create & Edit**
// Mode Create: Kosongkan gambar jika tidak ada data awal
// Mode Edit: Tampilkan gambar dari server
const mode = previewImage.getAttribute('mode'); // Ganti dengan "create" untuk mode create

if (mode === "create") {
    previewImage.src = ""; // Kosongkan preview
    previewImage.style.display = 'none';
    previewImage.alt = "Belum ada gambar yang dipilih";
} else if (mode === "edit") {
    // Ambil URL gambar dari server (contoh placeholder di sini)
    previewImage.src = previewImage.getAttribute('src');
    previewImage.alt = "Gambar Awal";
}