# [WordPress HTML5 Reloaded](https://github.com/Buzut/wp-html5-reloaded)

Blank WordPress theme packed with modern tooling to release your creativity and productivity.

WH5R is based on [html5blank](http://html5blank.com), heavily lifted with opinionated tech choices (LESS styles, ES6, linting and NPM scripts), coding standard and WordPress goodies.

It takes great inspiration from [Frontend Boilerplate](https://github.com/Buzut/frontend-boilerplate/) for all the CSS/JS build parts.

### What does npm do?
- autoprefixes CSS properties that need to be
- build CSS from less files
- enforce functional sorting of css properties (only in IDE's stylelint linter)
- bundle & compiles ES6+ JS into browser compatible JS (you can `require` modules straight from npm)
- minifies CSS HTML and JS
- watch for files updates and run build tasks on update

## Getting Started with WH5R

You'll need Node.js and NPM to develop with this theme as NPM scripts are used to lint, compile and minify your code (CSS & JS).

After downloading the theme into your WordPress `themes/` directory, all you have to do is install other dependencies through npm with `npm install` and you're good to go.

Processed CSS will be outputed to `styles/main.min.css` and processed JavaScript to `scripts/main.esm.min.js` & `scripts/main.iife.min.js`.

- `npm run css:build` to build, prefix and minify CSS
- `npm run js:build` to compile and minify JS
- `npm run build` to build and minify CSS & JS
- `npm run watch` to watch and automatically re-build CSS & JS during development

If you want to use modules from NPM, just install it locally via `npm install xxx --save` and require it using commonJS syntax. `npm run build` will do the rest!

Also, if you want to take advantage of linting from stylelint and eslint, you'll have to install their respective plugins in your code editor.


## Features

### HTML5
* Basic Semantic HTML5 Markup
* W3C Valid Code Foundations
* Responsive Ready, ViewPort meta data
* Clean, neatly organised code, with PHP annotations

### JavaScript
* ES6 setup, ready to use the latest features thanks to Babel
* Possibility to use modules (Hello NPM!) thanks to Browserify
* JavaScript files enqueued using WordPress functions into wp_head

### LESS
* Media Queries framework for instant development using @media
* Stylesheet enqueued using WordPress functions into wp_head

### Preloaded Functions (functions.php)
* Enqueue Scripts functions setup
* Enqueue Styles functions setup
* Dynamic WordPress Menu Navigation Support, preloaded with 3 Dynamic menus
* Cleaned up dynamic nav output (Remove outer 'div')
* Remove all injected classes from nav items, ID's, Page ID's
* Clean link and scripts tags for purer HTML5 syntax
* Custom Post Type x1 preloaded for demonstration, supporting: Category, Tags, Post Thumbnails, Excerpts
* Dynamic Sidebar with x2 Widget Areas, and sidebar.php setup
* WordPress Thumbnail Support
* Ability to replace original uploaded image by large one (good when end user thinks a 10MB jpg is good in a webpage)
* wp_head functions stripped right down, remove excess injected junk
* All functions annotated, categorised into sections, filters, actions, shortcodes etc.
* Space for development, neatly organised code with Modules/External files

### Theme Files and Functionality
* Built in Pagination, no plugins (strips out prev + next post and gives page numbers)
* Widget Area Sidebar support, functions in place to get developing
* Custom Search Form included (searchform.php) - fully editable
* Tags support for showing Post Tags
* Category support for showing the Category of post
* Author support showing the author
* Demo Custom Page Template for expansion
