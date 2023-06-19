<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Vue</title>
    <style>
        html,
        body {
            font-size: 16px;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
        }

        * {
            box-sizing: border-box;
        }

        h1,
        h2,
        h3 {
            padding: 1rem;
            margin: 0;
        }

        input,
        button {
            padding: 0.5rem;
        }

        textarea {
            width: 100%;
            padding: 0.5rem;
        }

        .box-img {
            width: 100%;
            max-width: 60vw;
            height: 10vmin;
            overflow-y: auto;
        }

        li .box-img:hover {
            height: 20vmin;
        }

        img {
            width: 100%;
            object-fit: cover;
        }

        footer {
            background-color: #333;
            padding: 4rem;
        }

        .focus {
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            z-index: 100;
        }
        /* COLORS */
        h2 {
            background-color: #333;
            color: #fff;
        }
    </style>
</head>

<body>
    <div id="app">
    </div>
    <footer>

    </footer>

    <template id="appTemplate">
        <h1>{{ msg }}</h1>
        <div v-for="(wval, wkey, windex) of weeks">
            <h2>
                <span>Week {{ wkey }} (total: {{ wval.length }})</span>
                <input type="checkbox" v-model="ui.weeks[wkey]" />
            </h2>
            <ol v-if="ui.weeks[wkey]">
                <li v-for="post in wval">
                    <h3>{{ post.title }} / {{ post.ui.part2 }} / {{ post.z }} / {{ post.created.substring(5, 10) }}</h3>
                    <p><a :href="post.url" target="_blank">{{ post.url }}</a></p>
                    <form @submit.prevent="act_save(post)">
                        <input type="number" v-model="post.z" />
                        <button>SAVE ({{ post.id}})</button>
                        <textarea v-model="post.code" rows="5"></textarea>
                        <button>SAVE ({{ post.id}})</button>
                    </form>
                    <div class="box-img" @mouseover="act_image_hover">
                        <img loading="lazy" :src="'/media/zoom5/screenshot-zoom5-' + post.id + '.png'" />
                    </div>
                </li>
            </ol>
        </div>
        <div class="box-img focus">
            <img class="" ref="focus" />
        </div>
        <ol v-if="ui.posts_all">
            <li v-for="post in posts">
                <h2>{{ post.title }}</h2>
                <p>{{ post.created }}</p>
                <p>{{ post.url }}</p>
                <p>{{ post.code }}</p>
            </li>
        </ol>
    </template>
    <script type="module">
        // get week number
        function getWeek(date) {
            // Copy date so don't modify original
            date = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
            // Set to nearest Thursday: current date + 4 - current day number
            // Make Sunday's day number 7
            // date.setUTCDate(date.getUTCDate() + 4 - (date.getUTCDay()||7));
            // Get first day of year
            var yearStart = new Date(Date.UTC(date.getUTCFullYear(), 0, 1));
            // Calculate full weeks to nearest Thursday
            var weekNo = Math.ceil((((date - yearStart) / 86400000) + 1) / 7);
            // Return array of year and week number
            return weekNo;
        }

        // load vue
        import {
            createApp
        } from '/template/vue/vue.esm-browser.js';
        const app = createApp({
            template: '#appTemplate',
            data() {
                return {
                    msg: 'Hello Vue!',
                    posts: [],
                    weeks: {},
                    ui: {
                        weeks: {},
                        image_active: null,
                    }
                }
            },
            async created() {
                // console.log("created");
                let response = await fetch("/api/scraps");
                let json = await response.json();
                console.log(json);
                this.posts = json;

                // loop through posts and separate by week
                for (let post of this.posts) {
                    let date = new Date(post.created);
                    let week = getWeek(date);
                    if (!this.weeks[week]) {
                        this.weeks[week] = [];
                    }
                    this.weeks[week].push(post);

                    // add part2 info to post
                    let part2 = post.url.split("/")[5];
                    if (!post.ui) {
                        post.ui = {};
                    }   
                    post.ui.part2 = part2;
                }

                this.msg = "Welcome! (count: " + this.posts.length + ")";
            },
            methods: {
                act_image_hover(e) {
                    this.image_active = e.target.src;
                    console.log(this.image_active);
                    this.$refs.focus.src = this.image_active;
                },
                async act_save(post) {
                    console.log(post);
                    let copy = Object.assign({}, post);
                    // delete copy.ui
                    delete copy.ui;
                    let url = "/api/forms";
                    let params = {
                        "class": "zoom5",
                        "method": "update",
                        "post": copy,
                    }

                    let res = await this.xp_fetch(url, params);
                    console.log(res);
                    if (res.post) {
                        // remove post from week list
                        let week = getWeek(new Date(res.post.created));
                        let index = this.weeks[week].findIndex(x => x.id == res.post.id);
                        this.weeks[week].splice(index, 1);
                        // append post at the end of the list
                        this.weeks[week].push(post);
                    }
                },
                async xp_fetch(url, params) {

                    // make blob
                    let request_json = JSON.stringify(params)
                    let blob = new Blob([request_json], {
                        type: 'application/json'
                    })

                    let fd = new FormData()
                    fd.append('request_json', blob, 'request.json')
                    let res = await fetch(url, {
                        method: 'POST',
                        body: fd,
                    })
                    let json = await res.json()
                    return json
                }
            }
        });
        app.mount('#app');
    </script>
</body>

</html>