# [WordPress HTML5 Reloaded](https://github.com/Buzut/wp-html5-reloaded)

Blank WordPress theme packed with modern tooling to release your creativity and productivity.

WH5R is based on [html5blank](http://html5blank.com), heavily lifted with opinionated tech choices (LESS styles, ES6, linting and npm scripts), coding standard and WordPress goodies.

It takes great inspiration from [Frontend Boilerplate](https://github.com/Buzut/frontend-boilerplate/) for all the CSS/JS build parts.

### What does npm do?
- autoprefixes CSS properties that need to be
- build CSS from Less files
- enforce functional sorting of CSS properties (only in IDE's stylelint linter)
- bundle & compiles ES6+ JS into browser compatible JS (you can `require` modules straight from npm)
- minifies CSS, HTML and JS
- watch for files updates and run build tasks on update

## Getting Started with WH5R
Node.js and npm are used to lint, compile and minify your code (CSS & JS).

In addition to these, you'll need Gzip and Brotli installed on the system to enjoy pre-compression of your assets. Gzip is already shipped with most OS but Brotli needs an install. Nothing complicated though:

```
# Debian-like distros
apt install brotli

# macOS
brew install brotli
```

After downloading the theme into your WordPress `themes/` directory, all you have to do is install other dependencies through npm with `npm install` and you're good to go.

Processed CSS will be outputed to `styles/main.min.css` and processed JavaScript to `scripts/main.esm.min.js` & `scripts/main.iife.min.js`.

- `npm run css:build` to build, prefix and minify CSS
- `npm run js:build` to compile and minify JS
- `npm run build` to build and minify CSS & JS
- `npm run watch` to watch and automatically re-build CSS & JS during development

If you want to use modules from npm, just install it locally via `npm install xxx --save` and require it using commonJS syntax. `npm run build` will do the rest!

Also, if you want to take advantage of linting from stylelint and eslint, you'll have to install their respective plugins in your code editor.

## Features

### HTML5
* Basic Semantic HTML5 Markup
* W3C Valid Code Foundations
* Responsive Ready, ViewPort meta data
* Clean, neatly organised code, with PHP annotations

### JavaScript
* ES6 setup, ready to use the latest features (Babel)
* Possibility to use CommonJS & ESM modules (Rollup)
* Two JS builds: one as a module for modern browsers and the second one as a normal script

### LESS
* Media Queries framework for instant development using `@media`
* Stylesheet enqueued using WordPress functions into `wp_head`

### PHP & WordPress functions
A handfull of pre-defined functions in `functions.php`:
* Built-in pagination
* Image optimisation built-in
* And many more, just take a look at [functions.php](functions.php)
