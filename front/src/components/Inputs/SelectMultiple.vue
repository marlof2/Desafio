<template>
  <div>
    <span>
      {{ label }}<span v-if="required" class="red--text text-h6"> *</span></span
    >
    <v-select
      :rules="rules"
      :items="items"
      v-model="localValue"
      :item-text="itemText"
      :item-value="itemValue"
      hide-details
      multiple
      dense
      outlined
      clearable
      :disabled="disabled"
    >
    </v-select>
  </div>
</template>
<script>
export default {
  name: "Select",
  props: {
    label: {
      type: String,
      default: "",
    },
    items: {
      type: Array,
      default: () => [],
    },
    itemText: {
      type: String,
      default: "",
    },
    itemValue: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    required: {
      type: Boolean,
      default: false,
    },
    rules: {
      type: Array,
      default: () => [],
    },
    value: {
      type: [String, Number, Boolean, Array],
      default: null,
    },
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  mounted(){
  },
  computed: {
    localValue: {
      get() {
        return this.value;
      },
      set(value) {
        this.$emit("input", value);
      },
    },
  },
};
</script>
<style></style>
