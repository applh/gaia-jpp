# definition of functions to be used in ipynb notebooks

async def handle_request(route, request):
    # print(request.url)
    # if request is js, abort it
    if request.resource_type == "script":
        # print("Aborting request: " + request.url)
        await route.abort()
    else:
        await route.continue_()

async def read_webpage (url, tag, selector="h3"):
    from playwright.async_api import async_playwright
    playwright = await async_playwright().start()
    browser = await playwright.chromium.launch()
    page = await browser.new_page()

    # create folder my-data if not exists
    # !mkdir -p my-data

    # block js requests
    await page.route("**/*", handle_request)

    # set timeout to 5s
    await page.goto(url, timeout=5000)
    
    # save screenshot in file with timestamp ymd-his
    import datetime
    now = datetime.datetime.now()
    snow = now.strftime('%Y%m%d-%H%M%S')
    filename = f"my-data/shot-{tag}-{snow}.png"
    await page.screenshot(path=filename, full_page=True)


    # get all titles h3
    my_titles = []
    titles = await page.query_selector_all(selector)
    for title in titles:
        # add title to list
        tt = await title.inner_text()
        my_titles.append(tt)
        # print(await title.inner_text())

    # concatenate all titles in one string with separator newline
    txt_titles = ""

    for title in my_titles:
        txt_titles += title + "\n"

    # print(txt_titles)
    # build html page with titles
    html = f"""
    <html>
    <head>
    <title>News {tag}</title>
    </head>
    <body>
    <h1>News {tag}</h1>
    <pre>{txt_titles}</pre>
    </body>
    </html>
    """
    # show html page in a ipynb widget
    from IPython.display import HTML
    wid_html = HTML(html)
    display(wid_html)
    
    # save my_titles in plain file with one title per line
    with open(f"my-data/titles-{tag}-{snow}.txt", 'w') as f:
            f.write(str(txt_titles))

    # save my_titles in json file
    import json
    with open(f"my-data/titles-{tag}-{snow}.json", 'w') as f:
        json.dump(my_titles, f)


    await browser.close()
    await playwright.stop()

# show screenshot
#from IPython.display import Image
#Image(filename=filename)


