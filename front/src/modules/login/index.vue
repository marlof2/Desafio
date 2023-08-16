<template>
  <div>
    <v-container class="d-flex justify-center mt-10">
      <v-card class="text-center pa-1" width="500px">
        <v-card-subtitle class="title"
          >FAÇA LOGIN PARA INICIAR SUA SESSÃO.</v-card-subtitle
        >

        <!-- sign in form -->
        <v-card-text>
          <v-form ref="form" v-model="isFormValid" lazy-validation>
            <v-text-field
              v-model="form.email"
              :rules="[rules.required]"
              :validate-on-blur="false"
              :error="error"
              :label="'E-mail'"
              name="name"
              @keyup.enter="submit"
              @change="resetErrors"
            ></v-text-field>

            <v-text-field
              v-model="form.password"
              :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.required]"
              :type="showPassword ? 'text' : 'password'"
              :error="error"
              :error-messages="errorMessages"
              :label="'Password'"
              name="password"
              @keyup.enter="submit"
              @click:append="showPassword = !showPassword"
            ></v-text-field>

            <v-btn
              :disabled="isSignInDisabled"
              block
              x-large
              dark
              @click="submit"
              >Login</v-btn
            >
          </v-form>
        </v-card-text>
      </v-card>
    </v-container>
  </div>
</template>

<script>
import store from "./_store";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      isSignInDisabled: false,
      isFormValid: true,
      form: {
        email: "admin@gmail.com",
        password: "1234",
      },
      error: false,
      errorMessages: "",
      showPassword: false,
      rules: {
        required: (value) => (value && Boolean(value)) || "Campo obrigatório",
      },
    };
  },
  async mounted() {
    // this.$swal.fire({
    //   title: "Deletado com Sucesso!",
    //   icon: "success",
    // });
  },
  methods: {
    ...mapActions({
      login: "$_login/authenticate",
      permissoes: "$_login/permissoes",
    }),
    async submit() {
      if (this.$refs.form.validate()) {
        this.isSignInDisabled = true;
        await this.login(this.form);
        const result = this.authenticate;
        if (result.token) {
          // window.localStorage.setItem("user_id", result.user_id);
          // await this.permissoes(result.user.id);
          // window.localStorage.setItem("user_id", result.user.id);
          // window.localStorage.setItem(
            //   "permissoes",
          //   this.getPermissoes.permissoes
          // );

          this.$router.push("pagina-inicial");
        }
        this.isSignInDisabled = false;
      } 
    },
    resetErrors() {
      this.error = false;
      this.errorMessages = "";
    },
  },
  computed: {
    ...mapGetters({
      authenticate: "$_login/authenticated",
      getPermissoes: "$_login/getPermissoes",
    }),
  },
  beforeCreate() {
    const STORE_LOGIN = "$_login";
    if (!(STORE_LOGIN in this.$store._modules.root._children))
      this.$store.registerModule(STORE_LOGIN, store);
  },
};
</script>
<style scoped>
</style>
