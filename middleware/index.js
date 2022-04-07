let profile = localStorage.getItem("ta-proyek");
if (profile) profile = JSON.parse(profile);

let middleware = {
    mustLogin: () => {
        if (!profile) return window.location.href = "/login.html";
    },
    redirectIfLogin: (to = "/dashboard.html") => {
        if (profile) return window.location.href = to;
    }
}