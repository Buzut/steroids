function domready(callback){
    if (document.readyState !== 'loading') callback();
    else document.addEventListener('DOMContentLoaded', callback);
}

domready(() => {
    // dom is ready, your code goes here
});
