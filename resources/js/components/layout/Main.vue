<template>
  <div class="container-fluid">
    <div class="row">
      <div id="LeftSidebar" class="col-xl-2 col-md-3 bg-secondary fixed-top h-md-100">
        <LeftSidebar />
      </div>

      <div id="content" class="offset-xl-2 offset-md-3 col-xl-10 col-md-9 pt-3">
        <router-view />
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
</style>
