let profile = localStorage.getItem("ta-proyek");
if (profile) profile = JSON.parse(profile);

let middleware = {
    mustLogin: () => {
        if (!profile) {
            window.location.replace(`${window.location.href}login.html`);
        }
    },
    redirectIfLogin: (to = 'dashboard.html') => {
        if (profile) {
            window.location.replace(`${window.location.href}${to}`);
        }
    }
}