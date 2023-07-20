import DbForm from "/assets/js/pages/DbForm.js";
import DbSettings from "/assets/js/pages/DbSettings.js";
import Smtp from "/assets/js/pages/Smtp.js";
import Admin from "/assets/js/pages/Admin.js";
export default  {
    "/install/step1": DbForm,
    "/install/step2": DbSettings,
    "/install/step3": Smtp,
    "/install/step4": Admin,
}