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
            "vue": "/template/vue/vue.esm-browser.js"
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

    let plugins = []

    async function plugin_build (plugin, app) {


        // load css if present
        if (plugin.css) {
            let link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = plugin.css;
            document.head.appendChild(link);
        }

        if (plugin.lib) {
            console.log('loading plugin', plugin)
            let module = await import(plugin.url)
            app.use(module.default)

        }
        else {
            // append plugin to plugins
            plugins.push(plugin)

            plugin.xprox = null;

            // if plugin.url then load it as module
            if (plugin.url) {
                let module = await import(plugin.url)
                plugin.xprox = module.default;
                console.log('loaded plugin', plugin.xprox);
                // if plugin.xprox.store is present then copy all values in plugin.store
                if (plugin.xprox.store) {
                    Object.keys(plugin.xprox.store).forEach((key) => {
                        store[key] = plugin.xprox.store[key]
                    });
                }

                // import(plugin.url).then((module) => {
                //     plugin.xprox = module.default;
                //     console.log('loaded plugin', plugin.xprox);
                //     // if plugin.xprox.store is present then copy all values in plugin.store
                //     if (plugin.xprox.store) {
                //         Object.keys(plugin.xprox.store).forEach((key) => {
                //             store[key] = plugin.xprox.store[key]
                //         });
                //     }
                // })
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
                
            };

            // add plugin to vue app
            app.use(plugin, plugin?.options ?? {});
        }

        return plugin

    }
    
    let proxy_source = {}
    let proxy_agent = new Proxy(proxy_source, {
        get: function (target, prop, receiver) {
            console.log('get', target, prop, receiver);
            // when used to trap callback then return a function
            return (...params) => {
                console.log('calling', prop, params);
                let res = null;
                // loop on plugins
                for (const plugin of plugins) {
                    // if plugin.xprox is present then call it
                    if (plugin.xprox) {
                        res = plugin.xprox?.activate(prop, ...params, store)
                    }
                }
                // return the last result
                return res;
            }
        },
        set: function (target, prop, value, receiver) {
            console.log('set', target, prop, value, receiver);
            target[prop] = value;
            return true;
        },
        apply: function (target, thisArg, argumentsList) {
            console.log('apply', target, thisArg, argumentsList);
            return 'hello proxy';
            // return target.apply(thisArg, argumentsList);
        },
    })


    let load_plugins = async function (app)
    {
        // setup store
        app.config.globalProperties[ '$s' ] ?? 
            (app.config.globalProperties[ '$s' ] = store);

        // setup proxy
        app.config.globalProperties[ '$prox' ] ?? 
            (app.config.globalProperties[ '$prox' ] = proxy_agent)

        // load all template.vue-config
        let templates = document.querySelectorAll('template.vue-config')
        
        for (const template of templates) {
            try {
                const config = JSON.parse(template.innerHTML);
                console.log(config);
                for (const plugin of config.plugins) {
                    let p = await plugin_build(plugin, app)
                }
            }
            catch (e) {
                console.error(e);
            }
        };
    }

    function toto (msg='')
    {
        console.log('toto', msg)
    }

    // warning: vue template is defined by content markdown file
    const appConfig = {
        template: '#appTemplate',
        setup () {
            console.log('setup')
            // warning: computed are not available yet
            let res = {
                toto,
            }
            // loop on plugins and copy all methods to res
            for (const plugin of plugins) {
                if (plugin.xprox?.exposes ?? false) {
                    const exposes = plugin.xprox.exposes
                    Object.keys(exposes).forEach((key) => {
                        console.log('adding method', key)
                        res[key] = exposes[key]
                    });
                }
            }
            console.log(res)
            return res
        },
        created () {
            console.log('created')            
            // warning: computed are not available yet
            // methods are available
        },
        mounted () {
            console.log('mounted')
            // warning: computed are not available yet
            // methods are available

            // proxy_agent()
            let test = proxy_agent.test
            console.log(test())

            this.toto('ca marche ?')
            // this.blabla('ca marche ?')

        },
        methods: {
            test () {
                console.log('test')
            }
        },
        computed: {
            store () {
                return store;
            }
        }
    };
    const app = createApp(appConfig)
    await load_plugins(app);
    app.mount('#app');
</script>

```