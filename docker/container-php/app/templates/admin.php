<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="/template/element-plus/index.css">
    <style>
        html,
        body {
            font-size: 16px;

        }

        h1 {
            margin: 0;
            padding: 1rem;
        }

        .main-panel {
            background-color: #aaa;
        }

        .info-panel {
            padding: 1rem;
        }

        .w100 {
            width: 100%;
        }

        .tree-row {}

        .tree-row:hover {
            border-bottom: 1px solid #aaa;
        }

        a {
            text-decoration: none;
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
                    <el-button type="success"><a target="_blank" href="/">Website</a></el-button>
                </el-col>
                <el-col :span="8">
                    <el-button type="primary">Admin</el-button>
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
                            <el-row class="w100 tree-row" justify="end">
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
                    <el-form :model="form_upload" :rules="form_rules_upload" @submit.prevent="act_upload" label-width="5rem">
                        <el-form-item label="title">
                            <el-input type="text" v-model="form_upload.title"></el-input>
                        </el-form-item>
                        <el-form-item label="file">
                            <el-upload v-model:file-list="fileList" drag multiple list-type="picture">
                                <template #tip>
                                    <div class="el-upload__tip">
                                        jpg/png files with a size less than 500KB.
                                    </div>
                                </template>
                                <el-button type="primary">Click to upload</el-button>
                            </el-upload>
                        </el-form-item>
                        <el-form-item>
                            <button type="submit">Send</button>
                        </el-form-item>
                    </el-form>
                </el-col>
                <el-col :span="8">
                    <p>footer 3</p>
                    <el-form :model="form_login" :rules="form_rules_login" @submit.prevent="act_login" label-width="5rem">
                        <el-form-item label="email">
                            <el-input type="email" v-model="form_login.email" required></el-input>
                        </el-form-item>
                        <el-form-item label="password">
                            <el-input type="password" v-model="form_login.password" show-password required></el-input>
                        </el-form-item>
                        <el-form-item>
                            <button type="submit">login</button>
                        </el-form-item>
                    </el-form>
                </el-col>
                <el-col :span="8">
                    <p>footer 4</p>
                    <el-button text @click="dialogVisible = true">
                        Click to open Dialog
                    </el-button>

                    <el-dialog v-model="dialogVisible" title="Login" width="30%" draggable>
                        <el-form :model="form_login" :rules="form_rules_login" @submit.prevent="act_login" label-width="5rem">
                            <el-form-item label="email">
                                <el-input type="email" v-model="form_login.email" required></el-input>
                            </el-form-item>
                            <el-form-item label="password">
                                <el-input type="password" v-model="form_login.password" show-password required></el-input>
                            </el-form-item>
                            <el-form-item>
                                <button type="submit">login</button>
                            </el-form-item>
                        </el-form>
                    </el-dialog>
                </el-col>
            </el-row>
        </div>
        <div>
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
        import {
            createApp
        } from 'vue'
        import ElementPlus from 'ElementPlus'

        let tree_data = [{
                'label': 'Dashboard',
            },
            {
                'label': 'Workspaces',
                total: 12,
                add: 'Add',
                children: [{
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
                'label': 'Infos',
                total: 12,
                add: 'Add',
                children: [{
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
                label: 'Media',
                total: 12,
                add: 'Add',
                children: [{
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
                children: [{
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
                children: [{
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
                children: [{
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
                children: [{
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
                'label': 'Users',
                total: 1,
                add: 'Add',
                children: [{
                    'label': 'admin',
                }, ]
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
            },
            async act_login(event) {
                let form_login = event.target;
                console.log('form_login', form_login)
                if (!form_login) {
                    return;
                }

                // FIXME: needs async validator
                // https://github.com/yiminghe/async-validator
                // await form_login.validate((valid, fields) => {
                //     if (valid) {
                //         console.log('form_login', form_login)
                //     } else {
                //         console.log('error submit!!', fields);
                //         return false;
                //     }
                // });

            },
            act_upload(event) {
                let form_upload = event.target;
                console.log('form_upload', form_upload)
                if (!form_upload) {
                    return;
                }
            }
        }

        createApp({
                template: '#app-template',
                data() {
                    return {
                        message: 'Hello Admin!',
                        counter: 0,
                        tree_data,
                        active_node: tree_data[0],
                        form_login: {
                            email: '',
                            password: '',
                        },
                        form_rules_login: {
                            email: [{
                                    required: true,
                                    message: 'Please input email',
                                    trigger: 'blur'
                                },
                                {
                                    type: 'email',
                                    message: 'Please input correct email',
                                    trigger: ['blur', 'change']
                                }
                            ],
                            password: [{
                                    required: true,
                                    message: 'Please input password',
                                    trigger: 'blur'
                                },
                                {
                                    min: 6,
                                    message: 'Password length must be greater than 6',
                                    trigger: 'blur'
                                }
                            ]
                        },
                        form_upload: {
                            title: '',
                            file: '',
                        },
                        form_rules_upload: {
                            title: [{
                                required: true,
                                message: 'Please input title',
                                trigger: 'blur'
                            }, ],
                            file: [{
                                required: true,
                                message: 'Please input file',
                                trigger: 'blur'
                            }, ]
                        },
                        fileList: [],
                        dialogVisible: true,
                    }
                },
                methods,
            })
            .use(ElementPlus)
            .mount('#app')
    </script>

</body>

</html>