/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./js/frontend/FormGeneralLead.js":
/*!****************************************!*\
  !*** ./js/frontend/FormGeneralLead.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _utils__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../utils */ "./js/utils.js");


class FormGeneralLead {
  constructor() {
    const modal = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal_form_lead");
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
    const modal = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal_form_lead");
    modal.on("show.bs.modal", () => {
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-1").show();
      [2, 3, 4].map(item => {
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(`.modal-step-${item}`).hide();
      });

      // Limpiar datos
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service").trigger("reset");
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_data_lead").trigger("reset");
      jquery__WEBPACK_IMPORTED_MODULE_0___default()("#services_ids").val("");
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service .card_services").removeClass("card_selected");
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service .card_services .check_service_card").hide();
      jquery__WEBPACK_IMPORTED_MODULE_0___default()(".button_step_services").prop("disabled", true);
    });
  }
  attachStepIntroduction() {
    /* ------ Eventos para paso de Introduccion ------ */
    const buttonIntroduction = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".button_step_introduction");
    if (buttonIntroduction.length > 0) {
      buttonIntroduction.on("click", () => {
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-1").hide();
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-2").show();
      });
    }
  }
  attachStepServices() {
    /* ------ Eventos para paso de Seleccion de servicios ------ */
    const formServices = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service");
    if (formServices.length > 0) {
      formServices.on("submit", e => {
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-2").hide();
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-3").show();
        e.preventDefault();
        e.stopPropagation();

        // Crear seccion de servicios seleccionados
        const section = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".section_services_selected");
        if (section.length > 0) {
          // Obtener servicios seleccionados
          let ids = jquery__WEBPACK_IMPORTED_MODULE_0___default()("#services_ids").val();
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
              const cardForm = section.find(`.list_item_services[data-services_id=${id}]`);
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
            section.find(".summary_prices .total").text(`Desde $${min} - $${max}`);
            section.find(".summary_prices").show();

            // Mostrar seccion
            section.show();
          }
        }
      });
    }
    const cards = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service .card_services");
    if (cards.length > 0) {
      cards.on("click", e => {
        const card = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.currentTarget);

        // Agregar el check y clase css
        if (card.hasClass("card_selected")) {
          card.find(".check_service_card").hide();
          card.removeClass("card_selected");
        } else {
          card.addClass("card_selected");
          card.find(".check_service_card").show();
        }

        // Obtener cuantos ha sido seleccionados
        const selected = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service .card_services.card_selected");
        if (selected.length > 0) {
          // Habilitar el boton para seguir
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".button_step_services").prop("disabled", false);

          // Formatear los ids seleccionados
          const ids = [];
          selected.each((index, element) => {
            const id = jquery__WEBPACK_IMPORTED_MODULE_0___default()(element).data("services_id");
            if (id) {
              ids.push(id);
            }
          });

          // Setear el valor de los servicios seleccionados
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service #services_ids").val(ids.join(","));
        } else {
          // Inhabilitar el boton para seguir
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".button_step_services").prop("disabled", true);

          // Setear el valor de los servicios seleccionados
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_service #services_ids").val("");
        }
      });
    }
  }
  attachStepRecolectData() {
    /* ------ Eventos para paso de Recolectar informacion ------ */
    const formRecolect = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".form_recolect_data_lead");
    if (formRecolect.length > 0) {
      formRecolect.on("submit", async e => {
        try {
          e.preventDefault();
          e.stopPropagation();

          // Colocar loader
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".loader_submit_form_lead").show();

          // Extraer informacion general
          let payload = (0,_utils__WEBPACK_IMPORTED_MODULE_1__.converter_form_to_object)(jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.currentTarget));

          // Obtener servicios seleccionados
          let ids = jquery__WEBPACK_IMPORTED_MODULE_0___default()("#services_ids").val();

          // Agregar servicios
          payload.servicios_id = ids;

          // Guardar informacion
          const response = await (0,_utils__WEBPACK_IMPORTED_MODULE_1__.call_api_ajax)("save_form_general_lead", payload);
          if (response && response.success) {
            // Avanzar al paso de confirmacion
            jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-3").hide();
            jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal-step-4").show();
          }

          // Quitar loader
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".loader_submit_form_lead").hide();
        } catch (error) {
          console.log(error);
        }
      });
    }
  }
  attachStepConfirmation() {
    /* ------ Eventos para paso de Confirmacion ------ */
    const buttonConfirm = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".button_step_confirm");
    if (buttonConfirm.length > 0) {
      buttonConfirm.on("click", () => {
        jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal_form_lead").modal("hide");
      });
    }
  }
  attachNavegation() {
    /* ------ Eventos para la navegacion en el modal ------ */
    const buttonBack = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".button_back_step");
    if (buttonBack.length > 0) {
      buttonBack.on("click", e => {
        const element = jquery__WEBPACK_IMPORTED_MODULE_0___default()(e.currentTarget);
        const toStep = element.data("tostep");
        const step = element.data("step");
        if (step == 4 && toStep == 3) {
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(".modal_form_lead").modal("hide");
        } else {
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(`.modal-step-${step}`).hide();
          jquery__WEBPACK_IMPORTED_MODULE_0___default()(`.modal-step-${toStep}`).show();
        }
      });
    }
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (FormGeneralLead);

/***/ }),

/***/ "./js/utils.js":
/*!*********************!*\
  !*** ./js/utils.js ***!
  \*********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   apiRestUrl: () => (/* binding */ apiRestUrl),
/* harmony export */   call_api_ajax: () => (/* binding */ call_api_ajax),
/* harmony export */   converter_form_to_object: () => (/* binding */ converter_form_to_object),
/* harmony export */   siteUrl: () => (/* binding */ siteUrl)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);


/* ------ CONSTANTES O DATOS COMPATIDOS ------ */
const siteUrl = DATA_SETTINGS.site_url;
const apiRestUrl = `${siteUrl}/wp-json`;
const nonce = DATA_SETTINGS.nonce;
const apiAjaxUrl = DATA_SETTINGS.ajax_url;

/* ------ FUNCIONES O HELPERS ------ */
const call_api_ajax = (action, dataToSend = null) => {
  if (!action) {
    return;
  }

  // Agregar payload
  let data = {};
  if (dataToSend) {
    data = dataToSend;
  }

  // Agregar datos de seguridad
  data["_ajax_nonce"] = nonce;
  data["action"] = action;
  return new Promise((resolve, reject) => {
    jquery__WEBPACK_IMPORTED_MODULE_0___default().ajax({
      type: "POST",
      url: `${apiAjaxUrl}`,
      dataType: "json",
      data,
      success: data => {
        resolve(data);
      },
      error: error => {
        reject(error);
      }
    });
  });
};
const converter_form_to_object = form => {
  var arr = form.serializeArray();
  let obj = {};
  var lastPropertyName = "";
  arr.forEach(el => {
    if (!el.value || el.value === "") {
      return obj;
    }
    if (lastPropertyName === el.name) {
      obj[el.name] += `,${el.value.trim()}`;
    } else {
      obj[el.name] = el.value.trim();
    }
    lastPropertyName = el.name;
  });
  return obj;
};

/* ------ EXPORTAR ------ */


/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ ((module) => {

module.exports = window["jQuery"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!******************************!*\
  !*** ./js/frontend_child.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _frontend_FormGeneralLead__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./frontend/FormGeneralLead */ "./js/frontend/FormGeneralLead.js");



/* ------ FUNCIONES ------ */
jquery__WEBPACK_IMPORTED_MODULE_0___default()(() => {
  // Logica condicional
  new _frontend_FormGeneralLead__WEBPACK_IMPORTED_MODULE_1__["default"]();
});
})();

/******/ })()
;
//# sourceMappingURL=frontend_child.js.map