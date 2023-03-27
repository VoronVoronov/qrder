<template>
    <div class="container">
        <el-row>
            <el-col :span="24" :md="12">
                <el-dialog
                    v-model="dialog"
                    :title="$t('users.cabinet')"
                    center
                    :close-on-click-modal="false"
                    :close-on-press-escapes="false"
                    :show-close="false"
                >
                    <el-form>
                        <el-form-item :error="this.alert.data.phone">
                            <el-input v-model="form.phone" :placeholder="$t('users.phone')" v-maska data-maska="+7 7## ###-##-##"></el-input>
                        </el-form-item>
                        <el-form-item :error="this.alert.data.password">
                            <el-input type="password" v-model="form.password" show-password :placeholder="$t('users.password')"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="success" @click="login()">{{ $t('users.sign_in')}}</el-button>
                            <el-button type="primary" @click.native="$router.push('/register')">{{ $t('users.sign_up')}}</el-button>
                        </el-form-item>
                    </el-form>
                </el-dialog>
            </el-col>
        </el-row>
    </div>
</template>
<script>
import { mapMutations } from 'vuex';
import { ElNotification } from 'element-plus'
export default {
    name: 'Login',
    data() {
        return {
            dialog: true,
            form: {
                phone: '',
                password: ''
            },
            alert: {
                data: []
            }
        }
    },
    methods: {
        ...mapMutations(['setAuthenticated']),
        login() {
            this.alert.data = []
            axios.post('/api/v1/users/login', this.form)
                .then(response => {
                    localStorage.setItem('token', response.data.data.token)
                    ElNotification({
                        message: response.data.message,
                        type: 'success',
                        showClose: false
                    })
                    setTimeout(() => {
                        this.$router.push({ name: 'dashboard' })
                        this.setAuthenticated(true);
                    }, 2000)
                })
                .catch(error => {
                    ElNotification({
                        message: error.response.data.message,
                        type: 'error',
                        showClose: false
                    })
                    if(error.response.data.errors.hasOwnProperty('phone')) {
                        this.alert.data.phone = error.response.data.errors.phone[0]
                    }
                    if(error.response.data.errors.hasOwnProperty('password')) {
                        this.alert.data.password = error.response.data.errors.password[0]
                    }
                })

        }
    }
}
</script>
<style>
.el-message{
    width: 330px;
    position: absolute;
    right: 0;
    float: right;
    z-index: 9999;
    margin: 10px 10px 10px 10px;
}
</style>
