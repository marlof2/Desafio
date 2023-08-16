<template>
  <div>
    <v-expansion-panels
      :flat="flat"
      v-model="open"
      focusable
      :readonly="readOnly"
    >
      <v-expansion-panel>
        <v-expansion-panel-header>
          <h4>
            {{ title }}
          </h4>
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <slot></slot>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
</template>
<script>
export default {
  data(){
    return{
      open: -1
    }
  },
  props: {
    title: {
      type: String,
      default: "",
    },
    readOnly: {
      type: Boolean,
      default: false,
    },
    flat: {
      type: Boolean,
      default: false,
    },
  },
};
</script>
<style scoped>
::v-deep .v-expansion-panel-content__wrap {
  padding: 0px 1px 0px 2px !important;
}
</style>
