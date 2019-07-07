<template>
    <el-container class="login-page">
        <el-header></el-header>
        <el-main>
            <el-row>
                <el-col
                    :xs="{span: 18, offset: 3}"
                    :sm="{span: 10, offset: 6}"
                    :md="{span: 6, offset: 10}"
                >
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
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
import Captcha from "@/views/widgets/Captcha.vue";

export default {
    components: {
        Captcha
    },
    data() {
        return {
            size: "mini"
        };
    }
};
</script>

<style lang="scss" scoped>
</style>
