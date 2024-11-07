import './styles/frontend.scss'
import $ from "jquery";
import FormGeneralLead from "./frontend/FormGeneralLead";
import ServiceUrlUpdater from "./frontend/ServiceUrlUpdater";

const FE_GLOBAL_SETTINGS = {
  ...DATA_SETTINGS
};

/* ------ LOAD FUNTIONALITIES ------ */
$(() => {
  // Logica condicional
  new FormGeneralLead();
  new ServiceUrlUpdater(FE_GLOBAL_SETTINGS).updateUrlWithService();
});
