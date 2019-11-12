<template>
  <div class="login-page">
    <el-container>
      <el-header>
        <h1>登录管理后台</h1>
      </el-header>
      <el-main class="main">
        <el-row class="row">
          <el-col :span="8" :md="12">&nbsp;</el-col>
          <el-col :span="10" :md="6">
            <el-form class="login-form" size="small" label-width="100px">
              <el-form-item label="用户名">
                <el-input v-model="sheet.username" />
              </el-form-item>
              <el-form-item label="密码">
                <el-input v-model="sheet.password" type="password" />
              </el-form-item>
              <el-form-item label="验证码">
                <el-row>
                  <el-col :span="12">
                    <x-captcha />
                  </el-col>
                  <el-col :span="12">
                    <el-input v-model="sheet.captcha" />
                  </el-col>
                </el-row>
              </el-form-item>
              <el-form-item style="text-align: right">
                <el-button @click="onSubmit" :loading="submiting" type="primary">
                  <span>登录</span>
                </el-button>
              </el-form-item>
            </el-form>
          </el-col>
          <el-col :span="6">&nbsp;</el-col>
        </el-row>
      </el-main>
    </el-container>
  </div>
</template>

<script>
export default {
  name: "login-page",
  data() {
    return {
      sheet: {
        username: "",
        password: "",
        captcha: ""
      },
      rules: {},
      submiting: false
    };
  },
  methods: {
    onSubmit() {
      this.submiting = true;
      this.$store
        .dispatch("insider/login", this.sheet)
        .then(() => {
          this.$router.push({
            name: "panel-page"
          });
        })
        .finally(() => {
          this.submiting = false;
        });
    }
  },
  beforeRouteEnter(to, from, next) {
    next();
  }
};
</script>

<style lang="scss" scoped>
.login-page {
  position: relative;
  width: 100%;
  height: 100%;

  .main {
    min-height: 80vh;
    background-image: linear-gradient(-90deg, #29bdd9 0%, #276ace 100%);

    .row {
      display: flex;
      align-items: center;
      height: 100%;
    }
  }

  .login-form {
    position: relative;
    z-index: 10;
    padding: 1em;
    background: #fff;
    box-shadow: 0 0 6px 5px rgba(177, 177, 177, 0.5);
  }
}
</style>