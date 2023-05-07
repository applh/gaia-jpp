let template = `
<div class="box_user">
    <h2>welcome user ({{ xpv.user.id }})</h2>
    <div>
        <h3>menu</h3>
        <nav class="options">
            <ul>
                <li><a href="#/action1">action1</a></li>
                <li><a href="#/action1">action2</a></li>
                <li><a href="#/logout" @click.prevent="act_logout()">logout</a></li>
            </ul>
        </nav>
    </div>
    <div>
        <h3>your recent posts</h3>
        <div v-if="xpv.user.posts" class="posts">
            <article v-for="p in xpv.user.posts">
                <h4><a href="#">{{ p.title }}</a></h4>
                <p>{{ p.content }}</p>
            </article>
        </div>
    </div>
    <div>
        <h3>options</h3>
        <nav class="options">
            <ul>
                <li><a href="#/option1">option1</a></li>
                <li><a href="#/option2">potion2</a></li>
            </ul>
        </nav>
    </div>
</div>
`

let computed = {
    xpv () {
        return this.$xpv()
    }
}

let methods = {
    act_logout () {
        this.$xp('logout')
    }
}

export default {
    template,
    computed,
    methods
}

