document.addEventListener("DOMContentLoaded", () => {

  document.querySelectorAll(".btnAgregar").forEach(btn => {
    btn.addEventListener("click", async (e) => {
      const form = e.target.closest("form");
      const txtOpe = form.querySelector(".txtOpe");

      const confirmar = await mostrarPopup("agregar");
      if (confirmar) {
        txtOpe.value = "a";  // Agregar
        form.submit();
      }
    });
  });

  document.querySelectorAll(".btnModificar").forEach(btn => {
    btn.addEventListener("click", async (e) => {
      const form = e.target.closest("form");
      const txtOpe = form.querySelector(".txtOpe");

      const confirmar = await mostrarPopup("modificar");
      if (confirmar) {
        txtOpe.value = "m";  // Modificar
        form.submit();
      }
    });
  });
  
  document.querySelectorAll(".btnEliminar").forEach(btn => {
    btn.addEventListener("click", async (e) => {
      const form = e.target.closest("form");
      const txtOpe = form.querySelector(".txtOpe");

      const confirmar = await mostrarPopup("eliminar");
      if (confirmar) {
        txtOpe.value = "b";  // Borrar
        form.submit();
      }
    });
  });
});

function mostrarPopup(accion) {
  return new Promise((resolve) => {
    const overlay = document.createElement('div');
    overlay.style.position = 'fixed';
    overlay.style.top = 0;
    overlay.style.left = 0;
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    overlay.style.display = 'flex';
    overlay.style.justifyContent = 'center';
    overlay.style.alignItems = 'center';
    overlay.style.zIndex = 1000;

    const popup = document.createElement('div');
    popup.style.background = '#fff';
    popup.style.padding = '20px';
    popup.style.borderRadius = '10px';
    popup.style.textAlign = 'center';
    popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';

    const message = document.createElement('p');
    if (accion === 'eliminar') {
        message.textContent = '¿Seguro que desea eliminar este contacto?';
    } else if (accion === 'modificar') {
        message.textContent = '¿Seguro que desea modificar este contacto?';
    } else if(accion === 'agregar'){
        message.textContent = '¿Seguro que desea agregar este contacto?';
    } else {
        message.textContent = '¿Está seguro de realizar esta acción?';
    }

    const buttonAceptar = document.createElement('button');
    buttonAceptar.textContent = 'Aceptar';
    buttonAceptar.style.margin = '10px';

    const buttonCancelar = document.createElement('button');
    buttonCancelar.textContent = 'Cancelar';
    buttonCancelar.style.margin = '10px';

    buttonAceptar.addEventListener('click', () => {
      document.body.removeChild(overlay);
      resolve(true);
    });

    buttonCancelar.addEventListener('click', () => {
      document.body.removeChild(overlay);
      resolve(false);
    });

    popup.appendChild(message);
    popup.appendChild(buttonAceptar);
    popup.appendChild(buttonCancelar);
    overlay.appendChild(popup);
    document.body.appendChild(overlay);
  });
}