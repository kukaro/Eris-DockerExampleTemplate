<template>
    <v-navigation-drawer
        v-model="drawer"
        :mini-variant.sync="mini"
        permanent
    >
        <v-list-item class="px-2">
            <v-list-item-avatar>
                <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
            </v-list-item-avatar>

            <v-list-item-title>Melon.lemon</v-list-item-title>

            <v-btn
                icon
                @click.stop="mini = !mini"
            >
                <v-icon>mdi-chevron-left</v-icon>
            </v-btn>
        </v-list-item>

        <v-divider></v-divider>

        <v-list dense>
            <v-list-group
                v-for="item in items"
                :key="item.title"
                link
            >
                <v-list-item-icon>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-group>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    name: "HomePage",
    data(){
        return {
            drawer: true,
            mini: true,
            items: [
                { title: '배너 계좌', icon: 'mdi-home-city' },
                { title: '배너 속성 프리셋', icon: 'mdi-account' },
                { title: '배너 속성', icon: 'mdi-account' },
                { title: '배너 그룹', icon: 'mdi-account' },
                { title: '사용자 권한', icon: 'mdi-account' },
                { title: '배너 목', icon: 'mdi-account-group-outline' },
            ],
        }
    }
}
</script>

<style scoped>

</style>