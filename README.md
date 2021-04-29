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

### One command install
This one-liner installs WordPress with the Steroids theme.

```bash
curl -fsS https://raw.githubusercontent.com/Buzut/steroids/master/install.sh | bash -s \
<dbname> \
<title> \
<url> \
<admin_user> \
<admin_passwd> \
<admin_email> \
[<locale (defaults to en_US)>] \
[<mysql user (defaults to root)>] \
[<mysql password (defaults to empty)>]
```

This executes the [install script](install.sh) that will:
* create the database for the project,
* download a new WordPress directory in your current directory,
* set up WordPress admin user, email and password, project name and url,
* finally install Steroids theme and remove default themes.

## Features

### HTML5
* HTML5 semantic markup
* W3C valid code foundations
* Responsive ready
* Clean, neatly organised code

### JavaScript
* ES6 setup, ready to use the latest features (Babel)
* Possibility to use CommonJS & ESM modules with [Tree Shaking](https://en.wikipedia.org/wiki/Tree_shaking) (Rollup)
* Powerfull DOM based routing (you can load some JS files on certain pages only)
* Two JS builds: one as an ES6 module and the second one as a normal script. This allows for best performance and compatibility with the widest range of browsers as [Google explains](https://developers.google.com/web/fundamentals/primers/modules)

#### JS conditional loading
You know that speed is everything for the UX and the SEO of your site. So why load one big JS file on all pages when you can target just the amount of JS required on a given page? That's exactly the feature unlocked by our JS router.

The modules that you'll want to be loaded dynmically are to be placed into `scripts/routes/`, then simply initialise the router, telling it which modules load on what pages.

```js
// in main.js
import router from './router'; // the router itself is a module

function domready(callback) { … }

// It is safer to call it when DOM is ready,
// or else you'd have to check for the readyness in your dynamic modules
domready(() => {
    router({
        home: 'home', // import ./routes/home.js when body has "home" class
        slider: 'home' // also import ./routes/slider.js on home
        blog: ['blog', 'single-post'], // import ./routes/blog.js when body has either "blog" or "single-post" class
    })
    .then(() => console.log('Modules loaded 🎉'))
    .catch(console.error);
});
```

Under the hood, conditional loading are nothing less than ESModule dynamic imports. Therefore, they are compatible with [all major browsers](https://caniuse.com/es6-module-dynamic-import). For those older browsers such as IE11 (if you ever want to support them), all imports will be bundled in the `nomodule` script – `main.iife.js` – that's automatically available for older browsers.

The only downside is that the file contains all the code, as these browers don't support dynamic imports, so the first download is bigger.

### Less
* Media Queries framework for instant development using `@media`
* You take advantage of all the [Less awesomeness](http://lesscss.org/)

### Sass
There is currently no Sass version, but it's just a few settings to modify. If you create a Sass fork, let me know, I'll be happy to link to it.

### Git
Naming is often the hardest thing, Git commits are no exception. That's why Steroids comes with a very convenient [git commit template](https://github.com/Buzut/git-emojis-hook) that should help a lot. Feel free to remove it if you don't need it!

### PHP & WordPress functions
A handfull of pre-defined functions:

* Built-in pagination
* Markdown rendering function to render Markdown in templates
* Image optimisation built-in
* And many more, just take a look at [config.php](config.php) & [inc/](inc/)

#### `steroids` prefix
Functions are prefixed by `steroids_` to avoid collision. If you want to rename them, you can do so with a project wide search and replace to replace all instances of `steroids_` by the awesome name you chose.

### Assets pre-compression
CSS, JavaScript and SVG files are pre-compressed in both Brotli and Gzip so that your webserver will be able to server better compressed files even faster!

### One line npm deploy
As everyone knows, `npm` is a powerfull tool. So why not take advantage of it for casual deploys? There's a sweet `deploy` command built in that simply relies on rsync to sync your local theme to your server.

To take advantage of it, just replace `YOUR_SERVER` in the npm scripts section by your server's ssh info and you're good to go!

## Performance & junk removal
This theme used to do a lot to remove "junk" WordPress defaults. It still does a few things but in the end, this is better managed by a third party plugin.

In addition to remove useless stylesheets, JavaScript files and markup added by WordPress and plugins alike, one thing that can really boost load times & general performance is to unload plugins alltogether when they are not needed. You save MySQL queries, PHP processing time and polar bears 🐻‍❄️ at the same time!

Seriously, a lot of plugins are of no use on most pages:
* a form plugin running its logic, loading its styles and JS on **every page**,
* an image optimisation plugin that isn't meant for frontend but still loads on every request?

**#WTF don't you think?**

For that very reason, I use [Asset CleanUp Pro](https://shareasale.com/r.cfm?b=1448730&u=2800929&m=92973&urllink=&afftrack=) on every site I build. It allows you to unload any core, theme and plugin CSS/JS site-wide or on a per-page basis. It also allows you to completely control when a plugin executes its PHP code.

There's more, it allows you to remove all useless WordPress styles, assets and markup (like image emojis, comments RSS feed etc).

Note: if you buy the plugin via the previous link, It'll buy me a coffe. That will help support my work. Also, there is a [free version](https://wordpress.org/plugins/wp-asset-clean-up/) that's nice too if you don't need the features of the Pro version.

## Contributing
There's sure room for improvement, so feel free to hack around and submit PRs!

That would be cool for instance if we could have proper HTML emails. So if you have the skills to code HTML emails, don't hesitate to give me a helping hand!

Please just follow the style of the existing code, which is [Airbnb's style](http://airbnb.io/javascript/) with [minor modifications](.eslintrc).

To maintain things clear and visual, please follow the [Git commit template](https://github.com/Buzut/git-emojis-hook).
