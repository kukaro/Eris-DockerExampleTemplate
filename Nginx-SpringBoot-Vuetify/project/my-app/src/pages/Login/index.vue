<template>
  <div id="login">
    <v-app>
      <v-form
          class="ma-10"
          ref="form"
          lazy-validation
      >
        <v-text-field
            v-model="userId"
            :counter="10"
            label="아이디"
            required
        ></v-text-field>

        <v-text-field
            v-model="userPassword"
            label="비밀번호"
            :type="'password'"
            required
        ></v-text-field>


        <v-btn block
            color="success"
            @click="loginEvent({userId,userPassword})"
        >
          로그인
        </v-btn>

      </v-form>
    </v-app>
  </div>
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