document.addEventListener("DOMContentLoaded", () => {
    const btnAbrirModal = document.querySelector("#crear-modal");
    const btnCerrarModal = document.querySelector("#ocultar-modal-crear1");
    const contModal = document.querySelector(".container-modal-crear");

    // Abre el modal
    if (btnAbrirModal) {
        btnAbrirModal.addEventListener("click", (e) => {
            e.preventDefault();
            contModal.classList.add("mostrar");
            console.log("✅ Modal abierto");
        });
    }

    // Cierra el modal
    if (btnCerrarModal) {
        btnCerrarModal.addEventListener("click", (e) => {
            e.preventDefault();
            contModal.classList.remove("mostrar");
            console.log("✅ Modal cerrado");
        });
    }
});
