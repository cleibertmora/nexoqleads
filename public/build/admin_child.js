/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./js/admin/CtaCustomization.js":
/*!**************************************!*\
  !*** ./js/admin/CtaCustomization.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class CtaCustomization {
  constructor() {
    this.initialConfig();
  }
  initialConfig() {
    try {
      this.buildSelectLocation();
      this.buildColorPicker();
    } catch (error) {
      console.log(error);
    }
  }
  buildColorPicker() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()(".color_picker").wpColorPicker();
  }
  buildSelectLocation() {
    const locationCta = jquery__WEBPACK_IMPORTED_MODULE_0___default()(".setting_location_cta");
    if (locationCta.length > 0) {
      locationCta.select2({
        placeholder: "----Selecciona una opción----"
      });
    }
  }
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (CtaCustomization);

/***/ }),

/***/ "./js/admin/StepCustomization.js":
/*!***************************************!*\
  !*** ./js/admin/StepCustomization.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);

class StepCustomization {
  constructor() {
    this.attachEventUploadImage();
  }
  attachEventUploadImage() {
    jquery__WEBPACK_IMPORTED_MODULE_0___default()("body").on("click", ".upload_single_image", function (event) {
      event.preventDefault();

      // Obtener el elemento
      const button = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this);

      // Obtener imagen id
      const imageId = button.next().next().val();
      let attachment;

      // Configuracion de wp media
      const customUploader = wp.media({
        title: "Insertar imagen",
        multiple: false,
        library: {
          type: "image"
        },
        button: {
          text: "Usar imagen"
        }
      });

      // Logica cuando se seleccione una imagen
      customUploader.on("select", () => {
        attachment = customUploader.state().get("selection").first().toJSON();
        button.removeClass("btn-outline-primary");
        button.addClass("border-0");
        button.removeClass("btn").html('<img src="' + attachment.url + '" class="img-fluid image_preview_upload">');
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
    jquery__WEBPACK_IMPORTED_MODULE_0___default()("body").on("click", ".upload_single_remove", function (event) {
      event.preventDefault();

      // Obtener el elemento
      const button = jquery__WEBPACK_IMPORTED_MODULE_0___default()(this);

      // Limpiar el valor de la imagen
      button.next().val("null");

      // Agregar clases css al boton
      button.hide().prev().removeClass("border-0").addClass("btn btn-outline-primary").html(`
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
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (StepCustomization);

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
/*!***************************!*\
  !*** ./js/admin_child.js ***!
  \***************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _admin_StepCustomization__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./admin/StepCustomization */ "./js/admin/StepCustomization.js");
/* harmony import */ var _admin_CtaCustomization__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./admin/CtaCustomization */ "./js/admin/CtaCustomization.js");




/* ------ INITIAL MOUNT ------ */
jquery__WEBPACK_IMPORTED_MODULE_0___default()(() => {
  new _admin_StepCustomization__WEBPACK_IMPORTED_MODULE_1__["default"]();
  new _admin_CtaCustomization__WEBPACK_IMPORTED_MODULE_2__["default"]();
});
})();

/******/ })()
;
//# sourceMappingURL=admin_child.js.map