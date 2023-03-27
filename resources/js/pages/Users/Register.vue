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
                        <el-form-item :error="this.alert.data.email">
                            <el-input v-model="form.email" placeholder="E-mail"></el-input>
                        </el-form-item>
                        <el-form-item :error="this.alert.data.password">
                            <el-input type="password" v-model="form.password" show-password :placeholder="$t('users.password')"></el-input>
                        </el-form-item>
                        <el-form-item :error="this.alert.data.password">
                            <el-input type="password" v-model="form.password_confirmation" show-password :placeholder="$t('users.password_confirmation')"></el-input>
                        </el-form-item>
                        <el-form-item :error="this.alert.data.agreement">
                            <el-checkbox v-model="form.agreement" :label="$t('users.agree_checkbox')" @click="showPolicy()"></el-checkbox>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="success" @click="register()">{{ $t('users.sign_up')}}</el-button>
                        </el-form-item>
                    </el-form>
                </el-dialog>
                <el-dialog
                    v-model="policy"
                    :title="$t('users.policy')"
                    center
                    :close-on-click-modal="false"
                    :close-on-press-escapes="false"
                    :show-close="false"
                    :before-close="closePolicy"
                >
                    <el-form>
                        <el-form-item>
                            <p>{{ $t('users.agreement_text') }}</p>
                        </el-form-item>
                        <el-form-item>
                            <p>{{ $t('users.policy_text') }}</p>
                        </el-form-item>
                    </el-form>
                <el-button type="success" @click="closePolicy()" :disabled="closeStatus">{{ $t('users.read', { msg: second }) }}</el-button>
                </el-dialog>
            </el-col>
        </el-row>
    </div>
</template>
<script>
import { mapMutations } from 'vuex';
import {ElNotification} from "element-plus";

export default {
    name: 'Register',
    data() {
        return {
            second: 30,
            intervalId: null,
            dialog: true,
            policy: false,
            closeStatus: true,
            form: {
                email: '',
                password: '',
                password_confirmation: '',
                phone: '',
                agreement: false
            },
            alert: {
                data: []
            }
        }
    },
    methods: {
        ...mapMutations(['setAuthenticated']),
        showPolicy() {
            this.policy = true
            this.dialog = false
            window.setInterval(() => {
                if (this.second > 0) {
                    this.second--
                }else{
                    this.closeStatus = false
                }
            }, 1000);
        },
        closePolicy(){
            this.policy = false
            this.dialog = true
        },
        register() {
            this.alert.data = []
            axios.post('/api/v1/users/register', this.form)
                .then(response => {
                    localStorage.setItem('token', response.data.data.token)
                    ElNotification({
                        message: response.data.message,
                        type: 'success',
                        showClose: false
                    })
                    setTimeout(() => {
                        this.setAuthenticated(true);
                        this.$router.push({ name: 'dashboard' })
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
                    if(error.response.data.errors.hasOwnProperty('email')) {
                        this.alert.data.email = error.response.data.errors.email[0]
                    }
                    if(error.response.data.errors.hasOwnProperty('password')) {
                        this.alert.data.password = error.response.data.errors.password[0]
                    }
                    if(error.response.data.errors.hasOwnProperty('agreement')) {
                        this.alert.data.agreement = error.response.data.errors.agreement[0]
                    }
                })
        }
    }
}
</script>
<style>
</style>
