<template>
    <el-alert :title="title" :type="type" v-if="show" show-icon />
</template>
<script>
export default {
    name: 'Alert',
    props: {
        title: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
        show: {
            type: Boolean,
            required: true
        }
    }
}
</script>
<style scoped>
    .el-alert{
        width: 330px;
        position: absolute;
        right: 0;
        z-index: 9999;
        margin: 10px 10px 10px 10px;
    }
</style>
