<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/template/element-plus/index.css">
    <style>
html, body {
    font-size:16px;

}
h1 {
    margin:0;
    padding: 1rem;
}
.main-panel {
    background-color: #aaa;
}
.info-panel {
    padding: 1rem;
}
    </style>
</head>
<body>
    <div id="app"></div>
    <template id="app-template">
        <div class="box-admin">
            <el-row>
                <el-col :span="8">
                    <el-avatar src="/template/img/photo.jpg"></el-avatar>
                    <em>{{ message }}</em>
                </el-col>
                <el-col :span="8">
                    <el-button type="primary">Admin</el-button>
                    <el-button type="success">Website</el-button>
                </el-col>
                <el-col :span="8">
                    <el-button type="warning">Logout</el-button>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="24" class="info-panel">
                    Welcome to your CMS admin
                </el-col>
                <el-col :span="8">
                    <el-tree :data="tree_data" @node-click="handleNodeClick" draggable show-checkbox @check-change="handleCheckChange">
                        <template #default="{ node, data }">
                            <el-row justify="end">
                                <el-col :span="12">
                                    <span>{{ node.label }}</span>
                                </el-col>
                                <el-col :span="6">
                                    <span v-if="data.total">
                                        <el-button size="small" round type="success">{{ data.total }}</el-button>
                                    </span>
                                </el-col>
                                <el-col :span="6">
                                    <span v-if="data.add">            
                                        <el-button size="small" round type="primary">add</el-button>
                                    </span>
                                </el-col>
                            </el-row>
                        </template>    
                    </el-tree>
                </el-col>
                <el-col :span="16" class="main-panel">
                    <h1 v-if="active_node">{{ active_node.label }}</h1>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="8">
                    <p>footer 1</p>
                </el-col>
                <el-col :span="8">
                    <p>footer 2</p>                    
                </el-col>
                <el-col :span="8">
                    <p>footer 3</p>                    
                </el-col>
            </el-row>
        </div>
    </template>

    <script type="importmap">
{
    "imports": {
        "vue": "/template/vue/vue.esm-browser.js",
        "ElementPlus": "/template/element-plus/index.full.mjs"
    }
}
    </script>
    <script type="module">
import { createApp} from 'vue'
import ElementPlus from 'ElementPlus'

let tree_data = [
    {
        label: 'Media',
        total: 12,
        add: 'Add',
        children: [
            {
                'label': 'January',
            },
            {
                'label': 'February',
            },
            {
                'label': 'March',
            },
            {
                'label': 'April',
            },
            {
                'label': 'May',
            },
            {
                'label': 'June',
            },
            {
                'label': 'July',
            },
            {
                'label': 'August',
            },
            {
                'label': 'September',
            },
            {
                'label': 'October',
            },
            {
                'label': 'November',
            },
            {
                'label': 'December',
            },
        ]
    },
    {
        label: 'Posts',
        total: 12,
        add: 'Add',
        children: [
            {
                'label': 'January',
            },
            {
                'label': 'February',
            },
            {
                'label': 'March',
            },
            {
                'label': 'April',
            },
            {
                'label': 'May',
            },
            {
                'label': 'June',
            },
            {
                'label': 'July',
            },
            {
                'label': 'August',
            },
            {
                'label': 'September',
            },
            {
                'label': 'October',
            },
            {
                'label': 'November',
            },
            {
                'label': 'December',
            },
        ]
    },
    {
        label: 'Pages',
        total: 2,
        add: 'Add',
        children: [
            {
                'label': 'Home',
            },
            {
                'label': 'News',
            }
        ]
    },
    {
        label: 'Templates',
        total: 3,
        add: 'Add',
        children: [
            {
                'label': 'Page',
            },
            {
                'label': 'Post',
            },
            {
                'label': 'Admin',
            },
        ]
    },
    {
        label: 'Parts',
        total: 3,
        add: 'Add',
        children: [
            {
                'label': 'Header',
            },
            {
                'label': 'Footer',
            },
            {
                'label': 'Sidebar',
            },
        ]
    },
    {
        label: 'Options',
    },
]

let methods = {
    handleCheckChange(data, checked, indeterminate) {
        console.log(data, checked, indeterminate);
    },
    handleNodeClick(data) {
        console.log(data);
        this.active_node = data;
    }
}

createApp({
    template: '#app-template',
    data() {
        return {
            message: 'Hello Admin!',
            counter: 0,
            tree_data,
            active_node: null,
        }
    },
    methods,
})
.use(ElementPlus)
.mount('#app')

    </script>

</body>
</html>