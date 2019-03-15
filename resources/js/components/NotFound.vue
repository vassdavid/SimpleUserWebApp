<template>
  <div id="NotFound" class="d-flex justify-content-center">
    <div class="box align-self-center">
      <div class="display-1 title">
        404 error
      </div>
      <div class="display-4 subtitle">
        Page not found
      </div>
      <div class="text-center">
        <button type="button" @click="goBack" class="btn btn-primary mt-3" name="button">Go back</button>
      </div>
    </div>
    </div>
</template>
<script>
export default {
  name: "",
  data: () => ({

  }),
  methods: {
    goBack() {
      this.$router.go(-1)
    }
  }
}
</script>
<style lang="scss" scoped>
#NotFound{
  padding-top: 53px;
  min-height: 80vh;
  color: #52595f;
}
</style>
