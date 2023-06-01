import { createApp } from 'vue'
import ElementPlus from 'ElementPlus'
import { ElMessage, ElNotification } from 'ElementPlus'

import XpwAdmin from 'XpwAdmin'

let template = '#app-template';


let methods = {
    act_tree_node_click(data) {
        console.log(data);
        this.active_node = data;
        // show message
        let msg_types = ['success', 'info', 'warning', 'error'];
        let msg_type = msg_types[Math.floor(Math.random() * msg_types.length)];
        ElMessage({
            message: data.label,
            type: msg_type,
            showClose: true,
        });

        ElNotification({
            title: data.label,
            message: data.label,
            type: msg_type,
            position: 'bottom-right',
        });
    },
    async act_form_submit(event) {
        let target = event.target;
        console.log('submit', target);
        let json = await this.$api();
        console.log('json', json);

        let feedback = '';
        if (json.feedback) {
            feedback = json.feedback;
        }

        let msg_types = ['success', 'info', 'warning', 'error'];
        let msg_type = msg_types[Math.floor(Math.random() * msg_types.length)];
        ElNotification({
            title: feedback,
            message: feedback,
            type: msg_type,
            position: 'top-right',
        });
    }
}

let computed = {
    data_tree () {
        return this.$restore().data_tree
    },
    form () {
        return this.$restore().form
    }
}

createApp({
    template,
    data() {
        return {
            message: 'XP Studio',
            time1: new Date(),
        }
    },
    computed,
    methods
})
    .use(ElementPlus)
    .use(XpwAdmin)
    .mount('#app')
