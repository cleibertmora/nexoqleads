import $ from "jquery";

class StepCustomization {
  constructor() {
    this.attachEventUploadImage();
  }

  attachEventUploadImage() {
    $("body").on("click", ".upload_single_image", function (event) {
      event.preventDefault();

      // Obtener el elemento
      const button = $(this);

      // Obtener imagen id
      const imageId = button.next().next().val();
      let attachment;

      // Configuracion de wp media
      const customUploader = wp.media({
        title: "Insertar imagen",
        multiple: false,
        library: {
          type: "image",
        },
        button: {
          text: "Usar imagen",
        },
      });

      // Logica cuando se seleccione una imagen
      customUploader.on("select", () => {
        attachment = customUploader.state().get("selection").first().toJSON();
        button.removeClass("btn-outline-primary");
        button.addClass("border-0");
        button
          .removeClass("btn")
          .html(
            '<img src="' +
              attachment.url +
              '" class="img-fluid image_preview_upload">'
          );
        button.next().show();
        button.next().next().val(attachment.id);
      });

      // Logica cuando se abre el modal de media
      customUploader.on("open", () => {
        if (!imageId) {
          return;
        }

        const selection = customUploader.state().get("selection");
        attachment = wp.media.attachment(imageId);
        attachment.fetch();
        selection.add(attachment ? [attachment] : []);
      });

      // Abrir el modal de media
      customUploader.open();
    });

    $("body").on("click", ".upload_single_remove", function (event) {
      event.preventDefault();

      // Obtener el elemento
      const button = $(this);

      // Limpiar el valor de la imagen
      button.next().val("null");

      // Agregar clases css al boton
      button
        .hide()
        .prev()
        .removeClass("border-0")
        .addClass("btn btn-outline-primary").html(`
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-upload" viewBox="0 0 16 16">
                <path
                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                <path
                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
              </svg>
              Subir imagen
            `);
    });
  }
}

export default StepCustomization;
