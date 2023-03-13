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
                            <el-button type="success">{{ $t('users.sign_in')}}</el-button>
                            <el-button type="primary" @click.native="$router.push('/register')">{{ $t('users.sign_up')}}</el-button>
                        </el-form-item>
                    </el-form>
                </el-dialog>
            </el-col>
        </el-row>
    </div>
</template>
<script>
    export default {
        name: 'Login',
        data() {
            return {
                dialog: true,
                form: {
                    email: '',
                    password: ''
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
