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

<template id="appTemplate">
    <h1>{{ message }}</h1>
    <button @click="counter--">-1</button>
    <span> {{ $xp_toto(counter) ?? 0 }} </span>
    <button @click="counter++">+1</button>
    <div>
    {{ $xp_toto(counter) }}
    {{ $xp_titi(counter) }}
    </div>
    <div v-if="counter > 0">
        <xp-compo-a></xp-compo-a>
    </div>
</template>

<script type="module">
    import { createApp, defineAsyncComponent } from 'vue';

    function plugin_build (plugin) {
        // if plugin.url then load it as module
        if (plugin.url) {
            import(plugin.url).then((module) => {
                plugin.xprox = module.default;
                console.log('loaded plugin', plugin.xprox);
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
            app.config.globalProperties['$xp_' + plugin.name ] = (...params) => {
                // console.log('calling plugin', plugin, options);
                let res = null;
                if (plugin?.xprox?.activate ?? false) 
                    res = plugin.xprox.activate(...params)
                return res;
            };
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

    const appConfig = {
        template: '#appTemplate',
        data () {
            return {
                message: 'Hello Vue!',
                counter: 0
            }
        }
    };
    const app = createApp(appConfig)
    load_plugins(app);
    app.mount('#app');
</script>

```