<template>
    <v-container fluid
                 class="mt-auto mb-auto">
        <v-img
            class="mr-auto ml-auto"
            src="../../assets/melon-logo.png"
            width="210"
            height="60">
        </v-img>
        <v-form
            class="ma-10"
            ref="form"
            lazy-validation>

            <v-text-field
                outlined
                v-model="userId"
                label="LDAP계정 아이디"
                required>
            </v-text-field>

            <v-text-field
                outlined
                v-model="userPassword"
                label="LDAP계정 비밀번호"
                :type="'password'"
                required>

            </v-text-field>

            <v-btn block
                   color="success"
                   @click="loginEvent({userId, userPassword})">
                로그인
            </v-btn>

        </v-form>

    </v-container>
</template>

<script>
import {mapMutations} from 'vuex';

export default {
    name: "login-page",
    data() {
        return {
            userId: '',
            userPassword: '',
        }
    },
    methods: {
        ...mapMutations({
            loginEvent: 'loginEvent'
        }),
    }
}
</script>

<style scoped>

</style>