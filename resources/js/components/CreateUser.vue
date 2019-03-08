<template>
  <div id="CreateUser" class="px-md-2">
    <h1>Make New User</h1>
    <b-form @submit="onSubmit" @reset="onReset">
      <div role="group">

        <!-- Name: -->
        <b-form-group
          id="inputNameGr"
          description="Let us know your name."
          label="Enter your name"
          label-for="input1"
          :invalid-feedback="nameInvalidFeedback"
          valid-feedback="Thank you!"
          :state="nameState"
        >
          <b-form-input id="inputName" :state="nameState" v-model="name" trim />
          </b-form-group>

        <!-- Date of Birth -->
        <b-form-group
          id="inputDoBGr"
          description="Let us know your birthdate."
          label="Enter your birthdate"
          label-for="inputDoB"
          invalid-feedback="Please give valid birthdate"
          valid-feedback="Thank you!"
          :state="dateState"
        >
          <b-form-input id="inputDoB" :state="dateState" type="date" v-model="dateOfBirth" trim />
        </b-form-group>

        <!-- emails -->
        <div class="row" v-for="(email, index) in emails">
          <!-- email -->
          <div class="col">
            <b-form-group
              :id="'inputEmail' + index + 'Gr'"
              description="Let us know your email."
              :label="'Enter your email ' + (index+1) "
              :label-for="'inputEmail' + index"
              invalid-feedback="Please give valid email"
              valid-feedback="Thank you!"
              :state="emailState(index)"
            >
              <b-input-group>
                <b-form-input
                :id="'inputEmail'+index"
                :state="emailState(index)"
                type="email"
                v-model="emails[index]"
                trim
                />
                <b-input-group-append>
                  <b-button
                    :disabled="emails.length == 1"
                    @click="deleteRow(index)"
                    variant="danger"
                  >
                    Delete email
                  </b-button>
                </b-input-group-append>

              </b-input-group>

          </b-form-group>
        </div>

        </div>
          <button @click="addRow" class="my-3 btn btn-success">+ Add email</button>
        </div>
        <div class="text-right">
          <b-button
            type="submit"
            variant="primary"
            :disabled="!formState"
          >Submit</b-button>
          <b-button type="reset" variant="danger">Reset</b-button>
        </div>

    </b-form>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: ' ',
      dateOfBirth: ' ',
      emails: [ ' ' ],
      respErrors: [],
      sendedData: []
    }
  },
  computed: {
    formState() {
      let state = true, i = -1
      while(this.emails[++i]) {
          if(! this.emailState(i) ) {
              state = false
              break
          }
      }
      if(state) {
        state = this.nameState && this.dateState
      }
      return state
    },
    nameState() {
      let state = null
      if( this.name != ' ' )
        state = (!this.respErrors['name'] || ( this.sendedData['name'] && this.sendedData['name'] == this.name)) && this.name.length > 2
      return state
    },
    dateState() {
      if(this.dateOfBirth == ' ')
         return null
      let date = new Date(this.dateOfBirth)
      return date.getTime() < Date.now()
    },
    nameInvalidFeedback() {
      let feedback = 'Invalid name format!'
      if(this.respErrors['name']) {
        feedback = '(name: ' + this.sendedData['name'] + ') error:'
        $.each(this.respErrors['name'], function(key,err){
          feedback += ' ' + err
        })
      }
      return feedback
    }
  },
  methods: {
    emailState(index) {
      if(this.emails[index] == ' ')
        return null
      let mailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
        str = this.emails[index]
      return mailFormat.test(str)
    },
    deleteRow(index) {
      if(this.emails.length > 1)
        this.emails.splice(index, 1)
    },
    addRow(evt) {
      evt.preventDefault()
      this.emails.push(' ')
    },
    onReset(evt) {
       evt.preventDefault()
       this.name = this.dateOfBirth = ''
       this.emails = [ ' ' ]
     },
     onSubmit(evt) {
       evt.preventDefault()
       this.sendedData = {
             name: this.name,
             date_of_birth: this.dateOfBirth,
             emails: this.emails
        }
       if(this.formState){
         axios.post('/api/user', this.sendedData)
           .then(function (response) {
               console.log(response.data)
           })
           .catch(function (error) {
             console.log(error.response.data)
             if(error.response.data.errors)
              this.respErrors = error.response.data.errors
           }.bind(this));
       }
     },
  }
}
</script>
<style lang="scss" scoped>
</style>
