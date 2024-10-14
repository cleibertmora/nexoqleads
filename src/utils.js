import $ from "jquery";

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
    $.ajax({
      type: "POST",
      url: `${apiAjaxUrl}`,
      dataType: "json",
      data,
      success: (data) => {
        resolve(data);
      },
      error: (error) => {
        reject(error);
      },
    });
  });
};

const converter_form_to_object = (form) => {
  var arr = form.serializeArray();

  let obj = {};
  var lastPropertyName = "";

  arr.forEach((el) => {
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
export { siteUrl, apiRestUrl, call_api_ajax, converter_form_to_object };
