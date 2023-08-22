# Caddy

https://caddyserver.com/docs/getting-started

```
brew install caddy

caddy

caddy run

curl localhost:2019/load \
	-H "Content-Type: application/json" \
	-d @caddy.json

caddy start

caddy stop

caddy reload

```

## https

* https://caddyserver.com/docs/quick-starts/https
* WARNING
  * domain with TLD .test are not valid
   
```
app1-lh.test:

respond "Hello privacy"

```

## file server

```
cd public/

caddy file-server --listen :3666

caddy file-server --listen :3666 --root public/

```

* html
* css
* js
* ...


## php_fastcgi


https://caddyserver.com/docs/caddyfile/directives/php_fastcgi

```
caddy fastcgi --listen :3666 --root public/ --index index.php --php php-fpm:9000

```

