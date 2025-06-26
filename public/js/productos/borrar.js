document.addEventListener("click", function (e) {
    const btn = e.target.closest(".borrar-boton");
    if (!btn) return;

    const id_producto = btn.dataset.id_producto;

    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn-confirmar",
            cancelButton: "btn-cancelar",
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("formEliminar" + id_producto).submit();
        }
    });
});
