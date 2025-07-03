document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("filtro-form");

    function filtro() {
        const formData = new FormData(form);
        const params = new URLSearchParams(formData).toString();

        fetch(`/admin/productos?${params}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((res) => res.text())
            .then((html) => {
                document.getElementById("tabla-productos").innerHTML = html;

                if (typeof window.asignarEventosBotones === "function") {
                    console.log("Reasignando eventos a .btn-ver");
                    window.asignarEventosBotones();
                } else {
                    console.warn("No se encontró window.asignarEventosBotones");
                }
            });
    }

    form.addEventListener("change", filtro);

    document.getElementById("buscar").addEventListener("input", () => {
        clearTimeout(window.searchTimer);
        window.searchTimer = setTimeout(filtro, 50);
    });

    document.getElementById("limpiar-filtros").addEventListener("click", function () {
        form.reset();
        filtro();
    });

    document.addEventListener("click", function (e) {
        if (e.target.matches(".pagination a")) {
            e.preventDefault();
            const url = e.target.getAttribute("href");

            fetch(url, {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            })
                .then((res) => res.text())
                .then((html) => {
                    document.getElementById("tabla-productos").innerHTML = html;

                    if (typeof window.asignarEventosBotones === "function") {
                        console.log("Reasignando eventos a .btn-ver (paginación)");
                        window.asignarEventosBotones();
                    }
                });
        }
    });
});
