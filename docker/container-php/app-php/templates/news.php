<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">home</a></li>
                <li><a href="/news">news</a></li>
                <li><a href="/app">app</a></li>
                <li><a href="/admin">admin</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>NEWS</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur at tempora mollitia labore sequi libero quam aspernatur quos nesciunt adipisci aperiam dignissimos possimus, excepturi, et dicta veritatis enim ipsum consequuntur.</p>
        <section>
            <h2>latest news</h2>
            <?php view::read() ?>
        </section>
    </main>
    <footer>
        <p>all rights reserved / 2023</p>
    </footer>

    <script type="module" src="site.js"></script>
</body>
</html>