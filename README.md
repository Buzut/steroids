# [Steroids](https://github.com/Buzut/steroids)

Blank WordPress theme packed with modern tooling to release your creativity and productivity.

Initially based on [html5blank](http://html5blank.com), Steroids is an opinionated WordPress blank theme built for the JS developer: Less styles, ES6, ES modules, linting and npm scripts.

It takes great inspiration from [Frontend Boilerplate](https://github.com/Buzut/frontend-boilerplate/) for all the CSS/JS build parts.

### What does npm do?
- bundles & compiles ES6+ JS (served via both a `script type="module"` & a basic script for older browsers)
- autoprefixes CSS properties that need to be
- builds CSS from Less files
- enforces functional sorting of CSS properties (only in IDE's stylelint linter)
- minifies and compresses (gz, br) CSS and JS
- watches for files updates and run build tasks on update

## Getting Started
Node.js and npm are used to lint, compile and minify your code (CSS & JS).

In addition to these, you'll need Gzip and Brotli installed on the system to enjoy pre-compression of your assets. Gzip is already shipped with most OSes but Brotli needs an install. Nothing complicated though:

```
# Debian-like distros
apt install brotli

# macOS
brew install brotli
```

After downloading the theme into your WordPress `themes/` directory, all you have to do is install other dependencies through npm with `npm install` and you're good to go.

Processed CSS will be outputed to `styles/main.min.css` and processed JavaScript to `scripts/main.esm.min.js` & `scripts/main.iife.min.js`.

- `npm run css:build:dev` to compile less files and add sourcemaps
- `npm run css:build:prod` to build, prefix and minify styles
- `npm run js:build` to compile and minify JS
- `npm run build` to build and minify CSS & JS
- `npm run watch` to watch and automatically re-build CSS & JS during development

If you want to use a module from npm, just install it with `npm install xxx --save` and require it using either commonJS or ESM syntax. `npm run build` will do the rest!

Also, if you want to take advantage of linting from stylelint and eslint, you'll have to install their respective plugins in your code editor.

## Features

### HTML5
* HTML5 semantic markup
* W3C valid code foundations
* Responsive ready
* Clean, neatly organised code

### JavaScript
* ES6 setup, ready to use the latest features (Babel)
* Possibility to use CommonJS & ESM modules (Rollup)
* Two JS builds: one as an ES6 module and the second one as a normal script. This allows for best performance and compatibility with the widest range of browsers as [Google explains](https://developers.google.com/web/fundamentals/primers/modules).

### LESS
* Media Queries framework for instant development using `@media`
* Stylesheet enqueued using WordPress functions into `wp_head`
* You take advantage of all the [Less awesomeness](http://lesscss.org/)

Though for the Sass guys out there, don't hesitate to fork a make a Sass version, I'll be happy to link to it.

### PHP & WordPress functions
A handfull of pre-defined functions in `functions.php`:
* Built-in pagination
* Image optimisation built-in
* And many more, just take a look at [functions.php](functions.php)

#### `steroids` prefix
Functions are prefixed by `steroids_` to avoid collision. If you want to rename them, you can do so with a project wide search and replace to replace all instances of `steroids_` by the awesome name you chose.
