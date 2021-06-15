/**
 * Import modules based on body class
 * @param { Object } routes
 * @returns { Promise }
 */
export default function router(routes) {
    const [bodyEl] = document.getElementsByTagName('body');
    const promises = [];

    Object.keys(routes).forEach((route) => {
        if (Array.isArray(routes[route])) {
            routes[route].forEach((className) => {
                if (bodyEl.classList.contains(className)) {
                    promises.push(import(`./routes/${route}.js`));
                }
            });
        }

        else if (bodyEl.classList.contains(routes[route])) {
            promises.push(import(`./routes/${route}.js`));
        }
    });

    return Promise.all(promises);
}
