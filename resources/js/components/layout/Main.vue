<template>
  <div class="container-fluid">
    <div class="row">
      <div id="LeftSidebar" class="col-lg-3 col-md-4 bg-secondary fixed-top h-md-100">
        <LeftSidebar />
      </div>

      <div id="content" class="offset-lg-3 offset-md-4 col-lg-9 col-md-8 pt-3">
        <router-view />
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
</style>
