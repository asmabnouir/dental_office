<template>
  <div id="app">
    <router-view name="header" />
    <div class="wrapper">
      <router-view />
    </div>
    <router-view name="footer" />
  </div>
</template>
<script>
export default {
   data() {
    return {
      authenticated: false,
      mockAccount: {
          email: "testMail",
          password: "password"
      }
    }
  },
  mounted() {
        },
  methods: {
        }
};
</script>
<style lang="scss">
</style>
