# GAIA-JPP

GAIA with JS, Python and PHP support.

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