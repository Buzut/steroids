![Steroid's logo](https://github.com/Buzut/steroids/blob/master/public/themes/steroids/img/logo.jpg)

# World's most advanced theme for frontend developers
WordPress starter theme packed with modern tooling to make your life easier and your code more efficient.
Steroids is an opinionated WordPress starter theme built for frontend & JS developers: one command install, Less styles, ESNext, ES modules, dynamic imports, linting, npm deploy command and much more…

### What's in it?
* manages plugins and libraries with composer (can opt-out) like you would with a proper framework 💪
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
Node.js and npm are used to lint, compile and minify your code (CSS & JS), so make sure they are installed.
Make sure also that you have PHP and MySQL/MariaDB installed as well (could be usefull for WordPress!).

If you already have composer installed globally, you're all set up, otherwise you can install it locally in one command:

```bash
# Depending on your OS, I'd advise for the system package manager way
# On Debian based systems
apt install composer

# On macOS with bhomebrew
brew install composer

# On Windows with Chocolatey
# you also have the option to use an .exe installer: https://getcomposer.org/Composer-Setup.exe
choco install composer

# Or locally at the project root, on any system
curl -sS https://getcomposer.org/installer | php
```

Then you can set up your WordPress installation with composer.

```
# If you have composer globally installed
composer create-project buzut/steroids my-new-project

# If you downloaded composer locally
php composer.phar create-project buzut/steroids my-new-project
```

You then have a working WordPress install with Steroids theme into your `my-new-project` directory. If you have downloaded composer locally, move it at the root of `my-new-project` directory.

If you haven't created a database yet, you can do it in one command with the install script. It will:
* create the database for the project,
* set up WordPress admin user, email and password, project name and url.

```bash
./install.sh
<dbname> \
<title> \
<url> \
<admin_user> \
<admin_passwd> \
<admin_email> \
[<mysql user (defaults to root)>] \
[<mysql password (defaults to empty)>]
```

At last, head to the theme directory: `themes/steroids/` and run the usual `npm install`, you're all set up!

## Usage

### Configuration
All the main WordPress configuration happens in the dotenv `.env` file in the public directory. These configuration constants are then transposed to the usual [`wp-config.php`](public/wp-config.php).

This way of doing allows us to version our `wp-config` file and easily switch our configs based on the current environment (dev, staging, prod…). If you ever need new options in the wp-config file, no worries, just add it to `wp-config.php`, add the correspondig value to `.env` and commit.

You also have various theme-related options that you can easily set up via the theme [`config.php`](public/themes/steroids/config.php) config file.

### Dev commands
Processed CSS will be outputed to `styles/build/` and processed JavaScript to `scripts/build/` in the theme's directory. The version number is defined via native npm versioning (set via command line `npm version [major|minor|patch]` or in package.json) for easy cache invalidation.

* `npm run css:build:dev` to compile less files and add sourcemaps
* `npm run css:build:prod` to build, prefix and minify styles
* `npm run js:build` to compile and minify JS
* `npm run watch` to watch and automatically re-build CSS & JS during development
* `npm run compress` to pre-compress assets into Gzip & Brotli and encode images to webP
* `npm run build` to build and minify CSS & JS and compress assets

If you want to use a module from npm in your scripts, just install it with `npm install xxx --save` and require it using either commonJS or ESM syntax. `npm run wach/build` will do the rest!

Also, `livereload` is ready to be used. Just set the `IS_DEV` constant to true in the `.env` file.

Last but not least, if you want to take advantage of linting from stylelint and eslint, you'll have to install their respective plugins in your code editor.

### PHP

#### Installing dependencies
All of your work lays as usual in the theme's directory (`themes/steroids`). When you need an external library or a new plugin, just install it with composer: `composer require what_you_need`.

**If it's a library**: you just need to include the autoloader before calling a library and it'll take care of the rest.

```
// 3 here means 3 levels up, it will depend on where you're calling this from
require dirname(__DIR__, 3) . '/vendor/autoload.php';

// then call your library as you normally would.
```

**If it's a plugin**: it's listed in the plugins in your admin dashboard and you just need to activate it.

#### Steroids namespace
To avoid collisions, Steroids uses its own namespace in its functions (inc/*) files. Nothing fancy here, just prefix functions with `Steroids\`, like so `Steroids\function_name`.

If you need a reminder about namespace and how to use it, a quick read of the [official docs](https://www.php.net/manual/en/language.namespaces.basics.php) will set you up.

### JavaScript
Out of the box, you get:
* ESNext setup, ready to use the latest features (Babel)
* Possibility to use CommonJS & ESM modules with [Tree Shaking](https://en.wikipedia.org/wiki/Tree_shaking) (Rollup)
* Powerfull DOM based routing (you can load some JS files on certain pages only)
* Two JS builds: one as an ES6 module and the second one as a normal script. This allows for best performance and compatibility with the widest range of browsers as [Google explains](https://developers.google.com/web/fundamentals/primers/modules)

#### Using JS conditional loading
You know that speed is everything for the UX and SEO of your site. So why load one big JS file on all pages when you can target just the amount of JS required on a given page? That's exactly the feature unlocked by our JS router.

The modules that you'll want to be loaded dynmically are to be placed into `scripts/routes/`, then simply initialise the router, telling it which modules should load on what pages.

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
Styles use Less by default, but it should be pretty straightforward to use Sass instead. Let me know if you want to maintain a Sass version.

In addition to offering time saving utils for responsive utilities, you benefit from all the [Less awesomeness](http://lesscss.org/).

The real killer feature though, is the **conditional loading of styles**. You can target on which templates your styles are loading.

The `styles/` directory structure is as follows:

* `utils.less` are the utility functions. These are to be included at the top of the files that will use them
* `critical.less` is the file that will immediately be linked on all pages. You use it to include stylesheets that are essential on all (or most) pages (header, typography…)
* `lazy.less` is the file that will be lazy-loaded on all pages (because styles are render-blocking). You use it to include stylesheets that are used on all (or most) pages but that can be parsed after initial pageload.

The files imported by either `critical.less` or `lazy.less` are to be located into `critical/` or `lazy/` respectively. All these files will inherit the functions and variables defined in `utils.less` so you won't need to `@import` it before using its functions.

The third folder named `routes/` contains all the files that are conditionally loaded.

Subfolders can obviously be created to better sort your styles but files in these subfolders are compiled only if imported by files of their parent folder (`routes/*.less`), otherwise, they serve no purpose.

Finaly, to dynamically load stylesheets on a given template, you'll pass the stylesheet(s) slug(s) in the shape of an array as the second parameter of the `get_header` function: `get_header(null, ['slug'])`.

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

We might realise that `comments.less` contains a lot of styles and that they are at the end of the article, far under the fold. We therefore would rather have these styles loaded asynchronously. Fair enough.

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

### Assets pre-compression
CSS, JavaScript and SVG files are pre-compressed in both Brotli and Gzip so that your webserver will be able to server better compressed files even faster!

## Performance & junk removal
This theme used to do a lot to remove "junk" WordPress defaults. It still does a few things but in the end, this is better managed by a third party plugin.

In addition to remove useless stylesheets, JavaScript files and markup added by WordPress and plugins alike, one thing that can really boost load times & general performance is to unload plugins alltogether when they are not needed. You save MySQL queries, PHP processing time and polar bears 🐻‍❄️ at the same time!

Seriously, a lot of plugins are of no use on most pages:
* a form plugin running its logic, loading its styles and JS on **every page**,
* an image optimisation plugin that isn't meant for frontend but still loads on every request?

**WTF don't you think?**

For that very reason, I use [Asset CleanUp Pro](https://shareasale.com/r.cfm?b=1448730&u=2800929&m=92973&urllink=&afftrack=) on every site I build. It allows you to unload any core, theme and plugin CSS/JS site-wide or on a per-page basis. It also allows you to completely control when a plugin executes its PHP code.

There's more, it allows you to remove all useless WordPress styles, assets and markup (like image emojis, comments RSS feed etc).

Note: if you buy the plugin via the previous link, it'll buy me a coffe. That will help support my work. Also, there is a [free version](https://wordpress.org/plugins/wp-asset-clean-up/) that's nice too if you don't need the features of the Pro version.

## Git
You can initialise git with composer `composer run-script gitinit`. This will initialise a Git repo with [Git Emojis](https://github.com/Buzut/git-emojis-hook) hooks.

## Contributing
There's sure room for improvement, so feel free to hack around and submit PRs!

That would be cool for instance if we could have proper HTML emails. So if you have the skills to code HTML emails, don't hesitate to give me a helping hand!

Please just follow the style of the existing code, which is [Airbnb's style](http://airbnb.io/javascript/) with [minor modifications](public/themes/steroids/.eslintrc).

To maintain things clear and visual, please follow the [Git commit template](https://github.com/Buzut/git-emojis-hook).
