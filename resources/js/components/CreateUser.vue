<template>
  <div id="CreateUser" class="px-md-2">
    <h1>Make New User</h1>
    <!-- alert messages -->
    <!-- danger -->
    <div class="alert alert-danger my-2 alert-dismissible fade show" role="alert" v-if="alertDangerMessage != ' '">
      <strong>Upoad error:</strong> {{ alertDangerMessage }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <!-- success -->
    <div class="alert alert-success my-2 alert-dismissible fade show" role="alert" v-if="alertSuccessMessage != ' '">
      <strong>Create new user is successful:</strong> {{ alertSuccessMessage }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>


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
          max="35"
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
          <b-form-input
            id="inputDoB"
            :state="dateState"
            type="date"
            v-model="dateOfBirth"
            min="1900-01-01"
            :max="today"
            aria-invalid="true"
            trim
          />
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
              :invalid-feedback="emailInvalidFeedback(index)"
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
          <button @click="addRow" class="mb-3 btn btn-secondary">+ Add email</button>
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
      name: '',
      dateOfBirth: '',
      emails: [ ' ' ],
      respErrors: [],
      sendedData: [],
      alertDangerMessage: ' ',
      alertSuccessMessage: ' '
    }
  },
  computed: {
    today() {
      let day = new Date()
      return (
        day.getFullYear()+ '-' +
        ((day.getMonth()+1) < 10 ?  '0' : '') + (day.getMonth()+1) + '-' +
        (day.getDate() < 10 ?  '0' : '') + day.getDate()
      )
    },
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
    emailsChanged() {
      let change = false
      //get changing var
      if(this.sendedData.emails) {
        if(this.sendedData.emails.length == this.emails.length)
          $.each(this.sendedData.emails, function(key, email){
            if(email != this.emails[key]) {
              change = true
              return false
            }
          }.bind(this))
        else
          change = true
      }
      return change
    },
    nameState() {
      let state = null
      if( this.name != '' ) //default state
        state = (
          (
            !this.respErrors['name']
            ||
            (
              this.sendedData['name']
              &&
              this.sendedData['name'] != this.name
            )
          )
          &&
          this.name.length > 2
        )
      return state
    },
    dateState() {
      let dateFormat = /^\d{4}-\d{2}-\d{2}$/, state = false
      if(this.dateOfBirth == '')
        state = null
      else if( dateFormat.test(this.dateOfBirth) ) {
        let date = new Date(this.dateOfBirth)
        state = date.getTime() < Date.now()
      }
      return state
    },
    nameInvalidFeedback() {
      let feedback = 'Invalid name format!'
      //get response errors
      if (
        this.respErrors['name']
        &&
        this.sendedData['name'] == this.name
      ) {
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
      return (
        (
          !this.respErrors['emails.'+index]
          ||
          this.emailsChanged
        )
        &&
        mailFormat.test(str)
        &&
        !this.duplicatedEmail(index)
      )
    },
    duplicatedEmail(index) {
      return this.emails.indexOf(this.emails[index]) != this.emails.lastIndexOf(this.emails[index])
    },
    emailInvalidFeedback(index){
      let feedback = 'Please give valid email'
      //get response errors
      if(this.respErrors['emails.'+index] && !this.emailsChanged) {
        feedback = '(email '+ (index+1) +': ' + this.sendedData.emails[index] + ') error:'
        $.each(this.respErrors['emails.'+index], function(key, err){
          feedback += ' ' + err
        })
      } else if(this.duplicatedEmail(index)) {
        feedback = 'Email is duplicated!'
      }
      return feedback
    },
    deleteRow(index) {
      if(this.emails.length > 1)
        this.emails.splice(index, 1)
    },
    addRow(evt) {
      evt.preventDefault()
      this.emails.push(' ')
    },
    reset() {
      this.name = this.dateOfBirth = ''
      this.emails = [ ' ' ]
    },
    onReset(evt) {
      evt.preventDefault()
      this.reset()
    },
    onSubmit(evt) {
      evt.preventDefault()
      //make nonrective
      let emails = []
      $.each(this.emails, function(key,email){
        emails.push(email)
      })
       //data state when send to server
      this.sendedData = {
        name: this.name,
        date_of_birth: this.dateOfBirth,
        emails: emails
      }
      //set resp data to default
      this.alertDangerMessage = this.respErrors =  this.alertSuccessMessage = ' '
      //all form data is ready
      if(this.formState) {
        axios.post('/api/user', this.sendedData)
          .then(function (response) {
            let emails = []
            $.each(response.data.emails, function(key, value){
              emails.push(value.email)
            })
            //make success message
            this.alertSuccessMessage = 'new user: (name: ' + response.data.name + ', date of birth: ' + response.data.date_of_birth + ', emails: ' + emails.join(', ') + ')'
            //reset forms
            this.reset()
          }.bind(this))
          .catch(function (error) {
            //store messages
            if(error.response.data.errors)
              this.respErrors = error.response.data.errors
            if(error.response.data.message)
              this.alertDangerMessage = error.response.data.message

           }.bind(this));
       }
     },
  }
}
</script>
<style lang="scss" scoped>
</style>
