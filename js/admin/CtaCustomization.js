import $ from "jquery";

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
    $(".color_picker").wpColorPicker();
  }

  buildSelectLocation() {
    const locationCta = $(".setting_location_cta");
    if (locationCta.length > 0) {
      locationCta.select2({ placeholder: "----Selecciona una opción----" });
    }
  }
}

export default CtaCustomization;
