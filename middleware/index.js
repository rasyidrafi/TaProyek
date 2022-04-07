let profile = localStorage.getItem("ta-proyek");
if (profile) profile = JSON.parse(profile);
let isLocal = false;
let baseUrl = isLocal ? "" : "https://okok.my.id/ta-kel1/";

let middleware = {
    mustLogin: () => {
        if (!profile) return window.location.href = `${baseUrl}./login.html`;
    },
    redirectIfLogin: (to = `${baseUrl}./dashboard.html`) => {
        if (profile) return window.location.href = to;
    }
}