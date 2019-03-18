<template>
  <div id="users" class="container px-2">
    <div class="row">
      <h1>Users</h1>

    </div>
    <div class="row">
      <!-- empty  -->
      <div class="col-12" v-if="users && users.length == 0 && usersLoaded ">
        <div class="display-4">
            There are no registered users!
        </div>
        <div class="alert alert-info">
          You can register new user in
          <router-link to="/CreateUser">here</router-link>
        </div>
      </div>
      <!-- Loading -->
      <div class="loader" v-else-if="!usersLoaded">
        Loading...
      </div>
      <!-- list  -->
      <div class="col-sm-6 col-lg-4 col-xl-3 p-1" v-else v-for="user in users">

        <div class="card user-card" >

          <div class="card-header px-2" >
            {{user.name}}
          </div>

          <div class="card-body container">

            <div class="row">
              <div class="col-6 pr-0 pl-1">
                Date of birth:
              </div>

              <div class="col-6 pr-2 text-right">
                {{ user.date_of_birth }}
              </div>
            </div>

            <div class="row">
              <div class="col pl-1">
                Email{{ user.emails && user.emails.length > 1  ? 's' : '' }}:
              </div>
            </div>
            <div class="row">
              <div class="col-12 px-2 text-right" v-for="email in user.emails">
                <a :href="'mailto:'+email.email">{{email.email}}</a>
              </div>
            </div>

          </div>

        </div>

      </div>

    </div>
    <div class="row">
      <div class="col pt-2" v-bind:class="{ 'd-none': !usersLoaded }">
        <b-pagination-nav
          v-if="lastPage > 1"
          @input="getPage(currentPage)"
          :link-gen="linkGen"
          :number-of-pages="lastPage"
          v-model="currentPage"
          size="md"
          align="center"
          :limit="7"
        />
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "",
  data: () => ({
    users: [  ],
    currentPage: 0,
    perPage: 0,
    page: 0,
    lastPage: 0,
    apiUrl: '/api/user',
    usersLoaded: false
  }),
  created() {
    this.loader()
  },
  watch: {
    '$route' (to, from) {
      this.loader()
    }
  },
  methods: {
    getPage(page){
      //this.loader(page);
    },
    linkGen (pageNum) {
      let cat = ''
      if(this.category > 0)
        cat = this.category + '/'
      return '/#/users-page/' + pageNum
    },
    loadUsers(state){
      this.usersLoaded = state
    },
    loader(page=0){
      let pager = ''
      //get page
      if(!page){
        if(this.$route.params.page)
          page = this.$route.params.page
      }
      //set to default
      this.usersLoaded = false
      // 404 =>  !(this.lastPage > parseInt(page) > 0)
      if(
        parseInt(this.lastPage) < parseInt(page) ||
        parseInt(page) < 0
      ) {
        this.$router.push({path: '/404'})
      }
      else {
          pager += '?page=' + page
       }

      //http request
      axios.get(this.apiUrl + pager)
      .then(response => {
        // JSON responses are automatically parsed.
        this.users = response.data.data
        this.lastPage = response.data.last_page
        this.path = response.data.path
        this.currentPage = response.data.current_page
        this.usersLoaded = true
      })
     .catch(e => {
      console.log(e)
      if(error.response.status == 404)
        this.$router.push({path: '/404'})
     })
    },
  }
}
</script>
<style lang="scss" scoped>
.loader,
.loader:before,
.loader:after {
  background: #3490dc;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #3490dc;
  text-indent: -9999em;
  margin: 88px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
  margin-top: 30vh;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
</style>
