
const STAGE = "DEV";
let BASE_URL = "";
switch (STAGE) {
    case "PROD":
        BASE_URL = 'https://app.redmedicasegura.com/public/index.php/';
        break;
    case "TEST":
        BASE_URL = 'https://rms.webcorp.com.mx/public/index.php/';
        break;
    case "DEV":
        BASE_URL = 'http://localhost:8080/Pasarelas-de-pagos/public/index.php/';
        break;
    default:
        break;
}