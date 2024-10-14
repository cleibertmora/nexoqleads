import $ from "jquery";
import { call_api_ajax, converter_form_to_object } from "../utils";

class FormGeneralLead {
  constructor() {
    const modal = $(".modal_form_lead");
    if (modal.length > 0) {
      this.attachEventStepModals();
    }
  }

  attachEventStepModals() {
    /* ------ Eventos para el modal ------ */
    this.attachEventInitModal();

    /* ------ Eventos para paso de Introduccion ------ */
    this.attachStepIntroduction();

    /* ------ Eventos para paso de Seleccion de servicios ------ */
    this.attachStepServices();

    /* ------ Eventos para paso de Recolectar informacion ------ */
    this.attachStepRecolectData();

    /* ------ Eventos para paso de Confirmacion ------ */
    this.attachStepConfirmation();

    /* ------ Eventos para la navegacion en el modal ------ */
    this.attachNavegation();
  }

  attachEventInitModal() {
    /* ------ Eventos para el modal ------ */
    const modal = $(".modal_form_lead");
    modal.on("show.bs.modal", () => {
      $(".modal-step-1").show();
      [2, 3, 4].map((item) => {
        $(`.modal-step-${item}`).hide();
      });

      // Limpiar datos
      $(".form_recolect_service").trigger("reset");
      $(".form_recolect_data_lead").trigger("reset");
      $("#services_ids").val("");
      $(".form_recolect_service .card_services").removeClass("card_selected");
      $(".form_recolect_service .card_services .check_service_card").hide();
      $(".button_step_services").prop("disabled", true);
    });
  }

  attachStepIntroduction() {
    /* ------ Eventos para paso de Introduccion ------ */
    const buttonIntroduction = $(".button_step_introduction");
    if (buttonIntroduction.length > 0) {
      buttonIntroduction.on("click", () => {
        $(".modal-step-1").hide();
        $(".modal-step-2").show();
      });
    }
  }

  attachStepServices() {
    /* ------ Eventos para paso de Seleccion de servicios ------ */
    const formServices = $(".form_recolect_service");
    if (formServices.length > 0) {
      formServices.on("submit", (e) => {
        $(".modal-step-2").hide();
        $(".modal-step-3").show();

        e.preventDefault();
        e.stopPropagation();

        // Crear seccion de servicios seleccionados
        const section = $(".section_services_selected");
        if (section.length > 0) {
          // Obtener servicios seleccionados
          let ids = $("#services_ids").val();

          if (ids) {
            // Procesar
            ids = ids.split(",");

            // Ocultar todos
            section.find(`.list_item_services[data-services_id]`).hide();

            // Rango total
            let min = 0;
            let max = 0;

            // Mostrar unicamente los seleccionados
            ids.map((id, index) => {
              // Buscar item en la tabla
              const cardForm = section.find(
                `.list_item_services[data-services_id=${id}]`
              );

              if (cardForm.length > 0) {
                // Mostrar item en la tabla
                cardForm.show();

                // Asignar index en la tabla
                cardForm.find(`.index_table`).text(index + 1);

                // Sumar para resumen
                const range = cardForm.find(".range_prices").text();
                const rangeArray = range.match(/\d+/g);
                if (rangeArray && rangeArray.length === 2) {
                  min += Number(rangeArray[0]);
                  max += Number(rangeArray[1]);
                }
              }
            });

            // Setear el total en resumen
            section
              .find(".summary_prices .total")
              .text(`Desde $${min} - $${max}`);
            section.find(".summary_prices").show();

            // Mostrar seccion
            section.show();
          }
        }
      });
    }

    const cards = $(".form_recolect_service .card_services");
    if (cards.length > 0) {
      cards.on("click", (e) => {
        const card = $(e.currentTarget);

        // Agregar el check y clase css
        if (card.hasClass("card_selected")) {
          card.find(".check_service_card").hide();
          card.removeClass("card_selected");
        } else {
          card.addClass("card_selected");
          card.find(".check_service_card").show();
        }

        // Obtener cuantos ha sido seleccionados
        const selected = $(
          ".form_recolect_service .card_services.card_selected"
        );
        if (selected.length > 0) {
          // Habilitar el boton para seguir
          $(".button_step_services").prop("disabled", false);

          // Formatear los ids seleccionados
          const ids = [];
          selected.each((index, element) => {
            const id = $(element).data("services_id");
            if (id) {
              ids.push(id);
            }
          });

          // Setear el valor de los servicios seleccionados
          $(".form_recolect_service #services_ids").val(ids.join(","));
        } else {
          // Inhabilitar el boton para seguir
          $(".button_step_services").prop("disabled", true);

          // Setear el valor de los servicios seleccionados
          $(".form_recolect_service #services_ids").val("");
        }
      });
    }
  }

  attachStepRecolectData() {
    /* ------ Eventos para paso de Recolectar informacion ------ */
    const formRecolect = $(".form_recolect_data_lead");
    if (formRecolect.length > 0) {
      formRecolect.on("submit", async (e) => {
        try {
          e.preventDefault();
          e.stopPropagation();

          // Colocar loader
          $(".loader_submit_form_lead").show();

          // Extraer informacion general
          let payload = converter_form_to_object($(e.currentTarget));

          // Obtener servicios seleccionados
          let ids = $("#services_ids").val();

          // Agregar servicios
          payload.servicios_id = ids;

          // Guardar informacion
          const response = await call_api_ajax(
            "save_form_general_lead",
            payload
          );

          if (response && response.success) {
            // Avanzar al paso de confirmacion
            $(".modal-step-3").hide();
            $(".modal-step-4").show();
          }

          // Quitar loader
          $(".loader_submit_form_lead").hide();
        } catch (error) {
          console.log(error);
        }
      });
    }
  }

  attachStepConfirmation() {
    /* ------ Eventos para paso de Confirmacion ------ */
    const buttonConfirm = $(".button_step_confirm");
    if (buttonConfirm.length > 0) {
      buttonConfirm.on("click", () => {
        $(".modal_form_lead").modal("hide");
      });
    }
  }

  attachNavegation() {
    /* ------ Eventos para la navegacion en el modal ------ */
    const buttonBack = $(".button_back_step");
    if (buttonBack.length > 0) {
      buttonBack.on("click", (e) => {
        const element = $(e.currentTarget);
        const toStep = element.data("tostep");
        const step = element.data("step");

        if (step == 4 && toStep == 3) {
          $(".modal_form_lead").modal("hide");
        } else {
          $(`.modal-step-${step}`).hide();
          $(`.modal-step-${toStep}`).show();
        }
      });
    }
  }
}

export default FormGeneralLead;
