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

        h1,
        h2,
        h3 {
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

        .toolbar {
            overflow: hidden;
            width: 100%;
            height: 0.25rem;
            padding: 0rem;
            background-color: #aaa;
        }

        p {
            margin: 0;
            padding: 0rem 1rem;
        }

        form {
            padding: 1rem;
        }

        .affix {
            float: right;
        }

        .box-msg {
            float: right;
            margin-right: 1rem;
        }

        /* ELEMENT PLUS */
        .el-collapse-item__header {
            padding-left: 1rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div id="app"></div>
    <template id="app-template">
        <div class="box-admin">
            <el-affix :offset="16" class="affix">
                <el-button type="primary">Always visible...</el-button>
                <div class="box-msg"></div>
            </el-affix>

            <el-row>
                <el-col :span="8">
                    <el-avatar src="/template/img/photo.jpg"></el-avatar>
                    <em>{{ message }}</em>
                </el-col>
                <el-col :span="8">
                    <el-button type="success"><a target="_blank" href="/">Website</a></el-button>
                </el-col>
                <el-col :span="4">
                    <el-button type="primary">Admin</el-button>
                    <el-button type="warning">Logout</el-button>
                </el-col>
                <el-col :span="4">
                    <el-switch v-model="is_mode_dev" active-text="dev"></el-switch>
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
                    <el-row>
                        <el-col :span="16">
                            <h1 v-if="active_node">{{ active_node.label }}</h1>
                        </el-col>
                        <el-col :span="8">
                            <el-rate v-model="rating" :colors="rating_colors"></el-rate>
                            <el-button type="primary" style="margin-left: 16px" @click="drawer = true">
                                more options...
                            </el-button>
                        </el-col>
                        <el-col :span="16">
                            <el-form :model="form_post" @submit.prevent="act_post" label-width="80px">
                                <el-form-item>
                                    <button type="submit">Post</button>
                                </el-form-item>
                                <el-form-item label="title">
                                    <el-input v-model="form_post.title" placeholder="title"></el-input>
                                </el-form-item>
                                <el-form-item label="content">
                                    <el-input v-model="form_post.content" :rows="30" type="textarea" placeholder="content"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-date-picker v-model="form_post.created" type="datetime" placeholder="Select date and time" :default-time="defaultTime" />
                                </el-form-item>
                                <el-form-item label="template">
                                    <el-input v-model="form_post.template" placeholder="template"></el-input>
                                </el-form-item>
                                <el-form-item label="media">
                                    <el-input v-model="form_post.media" placeholder="media"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <button type="submit">Post</button>
                                </el-form-item>
                            </el-form>
                        </el-col>
                        <el-col :span="8">
                            <el-tabs type="border-card">
                                <el-tab-pane label="User">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil iusto numquam, nobis animi nam explicabo architecto, non temporibus perferendis eum, dolorem modi. Ab corporis dicta error totam ipsum nostrum recusandae!</p>
                                    <el-color-picker v-model="color" show-alpha :predefine="color_palette"></el-color-picker>
                                    <el-progress :text-inside="true" :stroke-width="26" :percentage="slider" :color="color"></el-progress>
                                    <el-calendar v-model="defaultTime"></el-calendar>
                                </el-tab-pane>
                                <el-tab-pane label="Config">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil iusto numquam, nobis animi nam explicabo architecto, non temporibus perferendis eum, dolorem modi. Ab corporis dicta error totam ipsum nostrum recusandae!</p>
                                    <el-progress :text-inside="true" :stroke-width="24" :percentage="100" status="success"></el-progress>
                                </el-tab-pane>
                                <el-tab-pane label="Role">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil iusto numquam, nobis animi nam explicabo architecto, non temporibus perferendis eum, dolorem modi. Ab corporis dicta error totam ipsum nostrum recusandae!</p>
                                    <el-progress :text-inside="true" :stroke-width="22" :percentage="80" status="warning"></el-progress>
                                </el-tab-pane>
                                <el-tab-pane label="Task">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil iusto numquam, nobis animi nam explicabo architecto, non temporibus perferendis eum, dolorem modi. Ab corporis dicta error totam ipsum nostrum recusandae!</p>
                                    <el-progress :text-inside="true" :stroke-width="20" :percentage="50" status="exception"></el-progress>
                                </el-tab-pane>
                            </el-tabs>
                        </el-col>
                        <el-col :span="16">
                            <h3>extras</h3>
                            <el-collapse v-model="activeNames">
                                <el-collapse-item title="Consistency" name="1">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>
                                        Consistent with real life: in line with the process and logic of real
                                        life, and comply with languages and habits that the users are used to;
                                        Consistent within interface: all elements should be consistent, such
                                        as: design style, icons and texts, position of elements, etc.
                                    </p>
                                    <p>
                                        <el-progress :text-inside="true" :stroke-width="26" :percentage="70"></el-progress>
                                        <el-progress :text-inside="true" :stroke-width="24" :percentage="100" status="success"></el-progress>
                                        <el-progress :text-inside="true" :stroke-width="22" :percentage="80" status="warning"></el-progress>
                                        <el-progress :text-inside="true" :stroke-width="20" :percentage="50" status="exception"></el-progress>
                                    </p>
                                </el-collapse-item>
                                <el-collapse-item title="Feedback" name="2">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>
                                        Operation feedback: enable the users to clearly perceive their
                                        operations by style updates and interactive effects;
                                        Visual feedback: reflect current state by updating or rearranging
                                        elements of the page.
                                    </p>
                                </el-collapse-item>
                                <el-collapse-item title="Efficiency" name="3">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>
                                        Simplify the process: keep operating process simple and intuitive;
                                        Definite and clear: enunciate your intentions clearly so that the
                                        users can quickly understand and make decisions;
                                        Easy to identify: the interface should be straightforward, which helps
                                        the users to identify and frees them from memorizing and recalling.
                                    </p>
                                </el-collapse-item>
                                <el-collapse-item title="Controllability" name="4">
                                    <el-slider v-model="slider" :step="10" show-stops></el-slider>
                                    <p>
                                        Decision making: giving advices about operations is acceptable, but do
                                        not make decisions for the users;
                                        Controlled consequences: users should be granted the freedom to
                                        operate, including canceling, aborting or terminating current
                                        operation.
                                    </p>
                                </el-collapse-item>
                            </el-collapse>
                        </el-col>
                        <el-col :span="8">
                            <h3>timeline</h3>
                            <el-timeline>
                                <el-timeline-item v-for="(activity, index) in activities" :key="index" :icon="activity.icon" :type="activity.type" :color="activity.color" :size="activity.size" :hollow="activity.hollow" :timestamp="activity.timestamp">
                                    {{ activity.content }}
                                </el-timeline-item>
                            </el-timeline>
                        </el-col>

                    </el-row>

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
            <el-row class="toolbar">
                <el-col :span="8">
                    <p>footer dialog</p>
                    <el-button text @click="dialogVisible = true">
                        Click to open Login Dialog
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

                <el-col :span="8">
                    <p>footer drawer</p>
                    <el-button type="primary" style="margin-left: 16px" @click="drawer = true">
                        Click to open drawer
                    </el-button>
                    <el-drawer direction="rtl" v-model="drawer" size="40%">
                        <template #default>
                            <el-row>
                                <el-col :span="24">
                                    <h3>More Options</h3>
                                </el-col>
                                <el-col>
                                    <el-form :model="form_upload" :rules="form_rules_upload" @submit.prevent="act_upload" label-width="5rem">
                                        <el-form-item>
                                            <button type="submit">Send</button>
                                        </el-form-item>
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
                            </el-row>
                        </template>
                    </el-drawer>
                </el-col>

            </el-row>
            <el-row v-show="is_mode_dev">
                <el-col :span="8">
                    <p>footer 1</p>
                </el-col>
                <el-col :span="8">
                    <p>footer 2</p>
                    <el-form :model="form_upload" :rules="form_rules_upload" @submit.prevent="act_upload" label-width="5rem">
                        <el-form-item>
                            <button type="submit">Send</button>
                        </el-form-item>
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

            </el-row>

        </div>
        <div>
        </div>
        <el-backtop :right="16" :bottom="16" />
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
        import {
            ElMessage,
            ElNotification
        } from 'ElementPlus'

        let tree_data = [{
                'label': 'Dashboard',
            },
            {
                'label': 'Workspaces',
                total: 12,
                add: 'Add',
                children: [{
                        'label': '01 - January',
                    },
                    {
                        'label': '02 - February',
                    },
                    {
                        'label': '03 - March',
                    },
                    {
                        'label': '04 - April',
                    },
                    {
                        'label': '05 - May',
                    },
                    {
                        'label': '06 - June',
                    },
                    {
                        'label': '07 - July',
                    },
                    {
                        'label': '08 - August',
                    },
                    {
                        'label': '09 - September',
                    },
                    {
                        'label': '10 - October',
                    },
                    {
                        'label': '11 - November',
                    },
                    {
                        'label': '12 - December',
                    },
                ]
            },
            {
                'label': 'Infos',
                total: 12,
                add: 'Add',
                children: [{
                        'label': '01 - January',
                    },
                    {
                        'label': '02 - February',
                    },
                    {
                        'label': '03 - March',
                    },
                    {
                        'label': '04 - April',
                    },
                    {
                        'label': '05 - May',
                    },
                    {
                        'label': '06 - June',
                    },
                    {
                        'label': '07 - July',
                    },
                    {
                        'label': '08 - August',
                    },
                    {
                        'label': '09 - September',
                    },
                    {
                        'label': '10 - October',
                    },
                    {
                        'label': '11 - November',
                    },
                    {
                        'label': '12 - December',
                    },
                ]
            },
            {
                label: 'Media',
                total: 12,
                add: 'Add',
                children: [{
                        'label': '01 - January',
                    },
                    {
                        'label': '02 - February',
                    },
                    {
                        'label': '03 - March',
                    },
                    {
                        'label': '04 - April',
                    },
                    {
                        'label': '05 - May',
                    },
                    {
                        'label': '06 - June',
                    },
                    {
                        'label': '07 - July',
                    },
                    {
                        'label': '08 - August',
                    },
                    {
                        'label': '09 - September',
                    },
                    {
                        'label': '10 - October',
                    },
                    {
                        'label': '11 - November',
                    },
                    {
                        'label': '12 - December',
                    },
                ]
            },
            {
                label: 'Posts',
                total: 12,
                add: 'Add',
                children: [{
                        'label': '01 - January',
                    },
                    {
                        'label': '02 - February',
                    },
                    {
                        'label': '03 - March',
                    },
                    {
                        'label': '04 - April',
                    },
                    {
                        'label': '05 - May',
                    },
                    {
                        'label': '06 - June',
                    },
                    {
                        'label': '07 - July',
                    },
                    {
                        'label': '08 - August',
                    },
                    {
                        'label': '09 - September',
                    },
                    {
                        'label': '10 - October',
                    },
                    {
                        'label': '11 - November',
                    },
                    {
                        'label': '12 - December',
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
                label: 'Forms',
                total: 3,
                add: 'Add',
                children: [{
                        'label': 'Contact',
                    },
                    {
                        'label': 'Newsletter',
                    },
                    {
                        'label': 'Register',
                    },
                ]
            },
            {
                label: 'Templates',
                total: 4,
                add: 'Add',
                children: [{
                        'label': 'Page',
                    },
                    {
                        'label': 'Post',
                    },
                    {
                        'label': 'App',
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

        const activities = [{
                content: 'Custom icon',
                timestamp: '2018-04-12 20:46',
                size: 'large',
                type: 'primary',
            },
            {
                content: 'Custom color',
                timestamp: '2018-04-03 20:46',
                color: '#0bbd87',
            },
            {
                content: 'Custom size',
                timestamp: '2018-04-03 20:46',
                size: 'large',
            },
            {
                content: 'Custom hollow',
                timestamp: '2018-04-03 20:46',
                type: 'primary',
                hollow: true,
            },
            {
                content: 'Default node',
                timestamp: '2018-04-03 20:46',
            },
        ]
        let methods = {
            handleCheckChange(data, checked, indeterminate) {
                console.log(data, checked, indeterminate);
            },
            handleNodeClick(data) {
                console.log(data);
                this.active_node = data;
                // show message
                let msg_types = ['success', 'info', 'warning', 'error'];
                let msg_type = msg_types[Math.floor(Math.random() * msg_types.length)];
                ElMessage({
                    message: data.label,
                    type: msg_type,
                    showClose: true,
                    appendTo: document.querySelector('.box-msg'),
                });

                ElNotification({
                    title: data.label,
                    message: data.label,
                    type: msg_type,
                    position: 'bottom-right',
                });
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
            },
            act_post(event) {
                let form_post = event.target;
                console.log('form_post', form_post)
                if (!form_post) {
                    return;
                }
            },
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
                        drawer: false,
                        is_mode_dev: false,
                        activities,
                        activeNames: [],
                        rating: 3,
                        rating_colors: ['#FF0000', '#00FFFF', '#FFFF00'],
                        form_post: {
                            title: '',
                            content: '',
                            created: '',
                            media: '',
                            template: '',
                        },
                        defaultTime: new Date(),
                        slider: 50,
                        color: '#ff0000',
                        color_palette: ['#ff0000', '#00ff00', '#0000ff'],
                    }
                },
                methods,
            })
            .use(ElementPlus)
            .mount('#app')
    </script>

</body>

</html>