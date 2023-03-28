<template>
    <div id="selectLocale">
        <el-dialog
            class="selectLocale"
            v-model="dialog.selectLocale"
            :title="$t('users.select_locale')"
            center
            :close-on-click-modal="false"
            :close-on-press-escapes="false"
            :show-close="false"
        >
            <el-form>
                <el-button type="success" @click="changeLocale('ru')">Русский</el-button>
                <el-button type="success" @click="changeLocale('en')">English</el-button>
                <el-button type="success" @click="changeLocale('kz')">Қазақша</el-button>
            </el-form>
        </el-dialog>
    </div>
</template>
<script>
import {mapGetters, mapMutations} from "vuex";

export default {
    name: 'SelectLocale',
    data() {
      return {
        dialog: {
          selectLocale: false
        }
      }
    },
    computed: {
        ...mapGetters(['showLayout', 'locale'])
    },
    created(){
        this.getLocale()
    },
    methods: {
        ...mapMutations(['setShowLayout', 'setLocale']),
        getLocale(){
            let lang = this.locale
            if(!lang){
                this.dialog.selectLocale = true
                this.setShowLayout(false)
            }else{
                this.$i18n.locale = lang
                this.setLocale(lang)
                this.setShowLayout(true)
            }
        },
        changeLocale(lang){
            this.setLocale(lang)
            this.$i18n.locale = lang
            this.dialog.selectLocale = false
            this.setShowLayout(true)
        },
    },
};
</script>
<style>
.selectLocale{
    width: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
