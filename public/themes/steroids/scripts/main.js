import router from './router';

function domready(callback) {
    if (document.readyState !== 'loading') callback();
    else document.addEventListener('DOMContentLoaded', callback);
}

domready(() => {
    router({
        home: 'home', // import ./routes/home.js when body has "home" class
        blog: ['blog', 'single-post'], // import ./routes/blog.js when body has either "blog" or "single-post" class
        slider: ['home', 'blog'] // import ./routes/slider.js on home and blog
    })
    .catch(console.error);
});
