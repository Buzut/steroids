![Steroid's logo](https://github.com/Buzut/steroids/blob/master/img/logo.jpg)

Blank WordPress theme packed with modern tooling to release your creativity and productivity.

Initially based on [html5blank](http://html5blank.com), Steroids is an opinionated WordPress blank theme built for the JS developer: Less styles, ES6, ES modules, linting and npm scripts.

### What does npm do?
* bundles & compiles ES6+ JS (served via both a `script type="module"` & a basic script for older browsers)
* autoprefixes CSS properties that need to be
* builds CSS from Less files
* enforces functional sorting of CSS properties (only in IDE's stylelint linter)
* minifies and compresses (gz, br) CSS and JS
* pre-compresses theme images to webP
* watches for files updates and run build tasks on update
* manages assets versioning via npm version (just run `npm version [major|minor|patch]` to update)

## Getting Started
Node.js and npm are used to lint, compile and minify your code (CSS & JS).

In addition to these, you'll need Gzip and Brotli installed on the system to enjoy pre-compression of your assets. Gzip is already shipped with most OSes but Brotli often needs an install. Nothing complicated though:

```
# Debian-like distros
apt install brotli

# macOS
brew install brotli
```

After downloading the theme into your WordPress `themes/` directory, all you have to do is install other dependencies through npm with `npm install` and you're good to go.

Processed CSS will be outputed to `styles/main-1.0.min.css` and processed JavaScript to `scripts/main.esm-1.0.0.min.js` & `scripts/main.iife-1.0.0.min.js`. The version number, `1.0.0` in this exemple, is defined via native npm versioning (set via command line or in package.json) for easy cache invalidation.

* `npm run css:build:dev` to compile less files and add sourcemaps
* `npm run css:build:prod` to build, prefix and minify styles
* `npm run js:build` to compile and minify JS
* `npm run build` to build and minify CSS & JS
* `npm run watch` to watch and automatically re-build CSS & JS during development
* `npm run compress` to pre-compress assets into Gzip & Brotli and encode images to webP

If you want to use a module from npm in your scripts, just install it with `npm install xxx --save` and require it using either commonJS or ESM syntax. `npm run build` will do the rest!

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
* You take advantage of all the [Less awesomeness](http://lesscss.org/)

### SASS
There is currently no SASS version, but it's just a few settings to modify. If you create a SASS fork, let me know, I'll be happy to link to it.

### Git
Naming is often the hardest thing, Git commits are no exception. That's why Steroids comes with a very convenient [git commit template](https://github.com/Buzut/git-emojis-hook) that should help a lot. Feel free to remove it if you don't need it!

### PHP & WordPress functions
A handfull of pre-defined functions in `functions.php`:

* Built-in pagination
* Markdown rendering function to render Markdown in templates
* Image optimisation built-in
* And many more, just take a look at [functions.php](functions.php)

#### `steroids` prefix
Functions are prefixed by `steroids_` to avoid collision. If you want to rename them, you can do so with a project wide search and replace to replace all instances of `steroids_` by the awesome name you chose.

## Contributing
There's sure room for improvement, so feel free to hack around and submit PRs!

That would be cool for instance if we could have proper HTML emails. So if you have the skills to code HTML emails, don't hesitate to give me a helping hand!

Please just follow the style of the existing code, which is [Airbnb's style](http://airbnb.io/javascript/) with [minor modifications](.eslintrc).

To maintain things clear and visual, please follow the [Git commit template](https://github.com/Buzut/git-emojis-hook).
