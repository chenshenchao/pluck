<template>
  <div id="app">
    <keep-alive excloude="login-page">
      <router-view />
    </keep-alive>
  </div>
</template>

<style lang="scss">
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
