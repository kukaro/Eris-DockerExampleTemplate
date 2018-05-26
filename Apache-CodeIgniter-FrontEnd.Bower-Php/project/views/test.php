<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/assets/vue/dist/vue.js"></script>
    <script src="/assets/vue-router/dist/vue-router.js"></script>
</head>
<body>
<div id="app">
    {{hello}}
    <p>
        <router-link to="/foo">Go to Foo</router-link>
        <router-link to="/bar">Go to Bar</router-link>
    </p>
    <router-view></router-view>
</div>
</body>
<script>

    Vue.use(VueRouter);

    const Foo = {template: '<div>foo</div>'};
    const Bar = {template: '<div>bar</div>'};

    const routes = [
        {path: '/foo', component: Foo},
        {path: '/bar', component: Bar}
    ];

    const router = new VueRouter({
        mode: 'history', // 해시태그 삭제
        routes // routes: routes 의 약어
    });

    new Vue({
        el: '#app',
        router,
        data: {
            hello: 'Hello world!'
        }
    });

</script>
</html>