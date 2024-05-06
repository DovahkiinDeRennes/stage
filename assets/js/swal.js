Swal.fire({
    title: '$msg', icon: '$statut', confirmButtonText: 'Confirmer'
}).then((result) => {
    if (result.isConfirmed) {
        document.location.href='index.php';}
});