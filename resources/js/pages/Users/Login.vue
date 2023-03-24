<template>
    <Alert :title="alert.title" :type="alert.type" :show="alert.show"></Alert>
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
                        <el-form-item :error="this.alert.data.email">
                            <el-input v-model="form.email" placeholder="E-mail"></el-input>
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
import Alert from '../../components/alert.vue'
    export default {
        name: 'Login',
        components:{
            Alert
        },
        data() {
            return {
                dialog: true,
                form: {
                    email: '',
                    password: ''
                },
                alert: {
                    title: null,
                    type: null,
                    show: false,
                    data: []
                }
            }
        },
        methods: {
            login() {
                this.alert.data = []
                axios.post('/api/v1/users/login', this.form)
                    .then(response => {
                        console.log(response)
                    })
                    .catch(error => {
                        this.alert.title = error.response.data.message
                        this.alert.type = error.response.data.status
                        this.alert.show = true
                        if(error.response.data.errors.hasOwnProperty('email')) {
                            this.alert.data.email = error.response.data.errors.email[0]
                        }
                        if(error.response.data.errors.hasOwnProperty('password')) {
                            this.alert.data.password = error.response.data.errors.password[0]
                        }
                        setTimeout(() => {
                            this.alert.show = false
                        }, 5000)
                    })
            }
        }
    }
</script>
<style>
</style>
