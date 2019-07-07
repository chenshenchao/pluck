<template>
    <div class="panel-page">
        <div class="brand">
        </div>
        <div class="navbar">
        </div>
        <div class="sidebar">
        </div>
        <div class="main">
            <keep-alive>
                <router-view v-if="$route.meta.keepAlive"/>
            </keep-alive>
            <router-view v-if="!$route.meta.keepAlive"/>
        </div>
        
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.panel-page {

}
</style>
