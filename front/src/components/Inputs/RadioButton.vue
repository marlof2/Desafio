<template>
  <div>
    <v-radio-group :row="row" :column="column" v-model="localValue">
      <v-radio
        v-for="option in items"
        :key="option.id"
        :label="option[`${label}`]"
        :value="option[`${valueOption}`]"
      ></v-radio>
    </v-radio-group>
  </div>
</template>

<script>
export default {
  name: "RadioButton",
  props: {
    items: {
      type: Array,
      default: [],
    },
    label: {
      type: String,
      default: "",
    },
    valueOption: {
      type: [String, Number, Boolean],
      default: null,
    },
    value: {
      type: [String, Number, Boolean],
      default: null,
    },
    required: {
      type: Boolean,
      default: false,
    },
    row: {
      type: Boolean,
      default: true,
    },
    column: { type: Boolean, default: true },
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
