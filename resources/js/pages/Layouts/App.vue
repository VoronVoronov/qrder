<template>
    <template v-if="this.authenficated">
        <div class="common-layout">
            <el-container>
                <el-aside width="200px">Aside</el-aside>
                <el-main><router-view></router-view></el-main>
            </el-container>
        </div>
    </template>
    <template v-if="!this.authenficated">
        <router-view></router-view>
    </template>
</template>
<script>
    export default {
        name: 'App',
        data() {
            return {
                authenficated: false,
            }
        },
        created(){
            this.checkAuth()
        },
        methods: {
            checkAuth() {
                if (localStorage.getItem('token')) {
                    this.authenficated = true
                }
            }
        }
    }
</script>
<style>
.el-aside{
    background-color: #d3dce6;
    color: #333;
    text-align: center;
    line-height: 200px;
    min-height: 100%;
}
</style>
