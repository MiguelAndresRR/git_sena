document.addEventListener("DOMContentLoaded", function () {
    const btnOcultarModalShow = document.querySelector("#ocultar-modal1");
    const contModalShow = document.querySelector(".container-modal-show");

    if (btnOcultarModalShow) {
        btnOcultarModalShow.addEventListener("click", (e) => {
            e.preventDefault();
            contModalShow.classList.remove("mostrar");
        });
    }

    function asignarEventosBotones() {
        document.querySelectorAll(".btn-ver").forEach((btn) => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();
                const id_producto = this.dataset.id_producto;

                console.log("Clic en .btn-ver con ID:", id_producto);

                fetch(`/admin/productos/${id_producto}`)
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("ver_nombre_producto").textContent = data.nombre_producto;
                        document.getElementById("ver_precio_producto").textContent = `$${data.precio_producto}`;
                        document.getElementById("ver_categoria_producto").textContent = data.categoria;
                        document.getElementById("ver_unidad_peso_producto").textContent = data.unidad;
                        contModalShow.classList.add("mostrar");
                    })
                    .catch((error) => console.error("Error al cargar datos:", error));
            });
        });
    }

    // Asignar al cargar por primera vez
    asignarEventosBotones();

    // Exponer globalmente para que el otro script lo llame
    window.asignarEventosBotones = asignarEventosBotones;
});
