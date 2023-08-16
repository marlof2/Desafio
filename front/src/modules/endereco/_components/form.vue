<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{
            $route.params.id != undefined ? "Edição de Endereço" : "Novo Endereço"
          }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-5">
      <v-form ref="form" v-model="valid" lazy-validation>
        <v-row>
          <v-col cols="12" sm="12" md="4">
            <TextField
              v-model="form.logradouro"
              :label="'Logradouro'"
              :maxlength="100"
              :rules="required"
              required
            />
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="12" md="4">
            <TextField
              v-model="form.cep"
              :label="'CEP'"
              :rules="required"
              required
              v-mask="'##.###-###'"
            />
          </v-col>
        </v-row>

        <v-card-actions>
          <v-spacer></v-spacer>
          <FormButton
            :background="'grey'"
            :label="'Voltar'"
            @click="$router.go(-1)"
          />
          <FormButton :background="'primary'" :label="'Salvar'" @click="save" />
        </v-card-actions>
      </v-form>
    </v-card>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import FormButton from "../../../components/UI/FormButton.vue";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../_constants";
import storePapel from "../../papel/_store";

import TextField from "../../../components/Inputs/TextField.vue";
import SelectAutocomplete from "@/components/Inputs/SelectAutocomplete.vue";

export default {
  name: "usuarioFomr",
  components: {
    FormButton,
    Breadcrumbs,
    TextField,
    SelectAutocomplete,
  },
  beforeCreate() {
    const STORE_USUARIO = "$_endereco";
    if (!(STORE_USUARIO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USUARIO, store);

    const STORE_PAPEL = "$_papel";
    if (!(STORE_PAPEL in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PAPEL, storePapel);


    const STORE_ENDERECO = "$_endereco";
    if (!(STORE_ENDERECO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_ENDERECO, store);
  },
  data() {
    return {
      valid: true,
      formValidated: true,
      required: [(v) => !!v || "Campo obrigatório"],
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsForm],
    };
  },
  async mounted() {
    this.breadcrumbs[1].text = "Cadastrar";
    if (this.$route.params.id != undefined) {
      this.breadcrumbs[1].text = "Editar";
      await this.itemById(this.$route.params.id);
    }
  },
  computed: {
    ...mapGetters({
      getItemById: "$_endereco/getItemById",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_endereco/getItemById",
      createItem: "$_endereco/createItem",
      updateItem: "$_endereco/updateItem",
    }),
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      this.form.cep = this.form.cep.replace(/[()\ \s.-]+/g, "");
      if (this.$route.params.id != undefined) {
        this.form.id = this.$route.params.id;
        const resp = await this.updateItem(this.form);
        if (resp.status == 200) {
          this.$router.push({ name: "endereco" });
          Swal.messageToast("Alterado com suesso.", "success");
        }
      } else {
        const resp = await this.createItem(this.form);
        if (resp.status == 201) {
          this.$router.push({ name: "endereco" });
          Swal.messageToast("Adicionado com suesso.", "success");
        }
      }
    },
  },
  watch: {
    getItemById(item) {
      if (this.$route.params.id != undefined) {
        let keys = Object.keys(this.form);
        keys.forEach((i) => {
          this.form[i] = item[i];
        });
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
