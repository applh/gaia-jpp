# PHP+SQLITE

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

