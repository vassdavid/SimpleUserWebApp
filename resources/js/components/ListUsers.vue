<template>
  <div id="users container">
    <h1>Users</h1>
    <div class=" row">
      <div class="col-sm-6 col-lg-4 col-xl-3 p-1" v-for="user in users">

        <div class="card user-card" >

          <div class="card-header" >
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
                Email(s):
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
      <div class="col pt-2">
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
    users: [],
    currentPage: 0,
    perPage: 0,
    page: 0,
    lastPage: 1,
    apiUrl: '/api/user',
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
      this.loader(page);
    },
    linkGen (pageNum) {
      let cat = ''
      if(this.category > 0)
        cat = this.category + '/'
      return '/#/users-page/' + pageNum
    },
    loader(page=0){
       let pager = ''
       //get page
       if(!page){
         if(this.$route.params.page)
          page = this.$route.params.page
       }
      // 404 =>  this.lastPage >= parseInt(page) > 0
       if(parseInt(page) > 0 ) {
          pager += '?page=' + page
       } else {
         //bad format
       }

      //http request
      axios.get(this.apiUrl + pager)
      .then(response => {
        // JSON responses are automatically parsed.
        this.users = response.data.data
        this.lastPage = response.data.last_page
        this.path = response.data.path
        this.currentPage = response.data.current_page
      })
     .catch(e => {
       console.log(e)
     })
    },
  }
}
</script>
<style lang="scss" scoped>

</style>
