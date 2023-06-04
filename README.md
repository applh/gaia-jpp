# GAIA-JPP

* GAIA: GeoCMS Artificial Intelligence Applications
* JPP: JavaScript, Python, PHP

GAIA is a CMS available in several situations:
* In a Docker container, with PHP+Python+SQLite
* As a standalone CMS, on PHP+SQLite web hosting
* As a WP plugin, on WP+SQLite web hosting
* Mix with Laravel
* Mix with Laravel in Docker container
  
* GAIA-JPP is some crazy VSCode dev environment
* Build AI appications with JS, Python and PHP support.
  * And even WordPress + Gutenberg + React 

* Automatic testing is provided by Playwright
* 3D is powered by Blender


## Docker container

* The Docker container provides an environment with PHP, Python and SQLite. 
* PHP provides web server services
* Python includes Jupyter Notebook, Playwright, OpenCV and SQLite
* SQLite provides a very simple database, shared by PHP and Python
* ffmpeg and imagemagick provides image and video processing

## Why PHP ? (and not NodeJS or Python)

Using PHP for GAIA allows to mix GAIA with other frameworks and CMS

### Class autoloader

PHP has a very powerful feature: the class autoload mechanism.

* https://www.php.net/manual/en/function.spl-autoload-register.php

The autoload feature allows to organize the code in class files, and to load them on demand. 

* No import or require is needed.
* This is where PHP is better than Python or NodeJS.
* That's surprising, but Python and NodeJS still don't have a class autoload feature.

Class autoloader can be very flexible and opens new features
* class code stored in .zip archives
* class code stored in databases 
  * (SQLite, MySQL, PostgreSQL, ...)
* class code stored on remote servers
  * (HTTP, FTP, ...)
  
### PHP ecosystem

* PHP is the most popular language for web servers. 
  * 75%-80% of websites
  * https://w3techs.com/technologies/history_overview/programming_language/ms/y
* PHP has a very large ecosystem, with many libraries, frameworks and CMS.
* WordPress, Laravel, Symfony
  * WordPress is +43% of websites

## Installation

### wp

```
cd wp
wp-env start
```

### vite

```
yarn create vite
```

* install in vite/docs

```
yarn add -D vitepress

npm run docs:dev

```

* install playwright

```

yarn create playwright

```

```
Inside that directory, you can run several commands:

  yarn playwright test
    Runs the end-to-end tests.

  yarn playwright test --ui
    Starts the interactive UI mode.

  yarn playwright test --project=chromium
    Runs the tests only on Desktop Chrome.

  yarn playwright test example
    Runs the tests in a specific file.

  yarn playwright test --debug
    Runs the tests in debug mode.

  yarn playwright codegen
    Auto generate tests with Codegen.

We suggest that you begin by typing:

    yarn playwright test



npx playwright test -g "test"



```


### playwright

* add playwright

```
npm i -D playwright
```

* launch test with nodejs

```
node test.js
````

```test.js

// https://playwright.dev/docs/library
import { chromium, devices } from 'playwright';

(async () => {
  const browser = await chromium.launch();
  // Create pages, interact with UI elements, assert values
  await browser.close();
})();
```

### WordPress + Gutenberg

* https://developer.wordpress.org/block-editor/getting-started/create-block/
* In your plugin folder

```shell
npx @wordpress/create-block myblock --template @wordpress/create-block-tutorial-template

```

```txt
Done: WordPress plugin Myblock bootstrapped in the myblock directory.

You can run several commands inside:

  $ npm start
    Starts the build for development.

  $ npm run build
    Builds the code for production.

  $ npm run format
    Formats files.

  $ npm run lint:css
    Lints CSS files.

  $ npm run lint:js
    Lints JavaScript files.

  $ npm run plugin-zip
    Creates a zip file for a WordPress plugin.

  $ npm run packages-update
    Updates WordPress packages to the latest version.

To enter the directory type:

  $ cd myblock

You can start development with:

  $ npm start

Code is Poetry
```