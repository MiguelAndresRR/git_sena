
    const btnOcultarModalCrear = document.querySelector("#ocultar-modal-crear");
    const contModalCrear = document.querySelector(".container-modal-crear");

    btnOcultarModalCrear.addEventListener("click", (e) => {
        e.preventDefault();
        contModalCrear.classList.remove("mostrar");
    });


    document.addEventListener("click", function (e) {
        const btn = e.target.closest("#crear-modal");
        if (!btn) return;

        e.preventDefault();
        contModalCrear.classList.add("mostrar");
    });