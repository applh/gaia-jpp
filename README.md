# GAIA-JPP

* GAIA: GeoCMS Artificial Intelligence Applications
* JPP: JavaScript, Python, PHP

GAIA is a CMS available in several situations:
* In a Docker container, with PHP+Python+SQLite
* As a standalone CMS, on PHP+SQLite web hosting
* As a WP plugin, on WP+SQLite web hosting

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