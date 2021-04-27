<template>
  <v-container>
      <v-alert text v-model="alert.show" :type="alert.type" dismissible>{{alert.message}}</v-alert>
      <v-row justify="center">
        <v-col class="text-center" md="2" sm="2">
            <v-btn class="depressed" @click="suForm=true">
                Sing Up
            </v-btn>
        </v-col>

        <v-col class="text-center" md="2" sm="2">
            <v-btn class="success" @click="suForm=false">
                Sing In
            </v-btn>
        </v-col>
      </v-row>
      <v-row justify="center">
          <v-col md="6" sm="6">
              <v-card v-if="suForm">
                    <v-card-title>
                      Sign Up
                    </v-card-title>

                    <v-card-text>
                        <v-form class="ma-3" @submit.prevent="signup()" ref="signupform"> 
                            <v-text-field 
                            label="Name"
                            prepend-icon="account_circle"
                            :rules="nameRules"
                            v-model="user.name">
                            </v-text-field>

                            <v-text-field 
                            label="E-mail"
                            prepend-icon="email"
                            :rules="emailRules"
                            v-model="user.email">
                            </v-text-field>

                            <v-text-field 
                            label="Password"
                            prepend-icon="lock"
                            type="password"
                            :rules="passwordRules"
                            v-model="user.password">
                            </v-text-field>

                            <v-text-field 
                            label="Confirmar Password"
                            prepend-icon="lock"
                            type="password"
                            :rules="passwordRules2"
                            v-model="user.password_confirmation"
                            >
                            </v-text-field>

                            <v-btn block class="depressed mt-3" type="submit">
                                Sing Up
                            </v-btn>

                        </v-form>


                    </v-card-text>
              </v-card>

              <v-card v-else>
                    <v-card-title>
                      Sign In
                    </v-card-title>

                    <v-card-text>
                        <v-form class="ma-3" @submit.prevent="signin()" ref="signinform"> 
                            <v-text-field 
                            label="E-mail"
                            prepend-icon="email"
                            :rules="emailRules"
                            v-model="userlogin.email">
                            </v-text-field>

                            <v-text-field 
                            label="Password"
                            prepend-icon="lock"
                            type="password"
                            :rules="passwordRules"
                            v-model="userlogin.password">
                            </v-text-field>

                            <v-btn block class="success mt-3" type="submit">
                                Sing In
                            </v-btn>

                        </v-form>


                    </v-card-text>
              </v-card>
          </v-col>
      </v-row>
  </v-container>
</template>

<script>

export default {
    
    data: () => (
        {
            alert: {show: false, message:""},
            nameRules: [
                value => !!value || 'Name is Required',
                value => !!(value && value.length >=5) || 'Name must be more than 5 Characters',
            ],
            emailRules: [
                value => !!value || 'Email is Required',
                value => /.+@.+\..+/.test(value) || 'Email must be valid',
            ],
            passwordRules: [
                value => !!value || 'Password is Required',
                value => !!(value && value.length >=6) || 'Password must be more than 2 Characters',
            ],
            passwordRules2: [
                value => !!value || 'Password is Required',
                value => !!(value && value.length >=6) || 'Password must be more than 2 Characters',
            ],
            user: {name:"", email:"", password:"", password_confirmation:""},
            userlogin: {email:"", password:""},
            suForm: true
        }
    ),
    methods: {
        async signup(){
           let valid = this.$refs.signupform.validate();
           if(valid){
               try {
                   const res = await this.axios.post('/register',this.user)
                   this.$refs.signupform.reset();
                   this.alert = {
                       show: true,
                       type: "success",
                       message: "User Sucessfull Created"
                   }
               } catch (error) {
                   this.alert = {
                       show: true,
                       type: "error",
                       message: "User Problems Created"
                   }
               }
           }
        },
        async signin(){
           let valid = this.$refs.signinform.validate();
            console.log(this.userlogin);
           if(valid){
               try {
                   const res = await this.axios.post('/login',this.userlogin);
                    console.log(res);
                   if(res.data.token!==undefined){
                       sessionStorage.setItem('session', JSON.stringify(res.data));
                       this.$router.push('/orders');
                   }else{
                       this.alert = {
                        show: true,
                        type: "error",
                        message: "User No Connect"
                      }
                   }
               } catch (error) {
                   this.alert = {
                        show: true,
                        type: "error",
                        message: "Credentials Invalid"
                      }
               }
                   

           }
        }
    }
}
</script>
