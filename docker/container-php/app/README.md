# GAIA CMS

* GAIA: a CMS for the future AI
* GAIA: Geocms Artificial Intelligence Applications

## MAPS HIERARCHY

* Zoom Level in maps determine the number of details to show
  * Zoom Level 0: the whole world
  * Zoom Level 1: 1/2 of the world
  * Zoom Level 2: 1/4 of the world
  * Zoom Level 3: 1/8 of the world
  * Zoom Level 4: 1/16 of the world
  * Zoom Level 5: 1/32 of the world
  * Zoom Level 6: 1/64 of the world
  * Zoom Level 7: 1/128 of the world
  * Zoom Level 8: 1/256 of the world
  * Zoom Level 9: 1/512 of the world
  * Zoom Level 10: 1/1024 of the world
  * Zoom Level 11: 1/2048 of the world
  * Zoom Level 12: 1/4096 of the world
  * ...
* AI Tasks will need to understand the human level of details needed
  * Multiple databases to coordinate

## GAIA CMS

* GAIA is built on docker container to allow easy deployment
* GAIA is built on PHP+SQLITE to allow easy deployment
* Jupyter Notebook is used to build the AI
* Python scripts are activated by Jupyter Notebooks
* Playwright is used to automate the browser
  * Eyes: GAIA can explore the web
  * Hands: GAIA can interact with the web
  * Python async API is activated inside Jupyter Notebooks




## GAIA CMS + WP

* `public/index.php` is the unique entry point for GAIA CMS
* this is easy to add a WP plugin header to declare a WP plugin
  * So GAIA can be used as a WP plugin
* Then the plugin can hook on `template_include`filter and use `public/index.php` as template
  * So GAIA can be used as a WP plugin that manage also templates ?!

### SCENARIO 1: WP as main site and Gaia as complement

* WP will handle the main site
* And then some parts of the site are left to GAIA
  * GAIA can handle the API part
  * GAIA can handle the admin part
  * GAIA can handle the blog part
  * GAIA can handle the shop part
  * GAIA can handle the forum part
  * GAIA can handle the wiki part
  * GAIA can handle the chat part
  * GAIA can handle the game part
  * GAIA can handle the social part
  * GAIA can handle the search part
  * GAIA can handle the stats part
  * GAIA can handle the ads part
  * GAIA can handle the newsletter part
  * GAIA can handle the calendar part
  * GAIA can handle the gallery part
  * GAIA can handle the video part
  * GAIA can handle the audio part
  * GAIA can handle the file part
  * GAIA can handle the map part
  * GAIA can handle the weather part
  * GAIA can handle the rss part
  * GAIA can handle the sitemap part
  * GAIA can handle the backup part
  * GAIA can handle the security part
  * GAIA can handle the seo part
  * GAIA can handle the cache part
  * GAIA can handle the performance part
  * GAIA can handle the translation part
  * GAIA can handle the migration part
  * GAIA can handle the import part
  * GAIA can handle the export part
  * GAIA can handle the maintenance part
  * GAIA can handle the monitoring part
  * GAIA can handle the logs part
  * GAIA can handle the debug part
  * GAIA can handle the tests part
  * GAIA can handle the documentation part
  * GAIA can handle the help part
  * GAIA can handle the about part
  * GAIA can handle the contact part
  * GAIA can handle the legal part
  * GAIA can handle the privacy part
  * GAIA can handle the terms part
  * GAIA can handle the cookies part
  * GAIA can handle the credits part
  * GAIA can handle the sitemap part
  * GAIA can handle the robots part
  * GAIA can handle the 404 part

### SCENARIO 2: GAIA as main site and WP as complement

* GAIA will handle the main site
* WP is available with all the plugins ecosystem

### SCENARIO 3: GAIA and WP mix

* WP and GAIA will cooperate to build pages


## DOCKER CONTAINERS

* Very surprising but docker containers can share the same folder
* GAIA CMS standalone ir running inside one docker container
* GAIA CMS as WP plugin is running inside another docker container
* Both share the folder `app` 🔥


## PHP+SQLITE

## sample my-config.php

```php
<?php

// set timezone to Europe/Paris
date_default_timezone_set("Europe/Paris");

// set tasks
// xp_task::add("test", "xp_cli::test");
xp_task::add("router", "xp_router::request");

// set routes
xp_router::add("api", "xp_page::api");
xp_router::add("index", "xp_page::index");

```

## upload file

* with curl, it's very easy to send POST request with uploaded file 
* https://reqbin.com/req/c-dot4w5a2/curl-post-file

* send file test.md by curl with form-data name="content"
  * to url http://gaia.test:8666/api 

```bash
curl -F content=@test.md http://gaia.test/api 
```

