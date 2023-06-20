<?php

// disable cache
xpa_controller::$cache_active = false;

function lorem()
{
    $lorem =
    <<<html
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Nulla vel odio vitae mag na aliquam aliquam. 
    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
    Nulla facilisi.
    il nec libero sit amet velit aliquet dictum.
    urba accumsan, nisl nec aliquam ultricies, nunc nisl aliquam nunc, id aliquam nunc nisl nec libero.
    
    html;

    echo $lorem;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="uikit template">

    <title>UIKIT</title>
    <?php xpa_html::ld_json() ?>        

    <link rel="stylesheet" href="/template/uikit/css/uikit.min.css" />
    <style>
        * {
            box-sizing: border-box;
        }

        h1,
        h2,
        h3 {
            text-align: center;
        }

        .s2:nth-of-type(1) {
            background-image: url('/media/mountains.webp');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 100%;
            background-color: #aaa;
        }

        .s2:nth-of-type(3) {
            background-image: url('/media/sea.jpg');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 100%;
            background-color: #aaa;

        }

        .uk-light h3 {
            /* stroke in red */
            text-shadow:
                1px 1px 0 #f00,
                -1px -1px 0 #f00,
                1px -1px 0 #f00,
                -1px 1px 0 #f00,
                0px 1px 0 #f00,
                0px -1px 0 #f00,
                -1px 0px 0 #f00,
                1px 0px 0 #f00;
        }

        button {
            background-color: #aaa;
            color: #fff;
            padding: 1rem;
            cursor: pointer;
        }

        section p {
            padding: 1rem;
        }

        section p:hover {
            background-color: rgba(200, 200, 200, 0.5);
            border-radius: 1rem;
        }

        section.uk-light p:hover {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 1rem;
        }

        /* COLORS */
        header {
            background-color: #f66;
        }

        /* FORMS */
        form {
            padding: 1rem;
            border: 1px solid #f66;
            border-radius: 1rem;
            display: grid;
            grid-template-columns: 1fr;
            width: 100%;
        }

        form label {
            padding: 0.5rem;
            width: 100%;
        }

        form input {
            padding: 1rem;
            width: 100%;
        }

        form textarea {
            padding: 1rem;
            width: 100%;
        }

        form button {
            padding: 1rem;
            width: 100%;
        }
    </style>
</head>

<body>
    <header class="" uk-sticky="sel-target: nav; cls-active: uk-navbar-sticky">
        <nav class="uk-navbar-container uk-navbar uk-navbar-transparent uk-flex-center uk-light">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="/">home</a>
                </li>
                <li>
                    <a href="/uikit">uikit</a>
                </li>
                <li>
                    <a href="/app">app</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="uk-section">
            <div class="uk-container">
                <h1>title 1</h1>
            </div>
        </div>
        <section class="s2 uk-section uk-light" uk-parallax="bgy: -200">
            <div class="uk-container">
                <h2>title 2</h1>
                    <p class="uk-column-1-2"><?php lorem() ?></p>
            </div>
            <div class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <p><?php lorem() ?></p>
                    </div>
                </section>

            </div>
        </section>

        <section class="s2 uk-section">
            <div class="uk-container">
                <h2>title 2</h2>
                <p class="uk-column-1-2"><?php lorem() ?></p>
                <div data-xp-form="register"></div>
            </div>
            <div class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-scrollspy="target: [uk-img]; cls:uk-animation-slide-bottom">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
            </div>
        </section>

        <section class="s2 uk-section uk-light" uk-parallax="bgy: -200" uk-scrollspy="target: [uk-img]; cls:uk-animation-slide-bottom">
            <div class="uk-container">
                <h2>title 2</h2>
                <p class="uk-column-1-2"><?php lorem() ?></p>
                <div data-xp-form="contact"></div>
            </div>
            <div uk-sortable class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
            </div>
        </section>

        <section class="s2 uk-section uk-dark" uk-parallax="bgy: -200" uk-scrollspy="target: [uk-img]; cls:uk-animation-slide-bottom">
            <div class="uk-container">
                <h2>title 2</h2>
                <p class="uk-column-1-2"><?php lorem() ?></p>
                <ce-form name="newsletter"></ce-form>
            </div>
            <div uk-sortable class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                            <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                            <p><?php lorem() ?></p>
                    </div>
                </section>
            </div>
        </section>

    </main>
    <aside>
        <ce-form></ce-form>
        <ce-form name="login"></ce-form>
        <div data-xp-form="lost-password"></div>
        <div data-xp-form="new-password"></div>

    </aside>
    <footer>
    </footer>

    <script src="/template/uikit/js/uikit.min.js"></script>
    <script src="/template/uikit/js/uikit-icons.min.js"></script>

    <div id="app"></div>
    <template id="appTemplate">
        <div class="uk-grid uk-flex-center uk-child-width-1-1">
            <div class="uk-text-center">{{ sv.name }}</div>
            <div class="uk-text-center">{{ $xp('hello') }}</div>
            <button class="uk-width-1-4" @click.prevent="sv.counter++">click {{ sv.counter }}</button>
            <xp-form v-for="fname in sv.forms_teleport" :name="fname"></xp-form>
        </div>
    </template>

    <script type="importmap">
        {
        "imports": {
            "vue": "/template/vue/vue.esm-browser.prod.js",
            "xp-store": "/template/vue/xp-store-uikit.js",
            "XpForm": "/template/vue/xp-store-form.js"
        }
    }
    </script>

    <script type="module">
        import {
            createApp
        } from 'vue'
        import store from 'xp-store'

        // create app
        const app = createApp({
            template: '#appTemplate',
            data() {
                return {
                    message: 'Hello Vue!'
                }
            },
            computed: {
                sv() {
                    return this.$storer()
                }
            },
            mounted() {
                // count the number of titles
                ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'img'].forEach(tag => {
                    let titles = document.querySelectorAll('main ' + tag)
                    console.log(tag, titles.length);
                });

                // add mutation observer on #app
                let observer = new MutationObserver(mutationRecords => {
                    // console.log('mutationRecords', mutationRecords.length);
                    mutationRecords.forEach(mutation => {
                        // type = "attributes"
                        // if style changes
                        // then attributeName = "style" if style changes

                        // type = "attributes"
                        // if class changes
                        // then attributeName = "class" if class changes

                        // type = "childList"
                        // when child nodes are updated

                        // console.log(mutation); // console.log(the changes)
                    });
                });
                observer.observe(this.$el, {
                    childList: true,
                    subtree: true,
                    attributes: true,
                    characterData: true,
                    characterDataOldValue: true
                });
                // observe sections
                let sections = document.querySelectorAll('section')
                sections.forEach(section => {
                    observer.observe(section, {
                        childList: true,
                        subtree: true,
                        attributes: true,
                        characterData: true,
                        characterDataOldValue: true
                    });
                })
            }
        })
        // use store
        app.use(store)
        // mount
        app.mount('#app')
    </script>
</body>

</html>