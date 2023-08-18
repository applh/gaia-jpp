from fastapi import FastAPI
import datetime
import time

# uvicorn main:app --reload
app = FastAPI()


@app.get("/")
async def root(limit: int = 100, md5: str = ''):
    now = time.time()
    today = datetime.datetime.now()

    db_path = '../my-data/db-news.sqlite'
    #db_path = './my-db-news.sqlite'

    import sqlite3
    conn = sqlite3.connect(db_path)
    c = conn.cursor()

    # READ table news
    c.execute(f"SELECT * FROM news ORDER BY id DESC LIMIT {limit}")
    rows = c.fetchall()
    count = len(rows)
    # print(rows)

    # commit the changes
    conn.commit()

    # close the connection
    conn.close()

    return {
        "now": today.strftime("%Y-%m-%d %H:%M:%S"),
        "limit": limit,
        "md5": md5,
        "total": count,
        "message": "Hello World",
        "data": rows
        }


