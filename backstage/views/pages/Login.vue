<template>
    <el-container class="login-page">
        <el-header>

        </el-header>
        <el-main>
            <el-row>
                <el-col :span="6">&nbsp;</el-col>
                <el-col :span="10">
                    <el-form :size="size" label-width="100px">
                        <el-form-item label="用户名">
                            <el-input/>
                        </el-form-item>
                        <el-form-item label="密码">
                            <el-input/>
                        </el-form-item>
                        <el-form-item label="验证码">
                            <el-col :span="12">
                                <captcha :size="size"/>
                            </el-col>
                            <el-col :span="12">
                                <el-input/>
                            </el-col>
                        </el-form-item>
                        <el-form-item>
                            <el-button>登录</el-button>
                        </el-form-item>
                    </el-form>
                </el-col>
                <el-col :span="6">&nbsp;</el-col>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
import Captcha from '@b/views/widgets/Captcha.vue';

export default {
    components: {
        Captcha,
    },
    data() {
        return {
            size: 'mini',
        };
    },
};
</script>

<style lang="scss" scoped>

</style>
