<template>
    <SelectLocaleComponent/>
    <template v-if="this.showLayout">
        <template v-if="this.authenticated">
            <div class="container">
                <el-header class="header">
                    <!-- Шапка -->
                </el-header>
                <el-row>
                    <el-col :xs="24" :sm="6" :lg="4">
                        <el-aside width="200px">
                            <el-menu
                                :default-active="activeIndex"
                                mode="vertical"
                                @select="handleMenuSelect"
                            >
                                <el-menu-item index="home">
                                    <i class="el-icon-house"></i>
                                    <span>Главная</span>
                                </el-menu-item>
                                <el-menu-item index="menu">
                                    <i class="el-icon-menu"></i>
                                    <span>Меню</span>
                                </el-menu-item>
                                <el-menu-item index="payments">
                                    <i class="el-icon-money"></i>
                                    <span>История платежей</span>
                                </el-menu-item>
                                <el-menu-item index="settings">
                                    <i class="el-icon-setting"></i>
                                    <span>Настройки</span>
                                </el-menu-item>
                                <el-menu-item index="logs">
                                    <i class="el-icon-document"></i>
                                    <span>Логи</span>
                                </el-menu-item>
                                <el-menu-item @click="logout()">
                                    <i class="el-icon-document"></i>
                                    <span>Выйти</span>
                                </el-menu-item>
                            </el-menu>
                        </el-aside>
                    </el-col>
                    <el-col :xs="24" :sm="18" :lg="20">
                        <el-main>
                            <router-view></router-view>
                        </el-main>
                    </el-col>
                </el-row>
            </div>
        </template>
        <template v-if="!this.authenticated">
            <router-view></router-view>
        </template>
    </template>
</template>
<script>
import {mapGetters, mapMutations} from 'vuex';
import {ElNotification} from "element-plus";
import SelectLocaleComponent from "../../components/SelectLocale.vue";
import config from "../../config";
    export default {
        name: 'App',
        components: {
            SelectLocaleComponent
        },
        data() {
            return {
                activeIndex: 'home',
                alert: [],
            }
        },
        created(){
            this.checkAuth()
        },
        computed: {
            ...mapGetters(['authenticated', 'showLayout'])
        },
        methods: {
            ...mapMutations(['setAuthenticated', 'setShowLayout']),
            checkAuth() {
                if (localStorage.getItem('token')) {
                    this.setAuthenticated(true);
                }
            },
            handleMenuSelect(index) {
                this.activeIndex = index;
                this.$router.push({ name: index })
            },
            logout(){
                localStorage.removeItem('token')
                axios.post(config.API_URL + 'users/logout')
                    .then(response => {
                        ElNotification({
                            message: response.data.message,
                            type: 'success',
                            showClose: false
                        })
                    })
                    .catch(error => {
                        ElNotification({
                            message: error.response.data.message,
                            type: 'error',
                            showClose: false
                        })
                    })
                this.setAuthenticated(false);
                this.$router.push({ name: 'login' })
            }
        }
    }
</script>
<style>
.el-menu{
    color: #333;
    text-align: center;
    line-height: 200px;
    min-height: 100vh;
}
 /* Шапка */
 .header {
     height: 60px;
     background-color: #333;
 }

/* Контент */
.content {
    height: 100%;
    background-color: #fff;
}

/* Адаптивность */
@media screen and (max-width: 768px) {
    .el-menu {
        display: none;
    }
    .content {
        width: 100%;
    }
}
</style>
