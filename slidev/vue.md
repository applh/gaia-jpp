---
title: Vue
aspectRatio: 1 / 1
# canvasWidth: 1024
# canvasWidth: 800
# canvasWidth: 600
# canvasWidth: 512
canvasWidth: 600

download: true
# theme: default
# theme: seriph
# theme: apple-basic
theme: seriph

# transition: slide-left
htmlAttrs:
  dir: ltr
  lang: en
---

# Vue + Vite

...and their friends...

🔥 VitePress
 
🔥 Slidev

🔥 Nuxt

---

## Vue

* Vue is a progressive framework 
  * for building user interfaces
  * and single-page applications
  
* Created by `Evan You`


---

## Vue by CDN


* this is the easiest way to get started with Vue
* You only need one script tag
* Vue is available as a global variable

```html
<script type="module">

// load Vue from CDN
import { createApp } 
from 'https://unpkg.com/browse/vue@3.2.47/dist/vue.esm-browser.prod.js'

// create a Vue app
const app = createApp({})
// mount the app
app.mount('#app')

</script>
```

---

## Vite

* https://vitejs.dev/
* Vite is a NodeJS dev environment
* Vite is a build tool 
  * that provides a faster and leaner development experience 
  * for modern web projects.

* Vite is also created by `Evan You`
  
---

## VitePress 

* https://vitepress.vuejs.org/
* VitePress is a documentation tool 
  * that is built on top of Vite and Vue

---

## Slidev (Sli.dev)

* https://sli.dev/custom/
* Slidev is a presentation tool 
  * that is built on top of Vite and Vue

--- 

### Slidev: Command line

https://sli.dev/guide/install.html#slidev-build-entry

* export to static site with pdf

```bash
slidev export [your-file.md]

slidev export --dark [your-file.md]

```

### Slidev: Customization

https://sli.dev/custom/directory-structure.html

---

## Nuxt 3+

* https://nuxt.com/
* Nuxt is a framework 
  * for creating Vue applications 
  * with a server-side rendering 
  * and generating static websites

### Nuxt: Command line

* https://nuxtjs.org/docs/2.x/get-started/installation

```bash
npx nuxi@latest init nuxt-app

cd nuxt-app

yarn install

yarn dev

```
