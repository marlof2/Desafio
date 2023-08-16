<template>
  <v-checkbox v-model="localValue">
    <template v-slot:label>
      <div>{{label}}</div>
    </template>
  </v-checkbox>
</template>
<script>
export default {
  name: "Checkbox",
  props: {
    label: {
      type: String,
      default: "",
    },
    value: {
      type: Boolean,
      default: false,
    },
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
