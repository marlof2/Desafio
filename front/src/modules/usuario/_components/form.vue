<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">
          {{
            $route.params.id != undefined ? "Edição de Usuário" : "Novo Usuário"
          }}
        </div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-stepper v-model="step" vertical>
      <v-stepper-step :complete="step > 1" step="1">
        Dados Usuário
      </v-stepper-step>

      <v-stepper-content step="1">
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-row>
            <v-col cols="12" sm="12" md="4">
              <TextField
                v-model="form.name"
                :label="'Nome'"
                :maxlength="100"
                :rules="[rules.required]"
                required
                :disabled="disabledFilds()"
              />
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" md="4">
              <TextField
                v-model="form.cpf"
                :label="'CPF'"
                :rules="[rules.required, rules.cpf]"
                required
                v-mask="'###.###.###-##'"
                :disabled="disabledFilds()"
              />
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" md="4">
              <TextField
                v-model="form.email"
                :label="'E-mail'"
                :maxlength="100"
                :rules="[rules.required, rules.email]"
                required
                :disabled="disabledFilds()"
              />
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" md="4">
              <span>
                {{ "Perfil"
                }}<span
                  v-if="rules.required"
                  style="font-size: 14px"
                  class="red--text"
                  >*</span
                ></span
              >
              <v-autocomplete
                :items="getItemPapel"
                item-text="nome"
                item-value="id"
                v-model="form.papel_id"
                dense
                outlined
                clearable
                required
                :disabled="disabledFilds()"
              ></v-autocomplete>
            </v-col>
          </v-row>
        </v-form>
        <v-btn dark @click="$router.go(-1)" class="mr-1"> Voltar </v-btn>
        <v-btn color="primary" @click="save()"> Continue </v-btn>
      </v-stepper-content>

      <v-stepper-step :complete="step > 2" step="2">
        Dados Enredeço
      </v-stepper-step>

      <v-stepper-content step="2">
        <v-row class="mt-5">
          <v-col cols="12" sm="12" md="12">
            <HeaderGeneric :title="'Adicionar Endereço'" class="mb-3">
              <template v-slot:buttons>
                <IconButton
                  :onClick="() => openDialog()"
                  :name="'mdi-plus-circle'"
                  :tooltipName="'Adicionar Endereço'"
                  :size="30"
                  :disabled="disabledFilds()"
                />
              </template>
            </HeaderGeneric>
            <DataTableGeneric
              :headersProp="headesEndereco"
              :dataProp="form.enderecos"
              :customColumn="'acao'"
              :showSelectPagination="false"
              :colunmCustom="['cep']"
            >
              <template v-slot:cep="{ item }">
                {{ item.cep | cep }}
              </template>
              <template v-slot:customColumn="{ item }">
                <IconButton
                  :onClick="() => deleteItemTable(item)"
                  :name="'mdi-delete-outline'"
                  :tooltipName="'Deletar'"
                  :btnColor="'red'"
                  :disabled="disabledFilds()"
                />
              </template>
            </DataTableGeneric>
          </v-col>
        </v-row>
        <DialogEndereco
          v-if="dialog"
          :dialog="dialog"
          :closeClick="() => (dialog = false)"
          @setData="getData"
          :user_id="form.id"
        />

        <v-btn dark @click="step = 1"> Voltar </v-btn>
        <v-btn class="ml-1" @click="navigateToIndex()" color="primary">
          Concluir
        </v-btn>
      </v-stepper-content>
    </v-stepper>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
import store from "../_store";
import storeUserEndereco from "../../userEndereco/_store";
import Breadcrumbs from "../../../components/UI/Breadcrumbs.vue";
import { constants } from "../_constants";
import storePapel from "../../papel/_store";

import TextField from "../../../components/Inputs/TextField.vue";
import SelectAutocomplete from "@/components/Inputs/SelectAutocomplete.vue";
import Select from "@/components/Inputs/Select.vue";
import DataTableGeneric from "@/components/UI/DataTableGeneric.vue";
import HeaderGeneric from "@/components/UI/HeaderGeneric.vue";
import IconButton from "@/components/UI/IconButton.vue";
import DialogEndereco from "@/modules/endereco/_components/dialogEndereco.vue";

export default {
  name: "usuarioFomr",
  components: {
    Breadcrumbs,
    TextField,
    SelectAutocomplete,
    Select,
    DataTableGeneric,
    HeaderGeneric,
    IconButton,
    DialogEndereco,
  },
  beforeCreate() {
    const STORE_USUARIO = "$_usuario";
    if (!(STORE_USUARIO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USUARIO, store);

    const STORE_PAPEL = "$_papel";
    if (!(STORE_PAPEL in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PAPEL, storePapel);
    const STORE_USER_ENDERECO = "$_userEndereco";
    if (!(STORE_USER_ENDERECO in this.$store._modules.root._children))
      this.$store.registerModule(STORE_USER_ENDERECO, storeUserEndereco);
  },
  data() {
    return {
      rules: {
        required: [(v) => !!v || "Campo obrigatório"],
        email: (value) => {
          return (
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
              value
            ) || "E-mail invalido."
          );
        },
        cpf: (value) => {
          return (/[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}/.test(value) || "CPF invalido."
          );
        },
      },
      valid: true,
      formValidated: true,
      form: { ...constants.form },
      breadcrumbs: [...constants.breadcrumbsForm],
      step: 1,
      headesEndereco: [
        { text: "Logradouro", value: "logradouro", align: "left" },
        { text: "Cep", value: "cep", align: "left" },
        { text: "AÇÃO", value: "acao" },
      ],
      dialog: false,
    };
  },
  async mounted() {
    this.breadcrumbs[1].text = "Cadastrar";
    if (this.$route.params.id != undefined) {
      this.breadcrumbs[1].text = "Editar";
      await this.itemById(this.$route.params.id);
    }
    await this.getPapel({ limit: "-1" });
  },
  computed: {
    ...mapGetters({
      getItemById: "$_usuario/getItemById",
      getItemPapel: "$_papel/getItems",
    }),
  },
  methods: {
    ...mapActions({
      itemById: "$_usuario/getItemById",
      createItem: "$_usuario/createItem",
      updateItem: "$_usuario/updateItem",
      getPapel: "$_papel/getItems",
      deleteUserEndereco: "$_userEndereco/deleteItem",
    }),
    async deleteItemTable(item) {
      await this.deleteUserEndereco({
        user_id: this.form.id,
        endereco_id: item.id,
      });
      await this.itemById(this.form.id);
      Swal.messageToast("Deletado com suesso.", "success");
    },
    disabledFilds() {
      return this.$route.name == "usuario-detalhar";
    },
    openDialog() {
      this.dialog = true;
    },
    async getData(data) {
      if (data.reload) await this.itemById(data.user_id);
    },
    navigateToIndex() {
      this.$router.push({ name: "usuario" });
    },
    async save() {
      this.formValidated = await this.$refs.form.validate();
      if (!this.formValidated) {
        return false;
      }
      this.form.cpf = this.form.cpf.replace(/[()\ \s.-]+/g, "");
      if (this.$route.params.id != undefined) {
        const resp = await this.updateItem(this.form);
        if (resp.status == 200) {
          this.form.id = resp.data.id;
          this.step = 2;
          Swal.messageToast("Alterado com suesso.", "success");
        }
      } else {
        const resp = await this.createItem(this.form);
        if (resp.status == 201) {
          this.form.id = resp.data.id;
          this.step = 2;
          Swal.messageToast("Adicionado com suesso.", "success");
        }
      }
    },
  },
  watch: {
    getItemById(item) {
      if (this.$route.params.id || this.form.id) {
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
