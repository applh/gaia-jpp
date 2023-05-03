# Welcome to [Slidev](https://github.com/slidevjs/slidev)!

To start the slide show:

- `npm install`
- `npm run dev`
- visit http://localhost:3030

Edit the [slides.md](./slides.md) to see the changes.

Learn more about Slidev on [documentations](https://sli.dev/).

## command line

https://sli.dev/guide/install.html#slidev-build-entry

```bash
# export to static site with pdf
slidev export [your-file.md]

slidev export --dark [your-file.md]


```

## mixing with vite.config.js

* some problems with base options `base: ''` in `vite.config.js
  * Playwright URL gets wrong and fails
  * ok with `base: '/dist/'`
* can use CLI also option `--base "/dist/"` if subfolder is needed


## Customize configuration

* https://sli.dev/custom/global-layers.html#example

