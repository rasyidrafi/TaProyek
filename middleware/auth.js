let middleware = {
    mustLogin: () => {
        if (!profile) return window.location.href = "/login";
    },
    redirectIfLogin: () => {
        if (profile) return window.location.href = "/menu";
    }
}