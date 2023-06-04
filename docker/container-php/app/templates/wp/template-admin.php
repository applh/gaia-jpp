<div class="box-admin">
    <el-container>
        <el-header>
            <h1>{{ message }}</h1>
        </el-header>
        <el-main>
            <el-row>
                <el-col :span="24">
                    <el-tabs tab-position="left" style="" class="box-tabs">
                        <el-tab-pane label="Setup">
                            <h3>Setup</h3>
                            <el-form :model="form" @submit.prevent="act_form_submit" :label-position="'right'" label-width="80px">
                                <el-form-item label="Title">
                                    <el-input v-model="form.title"></el-input>
                                </el-form-item>
                                <el-form-item label="Code">
                                    <el-input v-model="form.code" type="textarea" :autosize="{minRows: 10, maxRows: 30 }"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-input type="submit" value="SEND"></el-input>
                                </el-form-item>
                                <el-divider></el-divider>
                                <el-form-item>
                                    <el-upload drag multiple action="/api/wp?xps-admin-action=upload">
                                        <div class="el-upload__text">
                                            <h4>(WP MEDIA)</h4> Drop file here or <em>click to upload</em>
                                        </div>
                                    </el-upload>
                                </el-form-item>
                            </el-form>
                        </el-tab-pane>
                        <el-tab-pane label="Modules">
                            <h3>Modules</h3>
                            <el-tree :data="data_tree" draggable show-checkbox @node-click="act_tree_node_click"></el-tree>
                        </el-tab-pane>
                        <el-tab-pane label="Sites">
                            <h3>Sites</h3>
                            <el-tree :data="data_tree" draggable show-checkbox @node-click="act_tree_node_click"></el-tree>
                        </el-tab-pane>
                        <el-tab-pane label="Options">
                            <h3>Options</h3>
                            <el-form :model="form" @submit.prevent="act_form_submit" :label-position="'right'" label-width="80px">
                                <el-form-item label="Title">
                                    <el-input v-model="form.title"></el-input>
                                </el-form-item>
                                <el-form-item label="Code">
                                    <el-input v-model="form.code" type="textarea" rows="10"></el-input>
                                </el-form-item>
                                <el-form-item>
                                    <el-input type="submit"></el-input>
                                </el-form-item>
                            </el-form>
                        </el-tab-pane>
                    </el-tabs>
                </el-col>
                <el-col :span="12">
                    <el-tree :data="data_tree" draggable show-checkbox @node-click="act_tree_node_click"></el-tree>
                </el-col>
                <el-col :span="12">
                    <el-tree :data="data_tree" draggable show-checkbox @node-click="act_tree_node_click"></el-tree>
                </el-col>
                <el-col :span="12">
                    <el-calendar v-model="time1"></el-calendar>

                </el-col>
            </el-row>

        </el-main>
        <el-footer>
            <el-date-picker v-model="time1" type="datetime" placeholder="Select date and time" :default-time="time1">
            </el-date-picker>
            <div>cms_mix: {{ $store().cms_mix }}</div>
            <div>xp_admin_key: {{ $store().xp_admin_key }}</div>
        </el-footer>
    </el-container>
</div>