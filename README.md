# GAIA-JPP

* GAIA: GeoCMS Artificial Intelligence Applications
* JPP: JavaScript, Python, PHP

GAIA is a CMS available in several situations:
* In a Docker container, with PHP + Python + SQLite
* As a standalone CMS, on PHP + SQLite web hosting
* As a WP plugin, on WP + MySQL + SQLite web hosting
* Mix with Laravel
* Mix with Laravel in Docker container

And also:
* Mix with Symfony (FIXME)
* Mix with Symfony in Docker container (FIXME)
  
GAIA-JPP is some crazy VSCode dev environment
* Build AI appications with JS, Python and PHP support.
  * And even WordPress + Gutenberg + React 

Automatic testing is provided by Playwright
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
* That's surprising, but Python and NodeJS still don't have a class autoload feature. 😱

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

## Why Vue ? (and not React or Angular)

* Vue made a very smart choice of using HTML templates 
  * Stay close of browser JS
  * (instead of JSX or TypeScript... 😱)
* Vue compiler can be bundled and sent to the browser.
  * Vue with compiler is about 100Kb 😎
  * (about same size as jQuery...)
* Keeping templates in HTML is a very good idea.
  * Open source is about customization.
  * Vue templates can be customized by different approaches
    * PHP dynamic templates
    * JS dynamic templates

### Async Components

* So easy to create async components
  * load component code on demand

### Vue Reactive 

* So easy to create reactive store
  * (try React Redux and simply compare... 😱)

## AI vs Human

### Human

* Human life
  * about 1.000 months
  * education
    * about 20 years
    * about 240 months
  * work
    * about 40 years
    * about 480 months
* Human annual work
  * about 1.600 hours
  * about 100.000 minutes
  * about 10.000 tasks of 10 minutes
* Human daily work
  * about 400 minutes
    * 100 = 10 + 20 + 30 + 40
    * 100 = 10 + 20 + 30 + 40
    * 100 = 10 + 20 + 30 + 40
    * 100 = 10 + 20 + 30 + 40
  * daily average of 16 tasks of 25 minutes

#### Human Developer

1 line of code per minute of work ?! 😅🤔

* Human annual work
  * about 1.600 hours
  * about 100.000 minutes
  * about 100.000 lines of code

#### Human 4x4x4 daily tasks

* Human daily work
  * about 400 minutes
    * 100 = 10 + 20 + 30 + 40
    * 100 = 10 + 20 + 30 + 40
    * 100 = 10 + 20 + 30 + 40
    * 100 = 10 + 20 + 30 + 40
  * 16 tasks per working day
* And each task can be divided in 4 sub-tasks
  * 10 = 1 + 2 + 3 + 4
  * 20 = 2 + 4 + 6 + 8
  * 30 = 3 + 6 + 9 + 12
  * 40 = 4 + 8 + 12 + 16
* 16 x 4 = 64 sub-tasks per working day

### AI 

* AI heartbeat
  * 24H: about 1.440 minutes
  * about 1.440 tasks

## HTML + Markdown template engine

A web page if the result of the combination of a page content and a page template.
Non-developers should be able to build both parts.
* Page Builder
* Template Builder

Markdown is a very simple language, and is a good choice for non-developers.
* Page content in Markdown
* Page template in Markdown

### Builder: tree of components

A web page has a strong hierarchical structure.

A web page or a template is a tree of components.
* titles h1, h2, h3, h4, h5, h6
  * implicit/explicit sections
* main = h1
* sections = h2
* columns = h3


## Installation

### Docker: Main development

* Pre-requisites
  * install Docker
    * https://docs.docker.com/engine/install/
  * install Docker Compose
    * https://docs.docker.com/compose/install/

The main application is currently in the folder `docker/container-php`
* go to [docker/container-php](docker/container-php/)

The source code is mostly in the folder `app`

```bash
cd docker/container-php
docker-compose up -d

```

* Note: `-d` means "detached mode".
  * So the command will launch as a `daemon` at each system startup.


### Docker: WordPress

* Prerequisites
  * install `wp-env`
  * https://developer.wordpress.org/block-editor/packages/packages-env/
  
from the folder `docker/container-php`
  * (technically, the folder where the file .wp-env.json is located)
  * launch the command `wp-env start`

```bash
cd docker/container-php
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