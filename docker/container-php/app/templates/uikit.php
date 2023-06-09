<!DOCTYPE html>
<html>

<head>
    <title>UIKIT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/template/uikit/css/uikit.min.css" />
    <style>
        h1, h2, h3 {
            text-align: center;
        }

        .s2:nth-of-type(1) {
            background-image: url('/media/mountains.jpg');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 100%;
        }
        .s2:nth-of-type(3) {
            background-image: url('/media/sea.jpg');
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 100%;
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
    </style>
</head>

<body>
    <header>

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
            </div>
            <div class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                    </div>
                </section>

            </div>
        </section>

        <section class="s2 uk-section">
            <div class="uk-container">
                <h2>title 2</h1>
            </div>
            <div class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l" uk-scrollspy="target: [uk-img]; cls:uk-animation-slide-bottom">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.png"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.png"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.png"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-2.png"></div>
                    </div>
                </section>
            </div>
        </section>

        <section class="s2 uk-section uk-light" uk-parallax="bgy: -200" uk-scrollspy="target: [uk-img]; cls:uk-animation-slide-bottom">
            <div class="uk-container">
                <h2>title 2</h1>
            </div>
            <div class="uk-grid uk-flex-center uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-4@l">
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
                    </div>
                </section>
                <section class="uk-section">
                    <div class="uk-container">
                        <h3>title 3</h1>
                        <div class="image uk-height-medium uk-background-cover" uk-img data-src="/media/cutout-1.webp"></div>
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
</body>

</html>