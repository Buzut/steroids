![Steroid's logo](https://github.com/Buzut/steroids/blob/master/img/logo.jpg)

# World's most advanced theme for frontend developers
WordPress starter theme packed with modern tooling to make your life easier and your code more efficient.
Steroids is an opinionated WordPress starter theme built for frontend & JS developers: one command install, Less styles, ES6, ES modules, linting,  npm deploy command and much more…

### What's in it?
* bundles & compiles ESNext JavaScript (served via both a `<script type="module">` & `<script nomodule>` for older browsers) 📦
* optimises JS with tree shaking & code spliting (conditional loading & dynamic imports) 🚀
* bundles styles & autoprefixes CSS properties that need to be 💄
* optimises styles by allowing CSS dynamic loading (target specific templates) 🚀
* enforces clean JS code & functional sorting of CSS properties 💅
* minifies and compresses (gzip & brotli) CSS and JS 🏗
* pre-compresses theme images to webP 🔥
* watches for files updates and run build tasks on update ⚙️
* manages assets versioning via npm version (just run `npm version [major|minor|patch]` to update) ⏰

## Getting Started
Node.js and npm are used to lint, compile and minify your code (CSS & JS).

After downloading the theme into your WordPress `themes/` directory, all you have to do is install other dependencies through npm with `npm install` and you're good to go.

Processed CSS will be outputed to `styles/main-1.0.min.css` and processed JavaScript to `scripts/build/main-1.0.0.js` & `scripts/build/main-1.0.0.iife.js`. The version number, `1.0.0` in this exemple, is defined via native npm versioning (set via command line or in package.json) for easy cache invalidation.

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

Processed CSS will be outputed to `styles/build/` and processed JavaScript to `scripts/build/`. The version number is defined via native npm versioning (set via command line or in package.json) for easy cache invalidation.

* `npm run css:build:dev` to compile less files and add sourcemaps
* `npm run css:build:prod` to build, prefix and minify styles
* `npm run js:build` to compile and minify JS
* `npm run watch` to watch and automatically re-build CSS & JS during development
* `npm run compress` to pre-compress assets into Gzip & Brotli and encode images to webP
* `npm run build` to build and minify CSS & JS and compress assets

If you want to use a module from npm in your scripts, just install it with `npm install xxx --save` and require it using either commonJS or ESM syntax. `npm run wach/build` will do the rest!

Also, `livereload` is ready to be used. Just set the `IS_DEV` constant to true in your `wp-config.php` by adding this line `define('IS_DEV', true)`.

Last but not least, if you want to take advantage of linting from stylelint and eslint, you'll have to install their respective plugins in your code editor.

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

### Styles
Styles use Less by default, but it should be pretty straightforward to use Sass instead. LEt me know if you want to maintain a Sass version.

In addition to offering time saving utils for responsive utilities, you benefit from all the [Less awesomeness](http://lesscss.org/).

The real killer feature though, is the **conditional loading of styles**. You can target on which templates your styles are loading.

The `styles/` directory structure is as follows:

* `utils.less` are the utility functions. These are to be included at the top of the files that will use them
* `critical.less` is the file that will immediately be linked on all pages. You use it to include stylesheets that are essential on all (or most) pages (header, typography…)
* `lazy.less` is the file that will be lazy-loaded on all pages (because styles are render-blocking). You use it to include stylesheets that are used on all (or most) pages but that can be parsed after initial pageload.

The files imported by either `critical.less` or `lazy.less` are to be located into `critical/` or `lazy/` respectively. All these files will inherit the functions and variables defined in `utils.less` so you won't need to `@import` it before using it.

The third folder named `routes/` contains all the files that are conditionally loaded.

Subfolders can obviously be created to better sort your styles but files in these subfolders are parsed only if imported by first level files, otherwise, they serve no purpose.

Finaly, to dynamically load stylesheets on a given template, you'll pass the stylesheet(s) slug(s) in the shape of an array as the second parameter of the `get_header` function: `get_header(null, ['slug']).

For instance, let's say we need to import our stylesheet `styles/routes/blog.less` on our blog posts. The template responsible for these blog posts is `single.php`. So the file will start like this:

```php
<?php
defined('ABSPATH') || exit;
get_header(null, ['blog']);
```

Now let's say that we also want to import a second stylesheet that is dedicated to comments, creatively named `comments.less` (that's also used on product pages). We'll do something like the following.

```php
<?php
defined('ABSPATH') || exit;
get_header(null, ['blog', 'comments']);
```

We might realise that `comments.less` contains a lot of styles and that they are at the end of the article, so far under the fold. We therefore would rather have that styles loaded asynchronously. Fair enough.

```php
<?php
defined('ABSPATH') || exit;
get_header(null, [['name' => 'blog', 'lazy' => false], ['name' => 'comments', 'lazy' => true]]);
```

This way, the blog stylesheet will load right away, but the comments stylesheet will load after initial pageload.

Note that `'lazy' => false` is the default and can be omitted, so the following is correct and has the same effect.

```php
<?php
defined('ABSPATH') || exit;
get_header(null, [['name' => 'blog'], ['name' => 'comments', 'lazy' => true]]);
```

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

**WTF don't you think?**

For that very reason, I use [Asset CleanUp Pro](https://shareasale.com/r.cfm?b=1448730&u=2800929&m=92973&urllink=&afftrack=) on every site I build. It allows you to unload any core, theme and plugin CSS/JS site-wide or on a per-page basis. It also allows you to completely control when a plugin executes its PHP code.

There's more, it allows you to remove all useless WordPress styles, assets and markup (like image emojis, comments RSS feed etc).

Note: if you buy the plugin via the previous link, It'll buy me a coffe. That will help support my work. Also, there is a [free version](https://wordpress.org/plugins/wp-asset-clean-up/) that's nice too if you don't need the features of the Pro version.

## Contributing
There's sure room for improvement, so feel free to hack around and submit PRs!

That would be cool for instance if we could have proper HTML emails. So if you have the skills to code HTML emails, don't hesitate to give me a helping hand!

Please just follow the style of the existing code, which is [Airbnb's style](http://airbnb.io/javascript/) with [minor modifications](.eslintrc).

To maintain things clear and visual, please follow the [Git commit template](https://github.com/Buzut/git-emojis-hook).
