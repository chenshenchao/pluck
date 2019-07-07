<template>
    <div @click="onClick" class="captcha" :style="{ height: height }">
        <img alt="captcha" :src="src"/>
    </div>
</template>

<script>
export default {
    data() {
        return {
            timestamp: new Date().getTime(),
        };
    },
    props: {
        size: {
            default: 'medium',
        },
        source: {
            default: '/captcha',
        },
    },
    computed: {
        src() {
            return `${this.source}?timestamp=${this.timestamp}`;
        },
        height() {
            switch (this.size) {
            case 'small':
                return '32px';
            case 'mini':
                return '28px';
            }
            return '40px';
        },
    },
    methods: {
        onClick() {
            this.timestamp = new Date().getTime();
        },
    },
};
</script>

<style lang="scss" scoped>
.captcha {
    width: 100%;
    height: 32px;

    & > img {
        width: 100%;
        height: 100%;
    }
}
</style>

