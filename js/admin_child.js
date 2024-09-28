import $ from "jquery";
import StepCustomization from "./admin/StepCustomization";
import CtaCustomization from "./admin/CtaCustomization";

/* ------ INITIAL MOUNT ------ */
$(() => {
  new StepCustomization();
  new CtaCustomization();
});
