<div id="app">
</div>

<template id="appTemplate">
    <xp-app></xp-app>
</template>

<script type="importmap">
    {
    "imports": {
        "vue": "/template/vue/vue.esm-browser.js",
        "XpGaia": "/template/vue/xp-gaia.js",
        "XpApp": "/template/vue/xp-app.js",
        "XpMap": "/template/vue/xp-map.js",
        "XpForm": "/template/vue/xp-form.js",
        "XpCrud": "/template/vue/xp-crud.js",
        "XpCalendar": "/template/vue/xp-calendar.js",
        "XpAppUser": "/template/vue/xp-app-user.js",
        "XpAppAdmin": "/template/vue/xp-app-admin.js",
        "XpAppDev": "/template/vue/xp-app-dev.js",
        "XpTest": "/template/vue/xp-test.js",
        "XpTestAsync": "/template/vue/xp-test-async.js",
        "XpcMarker": "/template/vue/xpc-marker.js",
        "XpcHud": "/template/vue/xpc-hud.js",
        "leaflet": "/template/leaflet/leaflet-src.esm.js",
        "vitelib": "/template/vue/dist/my-test.js",
        "ElementPlus": "/template/element-plus/index.full.mjs"
    }
}
</script>

<script type="module" src="/template/vue/app.js">
</script>

<template id="xp-app">
    <div>
        <h1>{{ xpv.app_title }}</h1>
        <xp-map></xp-map>
        <xp-calendar></xp-calendar>
        <xp-crud></xp-crud>
        <div v-if="xpv.user.id == 0">
            <xp-form name="register"></xp-form>
            <xp-form name="login"></xp-form>
            <xp-form name="newsletter"></xp-form>
            <xp-form name="contact"></xp-form>
        </div>
        <div v-else>
            <xp-app-user v-if="xpv.user_api_key"></xp-app-user>
            <xp-app-admin v-else-if="xpv.admin_api_key"></xp-app-admin>
            <div v-else>
                <h2>missing api key</h2>
            </div>
        </div>
        <xp-app-dev></xp-app-dev>
        <my-test-a></my-test-a>

    </div>
    <footer>
        <img class="logo" src="/template/img/gaia-b6.png" alt="gaia" />
    </footer>
</template>


<template id="xp-map">
    <div class="container-map">
        <div id="box-p5"></div>
        <div ref="map" id="map" class="box-map"></div>
        <input type="number" v-model="xpv.map_marker_index" @keyup.enter="act_marker_focus" style="text-align:right;" />
        / {{ markers_length() }}<input type="range" v-model.number="xpv.map_marker_index" min="0" :max="markers_length()">
        <button @click.prevent="act_marker_prev">👈</button>
        <button @click.prevent="act_marker_focus">👁️</button>
        <button @click.prevent="act_marker_next">👉</button>
        <span>{{ zoom }} </span><input type="range" v-model="zoom" min="0" max="18">
        <button @click.prevent="act_teleport">teleport</button>
        <input type="color" v-model="xpv.tree_color" />
        <span>{{ xpv.tree_line_w }} </span><input type="range" v-model="xpv.tree_line_w" min="0" max="10" />
        <input type="number" v-model="xpv.tree_h" /><input type="range" v-model="xpv.tree_h" min="0" max="4000" />
    </div>
</template>

<template id="xp-form">
    <div>
        <em>{{ name }}</em>
        <form v-if="form" @submit.prevent="$event => act_submit($event)">
            <label v-for="f in form.fields">
                <span>{{ f.name }}</span>
                <textarea v-if="f.type=='textarea'" rows="10" cols="80" :required="f.required" :placeholder="f.placeholder" v-model="f.value"></textarea>
                <input v-else :type="f.type" :name="f.name" :required="f.required" :placeholder="f.placeholder" v-model="f.value" />
            </label>
            <button type="submit">send</button>
        </form>
    </div>
</template>

<template id="xp-crud">
    <div class="box-crud">
        <h2>POSTS ({{ posts.length }})</h2>
        <div>
            <label>
                <span>table</span>
                <input type="checkbox" v-model="ui_table" />
            </label>
            <label>
                <span>grid</span>
                <input type="checkbox" v-model="ui_grid" />
            </label>
            <label>
                <span>dev</span>
                <input type="checkbox" v-model="ui_dev" />
            </label>
        </div>
        <div>
            {{ form_feedback?.feedback ?? '...' }}
        </div>
        <div v-if="ui_table">
            <div>
                <span>filter on created</span>
                <input type="text" v-model="filter" />
                (selection: {{ filter_ok_count(filter) }}/{{ posts.length }})
            </div>
            <table>
                <tbody>
                    <tr v-for="(p, index) in posts">
                        <template v-if="filter_ok(p)">
                            <td>{{ index }}</td>
                            <td>
                                <h3 class="filter-ok" :title="p.url">{{ p.title }}</h3>
                                <div><a target="_blank" :href="p.url">{{ p.url }}</a></div>
                                <input type="checkbox" v-model="p.expand" />
                                <div :class="media_class(p)"><img loading="lazy" :src="media_src(p)" /></div>
                            </td>
                            <td>
                                <label><span>code</span><textarea rows="10" v-model="p.code"></textarea></label>
                                <label><span>x</span><input type="text" v-model="p.x" /></label>
                                <label><span>y</span><input type="text" v-model="p.y" /></label>
                                <label><span>z</span><input type="text" v-model="p.z" /></label>
                                <label><span>created {{ txt(p.created) }}</span><input type="text" v-model="p.created"></label>
                            </td>
                            <td>
                                <button class="green" @click.prevent="act_save(p)">save ({{ p.id }})</button>
                                <button @click.prevent="act_edit(p)">edit ({{ p.id }})</button>
                                <button class="red" @click.prevent="act_delete(p)">delete ({{ p.id }})</button>
                            </td>
                        </template>
                        <template v-else>
                            <td>{{ index }}</td>
                            <td>
                                <h3 :title="p.url">{{ p.title }}</h3>
                            </td>
                            <td>
                                <label><span>created {{ txt(p.created) }}</span></label>
                                <label><span>z</span><input type="text" v-model="p.z" /></label>
                            </td>
                            <td></td>
                        </template>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="ui_grid" class="grid">
            <article v-for="p in posts">
                <h3 :title="p.url">{{ p.title }}</h3>
                <div><a target="_blank" :href="p.url">{{ p.url }}</a></div>
                <hr />
                <button @click.prevent="act_edit(p)">edit</button>
                <button @click.prevent="act_delete(p)">delete</button>
            </article>
        </div>
        <div v-if="ui_dev">
            <em>CRUD</em>
            <div><label>level: {{ size }} <input type="range" v-model="size" min="0" max="100"></label></div>
            <div><label>score: {{ score2 }} / {{ size * size }}<input type="range" v-model="score2" min="0" :max="size*size"></label></div>
            <div class="grid">
                <article v-for="a in (size*size)">
                    <h3 v-if="a <= score2">⭐️ {{ a }}</h3>
                    <div v-else>{{ a }}</div>
                    <xp-form v-if="mode_edit" name="post" :index="a-1"></xp-form>
                    <input type="checkbox" v-model="mode_edit" />
                </article>
            </div>
        </div>
    </div>
</template>

<template id="xpc-marker">
    <div class="xpc-marker" :style="get_style()">
        <h3>⭐️ {{ title }}</h3>
        <div>{{ created }}</div>
        <a target="_blank" :href="url" style="color:#ffffff;line-break:anywhere">{{ url }}</a>
        <table v-if="ui_maxi" style="width:100%;">
            <tbody>
                <tr v-for="r in 1*rows">
                    <td v-for="c in 1*cols" style="vertical-align: top;">
                        <div v-html="get_content(r, c)"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
            <hr />
            <button @click.stop="act_marker">{{ index }}</button>
            <input type="checkbox" v-model="ui_maxi" @click.stop="act_ui_maxi" />
        </div>
    </div>
</template>

<template id="xpc-hud">
    <div style="display:flex;flex-direction:column;align-items:end;">
        <div class="toolbar" style="display:flex;">
            <button @click.stop="act_mini_all">mini</button>
            <button @click.stop="act_maxi_all">maxi</button>
            <button @click.stop="act_save">save</button>
            <label>
                <span> | sketch </span>
                <input type="number" min="100" :max="p5_wmax" v-model="p5_size" @change.stop="act_sketch_size" />
                <input type="range" min="100" :max="p5_wmax" step="100" v-model="p5_size" @change.stop="act_sketch_size" />
            </label>
            <span> | grid</span><input type="checkbox" v-model="ui_grid" @click.stop="act_ui_grid" />
        </div>
        <div class="box-table" v-if="ui_grid">
            <table>
                <tbody>
                    <tr v-for="r in 10">
                        <td v-for="c in 10" :style="style_td(r,c)" @click.stop="act_td(r,c)">
                            {{ (r-1)*10 + c }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<template id="xp-calendar">
    <div class="xp-calendar grid">
        <h2 class="w100">Calendar</h2>
        <div class="w100">
            <el-button type="success" round>I am ElButton</el-button>
            <el-date-picker v-model="date_picker" type="week" format="[Week] ww" placeholder="Pick a week"></el-date-picker>
        </div>
        <el-tree class="c-1-2" :data="tree_data" draggable node-key="id"></el-tree>

        <el-collapse class="c-2-4" v-model="activeNames">
            <el-collapse-item :title="p.title" :name="index" v-for="(p, index) in posts">

                <article>
                    <template v-if="filter_ok(p)">
                        <div>{{ index }}</div>
                        <div>
                            <h3 class="filter-ok" :title="p.url">{{ p.title }}</h3>
                            <div><a target="_blank" :href="p.url">{{ p.url }}</a></div>
                            <input type="checkbox" v-model="p.expand" />
                            <div :class="media_class(p)"><img loading="lazy" :src="media_src(p)" /></div>
                        </div>
                        <div>
                            <label><span>code</span><textarea rows="10" v-model="p.code"></textarea></label>
                            <label><span>x</span><input type="text" v-model="p.x" /></label>
                            <label><span>y</span><input type="text" v-model="p.y" /></label>
                            <label><span>z</span><input type="text" v-model="p.z" /></label>
                            <label><span>created {{ txt(p.created) }}</span><input type="text" v-model="p.created"></label>
                        </div>
                        <div>
                            <button class="green" @click.prevent="act_save(p)">save ({{ p.id }})</button>
                        </div>
                    </template>
                    <template v-else>
                        <div>{{ index }}</div>
                        <div>
                            <h3 :title="p.url">{{ p.title }}</h3>
                        </div>
                        <div>
                            <label><span>created {{ txt(p.created) }}</span></label>
                            <label><span>z</span><input type="text" v-model="p.z" /></label>
                        </div>
                        <div></div>
                    </template>
                    <el-rate v-model="p.rating"></el-rate>
                </article>
                <el-upload v-model:file-list="fileList" class="upload-demo" drag multiple accept="*" :limit="3" list-type="picture-card">
                    <el-button type="primary">Click to upload</el-button>
                    <template #tip>
                        <div class="el-upload__tip">
                            jpg/png files with a size less than 500KB.
                        </div>
                    </template>
                </el-upload>
            </el-collapse-item>
        </el-collapse>



    </div>
</template>


<style>
    html,
    body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
        font-size: 16px;
    }

    * {
        box-sizing: border-box;
    }

    #app {
        text-align: center;
    }

    h1 {
        color: red;
        text-align: center;
    }

    form {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        max-width: 800px;
        margin: 0 auto;
    }

    form label {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 0.25rem;
    }

    form label span {
        display: block;
        padding: 0.5rem;
    }

    input,
    textarea {
        padding: 0.5rem;
    }

    form input,
    form textarea {
        width: 100%;
    }

    form button {
        padding: 0.5rem;
        background-color: #ddd;
        width: 50%;
        margin-top: 1rem;
    }

    .posts {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
    }

    .posts article {
        border: 1px solid #ccc;
        padding: 0.5rem;
        margin: 0.5rem;
        width: 100%;
    }

    a {
        text-decoration: none;
        color: #000;
    }

    .options ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .options ul li {
        display: inline-block;
        padding: 0.5rem;
        border: 1px solid #ccc;
        background-color: #eee;
    }

    /* media queries */
    @media (min-width: 800px) {
        .posts article {
            width: calc(100% / 2 - 1rem);
        }
    }

    @media (min-width: 1200px) {
        .posts article {
            width: calc(100% / 3 - 1rem);
        }
    }

    @media (min-width: 1600px) {
        .posts article {
            width: calc(100% / 4 - 1rem);
        }
    }

    @media (min-width: 2000px) {
        .posts article {
            width: calc(100% / 5 - 1rem);
        }
    }

    @media (min-width: 2400px) {
        .posts article {
            width: calc(100% / 6 - 1rem);
        }
    }

    .container-map {
        padding: 1rem;
    }

    .box-map {
        width: 100%;
        height: 50vmax;
    }

    .box-crud {
        padding: 1rem;
    }

    .box-crud table {
        width: 100%;
        border-collapse: collapse;
    }

    .box-crud table td {
        padding: 1vmin;
        border: 1px solid #ccc;
    }

    td h3 {
        margin: 0;
    }

    .box-crud .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        grid-gap: 1rem;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        grid-gap: 0.5rem;
    }

    .grid .w100 {
        grid-column: 1 / -1;
    }

    .grid .c-1-2 {
        grid-column: 1 / 2;
    }

    .grid .c-2-4 {
        grid-column: 2 / 4;
    }

    .grid article {
        border: 1px solid #ccc;
        padding: 0.5rem;
        margin: 0.5rem;
        width: 100%;
        aspect-ratio: 1/1;
    }

    .grid article:hover {
        background-color: #ddd;
    }

    article form {
        padding: 0;
    }

    article textarea {
        width: 100%;
        height: 100%;
        resize: none;
        padding: 0.5rem;
    }

    xpc-marker {
        border: 1px solid #ccc;
    }

    .xpc-icon {
        /* background-color: rgba(0,0,0,0.5); */
    }

    a {
        line-break: anywhere;
    }

    #box-p5 {
        border: 1px solid red;
        width: calc(100% - 2rem);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        position: absolute;
        z-index: 999;
    }

    .toolbar {
        text-align: left;
    }

    .xp-tile {
        border: 1px solid #aaaaaa;
    }

    footer .logo {
        border-radius: 50%;
        width: 100%;
        max-width: fit-content;
    }

    .box-img {
        height: 10vmin;
        width: 50vmin;
        overflow-y: hidden;
        margin: 0 auto;
    }

    .box-img.expand {
        height: 80vmin;
        width: 80vmin;
        overflow-y: scroll;
    }

    .box-img img {
        width: 100%;
    }

    td {
        vertical-align: top;
    }

    td textarea {
        min-width: 100%;
        min-height: 10vmin;
        width: 100%;
        height: 100%;
        padding: 0.5rem;
    }

    td label {
        display: block;
    }

    td label span {
        display: inline-block;
        padding: 0.25rem;
    }

    td button {
        padding: 0.5rem;
        background-color: #ddd;
        margin: 0.5rem;
    }

    td button.green {
        background-color: rgb(155, 255, 155);
    }

    td button.red {
        background-color: rgb(255, 77, 77);
    }

    .xp-calendar {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        grid-gap: 1rem;
    }
</style>

<style>
    <?php include __DIR__ . "/../element-plus/index.css" ?>
</style>