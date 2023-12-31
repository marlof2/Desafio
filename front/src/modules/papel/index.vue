<template>
  <div class="d-flex flex-grow-1 flex-column">
    <div class="d-flex align-center py-3">
      <div>
        <div class="display-1">Perfil</div>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
      </div>
    </div>
    <v-card class="pa-2 elevation-3">
      <HeaderGeneric :withTitle="true" class="mb-3">
        <template v-slot:addButton>
          <v-row>
            <v-col cols="12" sm="12" md="6">
              <Button
                class="mb-1"
                :nameIcon="'mdi-plus'"
                :color="'primary'"
                :onClick="() => $router.push({ name: 'papel-cadastrar' })"
                :label="'Adicionar'"
              />
            </v-col>
          </v-row>
        </template>
        <template v-slot:buttons>
          <v-row class="ml-1">
            <v-col cols="12" sm="12" md="12">
              <v-text-field
                v-model="buscar"
                append-icon="mdi-magnify"
                @click:append="search"
                @keyup.enter="search"
                hide-details
                dense
                outlined
                clearable
                placeholder="Buscar"
              ></v-text-field>
            </v-col>
          </v-row>
        </template>
      </HeaderGeneric>
      <DataTableGeneric
        :headersProp="headers"
        :dataProp="items"
        :lastPageProp="paginate.lastPage"
        :pageProp="paginate.page"
        :itemsPerPageProp="paginate.perPages"
        :customColumn="'acao'"
        @handlePageChange="handlePageChange"
        :permissions="permissions"
      >
        <template v-slot:customColumn="{ item }">
          <IconButton
            :onClick="() => editPerfil(item)"
            :name="'mdi-square-edit-outline'"
            :size="22"
            :tooltipName="'Editar'"
            :btnColor="'blue'"
          />
           <IconButton
            :onClick="() => deleteItemTable(item)"
            :name="'mdi-delete-outline'"
            :tooltipName="'Deletar'"
            :btnColor="'red'"
          />
        </template>
      </DataTableGeneric>
    </v-card>
  </div>
</template>
<script>
import store from "./_store";
import Breadcrumbs from "../../components/UI/Breadcrumbs.vue";
import { mapActions, mapGetters } from "vuex";
import { constants } from "./_constants";
import HeaderGeneric from "../../components/UI/HeaderGeneric.vue";
import Button from "../../components/UI/Button.vue";
import DataTableGeneric from "../../components/UI/DataTableGeneric.vue";
import IconButton from "../../components/UI/IconButton.vue";

export default {
  name: "papelModule",
  components: {
    Breadcrumbs,
    HeaderGeneric,
    Button,
    DataTableGeneric,
    IconButton,
  },
  data() {
    return {
      breadcrumbs: [...constants.breadcrumbsIndex],
      items: [],
      paginate: {
        ...constants.paginate,
      },
      headers: [...constants.headers],
      permissions: { ...constants.permissions },
      buscar: null,
    };
  },
  async mounted() {
    await this.search();
  },
  methods: {
    ...mapActions({
      papel: "$_papel/getItems",
      deleteItem: "$_papel/deleteItem",
    }),
    editPerfil(item) {
      return this.$router.push({ path: `papel/editar/${item.id}` });
    },
    gerenciarPermissoes(item) {
      return this.$router.push({
        path: `papel/gerenciar-permissoes/${item.id}`,
      });
    },
    deleteItemTable(item) {
      Swal.deleteMessage(`${item.nome}`).then(async (result) => {
        if (result.isConfirmed) {
          const resp = await this.deleteItem(item.id);
          if (!resp) return false;
          await this.papel();
          Swal.message(resp.data.success);
        }
      });
    },
    async search() {
      await this.papel({
        search: this.buscar,
        page: this.paginate.page,
        per_page: this.paginate.perPage,
      });
    },
    async handlePageChange(paginate) {
      const { per_page, page } = paginate;
      let data = {
        per_page,
        page,
        search: this.buscar,
      };
      await this.papel(data);
    },
  },
  beforeCreate() {
    const STORE_PAPEL = "$_papel";
    if (!(STORE_PAPEL in this.$store._modules.root._children))
      this.$store.registerModule(STORE_PAPEL, store);
  },
  computed: {
    ...mapGetters({
      getItems: "$_papel/getItems",
    }),
  },
  watch: {
    getItems(value) {
      const resp = value;
      this.items = resp.data;
      this.paginate.totalPages = resp.total;
      this.paginate.page = resp.current_page;
      this.paginate.lastPage = resp.last_page;
    },
  },
};
</script>
<style lang="scss" scoped></style>
