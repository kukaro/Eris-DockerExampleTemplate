<template>
    <v-app>
        <login-page v-if="!isLogin"></login-page>
        <home-page v-else></home-page>
    </v-app>
</template>

<script>
/* eslint-disable */

import {mapState} from 'vuex';
import LoginPage from "@/pages/Login";
import HomePage from "@/pages/Home"

export default {
    name: "App",
    components: {LoginPage, HomePage},
    computed: {
        ...mapState({
            isLogin: 'isLogin'
        })
    },
    data() {
        return {}
    }
}
</script>

<style scoped>
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}
</style>