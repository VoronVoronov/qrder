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
                        <el-form-item>
                            <el-input v-model="form.email" placeholder="E-mail"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-input type="password" v-model="form.password" show-password :placeholder="$t('users.password')"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-input type="password" v-model="form.password_confirmation" show-password :placeholder="$t('users.password_confirmation')"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="success">{{ $t('users.sign_up')}}</el-button>
                        </el-form-item>
                    </el-form>
                </el-dialog>
            </el-col>
        </el-row>
    </div>
</template>
<script>
export default {
    name: 'Register',
    data() {
        return {
            dialog: true,
            form: {
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },
    methods: {
        //
    }
}
</script>
<style>
</style>
