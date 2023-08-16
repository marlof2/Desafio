<template>
  <v-overlay style="z-index: 20005;" :value="overlay" opacity="0.5">
    <v-progress-circular
        indeterminate
        size="64"
      ></v-progress-circular>
    </v-overlay>
</template>

<script>
export default {
  props: ["overlay"],
  data() {
    return {};
  },
};
</script>

<style scoped>
.blob {
  transform: scale(1);
  animation: pulse linear 1.8s infinite;
}

@keyframes pulse {
	0% { width:276px; }
	50% { width:376px; }
	100% { width:276px; }
}
</style>
