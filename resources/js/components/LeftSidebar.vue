<template>
  <nav id="sidebar" class="navbar navbar-expand-md navbar-dark">

    <button
      class="navbar-toggler navbar-toggler-right"
      type="button"
      data-toggle="collapse"
      data-target="#navbarVert"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse flex-column " id="navbarVert">
        <a class="nav-link navbar-brand active" href="/#/">Home</a>
        <router-link class="nav-link" active-class="active" to="/users">Show Users</router-link>
        <router-link class="nav-link" active-class="active" to="/CreateUser">Create User</router-link>
    </div>


  </nav>
</template>
<style lang="scss" scoped>
.nav-link{
  color: #ddd;
  &:hover {
    color: #efefef
  }
  &.active{
    color: #00e4ff;
  }
}
</style>
