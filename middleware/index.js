let profile = localStorage.getItem("ta-proyek");
if (profile) profile = JSON.parse(profile);

let middleware = {
    mustLogin: () => {
        if (!profile) {
            window.location.replace(`login.html`);
        }
    },
    redirectIfLogin: (to = 'dashboard.html') => {
        if (profile) {
            window.location.replace(to);
        }
    },
    redirect: (to = "dashboard.html") => {
        window.location.replace(to);
    },
    logout: () => {
        localStorage.removeItem("ta-proyek");
        window.location.replace(`login.html`);
    }
}