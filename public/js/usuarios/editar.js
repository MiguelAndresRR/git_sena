const btnOcultarModalEdit = document.querySelector("#ocultar-modal-editar2");
const contModalEdit = document.querySelector("#container-modal-editar2");

btnOcultarModalEdit.addEventListener("click", (e) => {
    e.preventDefault();
    contModalEdit.classList.remove("mostrar");
});

document.addEventListener("click", function (e) {
    const btn = e.target.closest("#btn-editar1");
    if (!btn) return;

    e.preventDefault();
    const id_usuario = btn.dataset.id_usuario;

    fetch(`/admin/usuarios/${id_usuario}`)
        .then((response) => response.text())
        .then((data) => {
            console.log('datos recibidos', data)
            document.getElementById("nombre_usuario").value =
                data.nombre_usuario;
            document.getElementById("apellido_usuario").value =
                data.apellido_usuario;
            document.getElementById("documento_usuario").value =
                data.documento_usuario;
            document.getElementById("telefono_usuario").value =
                data.telefono_usuario;
            document.getElementById("correo_usuario").value =
                data.correo_usuario;
            document.getElementById("user").value =
                data.user;
            document.getElementById("password").value =
                data.password;
            document.getElementById("id_rol").value =
                data.id_rol;
                
            document.getElementById("form_editar1").action = `/admin/usuarios/${id_usuario}`;
            contModalEdit.classList.add("mostrar");
        })
        .catch((error) => console.error("Error al cargar datos:", error));
});