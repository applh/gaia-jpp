<?php

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
    <title>UIKIT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="uikit template">
    <link rel="stylesheet" href="/template/uikit/css/uikit.min.css" />
    <style>
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
                <h2>title 2</h1>
                    <p class="uk-column-1-2"><?php lorem() ?></p>
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
                <h2>title 2</h1>
                    <p class="uk-column-1-2"><?php lorem() ?></p>
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
        </div>
    </template>

    <script type="importmap">
        {
        "imports": {
            "vue": "/template/vue/vue.esm-browser.prod.js",
            "xp-store": "/template/vue/xp-store-uikit.js"
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
                [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'img' ].forEach(tag => {
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