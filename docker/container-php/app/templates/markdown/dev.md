# dev

## head

```html

<style>
    html, body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        width: 100%;
        height: 100%;
    }
    body * {
        box-sizing: border-box;
    }
    h1 {
        text-align: center;
        margin: 0;
        padding: 1rem;
    }
</style>

<script type="importmap">
    {
        "imports": {
            "vue": "/template/vue/vue.esm-browser.prod.js"
        }
    }
</script>

```

## body

```html

<div id="app"></div>


<script type="module">
    import { createApp, defineAsyncComponent, reactive } from 'vue';

    // central store for all components
    let store = reactive({
    });

    function plugin_build (plugin) {
        plugin.xprox = null;

        // if plugin.url then load it as module
        if (plugin.url) {
            import(plugin.url).then((module) => {
                plugin.xprox = module.default;
                console.log('loaded plugin', plugin.xprox);
                // if plugin.xprox.store is present then copy all values in plugin.store
                if (plugin.xprox.store) {
                    Object.keys(plugin.xprox.store).forEach((key) => {
                        store[key] = plugin.xprox.store[key];
                    });
                }
            })
        }

        // add install method to plugin
        plugin.install = (app, options) => {
            console.log('installing plugin', plugin, options);

            // register async component xp-form
            plugin?.async_components?.forEach((component) => {
                console.log('registering component', component);
                app.component(component.name, defineAsyncComponent(() =>
                    import(component.url)
                ))
            });

            // warning: can be called for each refresh
            app.config.globalProperties['$' + plugin.name ] = (...params) => {
                // console.log('calling plugin', plugin, options);
                let res = null;
                if (plugin?.xprox?.activate ?? false) 
                    res = plugin.xprox.activate(...params, store)
                return res;
            };
             
            app.config.globalProperties[ '$s' ] ?? 
                (app.config.globalProperties[ '$s' ] = store);
        };

        // add plugin to vue app
        app.use(plugin, plugin?.options ?? {});
    }
    
    function load_plugins (app)
    {
        // load all template.vue-config
        document.querySelectorAll('template.vue-config').forEach((template) => {
            try {
                const config = JSON.parse(template.innerHTML);
                console.log(config);
                config?.plugins.forEach(plugin_build)            
            }
            catch (e) {
                console.error(e);
            }
        });
    }

    // warning: vue template is defined by content markdown file
    const appConfig = {
        template: '#appTemplate',
        computed: {
            store () {
                return store;
            }
        }
    };
    const app = createApp(appConfig)
    load_plugins(app);
    app.mount('#app');
</script>

```