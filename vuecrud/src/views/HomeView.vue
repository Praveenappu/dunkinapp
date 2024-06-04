<template>
  <main>
    <div class="container split">
      <div style="margin-top: 10px;" class="column container">
        <img class="imgset img-fluid" src="../assets/blood.gif" >
      </div>
      <div style="margin-top: 10px;margin-left: 220px;" class="column container fit">
    <div style="margin-top: 60px;" class="container fit">
      <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
              
              <li  class="mb-0 ms-3" v-for="(error,index) in this.errorList":key="index">
              {{ error[0] }}
              </li>
      </ul>     
          </div>
    
      <div style="margin-bottom: 20px;" class="main"> 
        <input type="checkbox" id="chk" aria-hidden="true">
      <div  class="signup">
          
          <div style="margin-top: 60px;" class="container">
    <form>   
    <input type="text" v-model="model.useradd.name"  placeholder="User name">
    <input type="email" v-model="model.useradd.email"  placeholder="Email" >
          <input type="password" v-model="model.useradd.password" placeholder="Password">
    <button type="button" @click="save" class="btn btn-primary">Sign up</button>
    <label for="chk" aria-hidden="true">Sign up</label>	
      </form>
  </div>
      </div>
          
    <div class="login">
      <form>
        <label for="chk" aria-hidden="true">Login</label>
        <input type="email" v-model="modellog.userlogin.email" name="email" placeholder="Email">
        <input type="password" v-model="modellog.userlogin.password" name="pswd" placeholder="Password">
        <button type="button" @click="login" class="btn btn-primary">Login</button>
      </form>
    </div>
</div>
</div>
</div>
  </main>
</template>

<style scoped>
.fit{
  width: 100%;
}
body{
margin: 0;
padding: 0;
display: flex;
justify-content: center;
align-items: center;
min-height: 100vh;
font-family: 'Jost', sans-serif;
background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
}
.imgset
{
background-size: cover;
background-repeat: no-repeat;
height: 600px;
width:550px;
}
.main{
width: 500px;
height: 430px;
background: red;
overflow: hidden;
background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
border-radius: 10px;
box-shadow: 5px 20px 50px #000;
margin-top: 50px;
  
}
#chk{
display: none;
}
.column
{
  width: 50%;
}
.split
{
  display: flex;
}
.signup{
position: relative;
width:100%;
height: 100%;
}
label{
color: #fff;
font-size: 2.3em;
justify-content: center;
display: flex;
margin: 50px;
font-weight: bold;
cursor: pointer;
transition: .5s ease-in-out;
}
input{
width: 60%;
height: 50px;
background: #e0dede;
justify-content: center;
display: flex;
margin: 20px auto;
padding: 12px;
border: none;
outline: none;
border-radius: 5px;
}
button{
width: 60%;
height: 40px;
margin: 10px auto;
justify-content: center;
display: block;
color: #fff;
background: #573b8a;
font-size: 1em;
font-weight: bold;
margin-top: 30px;
outline: none;
border: none;
border-radius: 5px;
transition: .2s ease-in;
cursor: pointer;
}
button:hover{
background: #6d44b8;
}
.login{
height: 460px;
background: #eee;
border-radius: 60% / 10%;
transform: translateY(-180px);
transition: .8s ease-in-out;
}
.login label{
color: #573b8a;
transform: scale(.6);
}

#chk:checked ~ .login{
transform: translateY(-500px);
}
#chk:checked ~ .login label{
transform: scale(1);	
}
#chk:checked ~ .signup label{
transform: scale(.6);
}
</style>

<script>
import axios from 'axios'
export default
{
  
  name: 'useradd',
  data()
  {
      return {
          errorList:'',
          model:{
              useradd: {
                  name: '',
                  email: '',
                  password:''
              }
          },
    modellog:{
              userlogin: {
                  email: '',
                  password:''
              }
          },
      }
  },
  methods:{
      save()
      {
          var $mythis = this;
          axios.post('http://127.0.0.1:8000/register',this.model.useradd).then(res =>{
          
          console.log(res.data);
          alert(res.data.message);
          $mythis.errorList = '';
          
          this.model.useradd = {
              
                  name: '',
                  email: '',
                  password:''
          
          }
              

          }).catch(function(error){
         if(error.response){
          if(error.response.status == 422)
          $mythis.errorList = error.response.data.errors;
         }
          })
      },
      login()
      {
  axios.post('http://127.0.0.1:8000/login',this.modellog.userlogin).then(res =>{

    if(res.data.status == 200){
      console.log(res.data);
      alert(res.data.message);
      localStorage.setItem('auth',this.modellog.userlogin.email);
      this.modellog.userlogin = {
              email: '',
              password:''}
     
     this.$router.push('/userview');	
      
    }else{
          console.log(res.data);
          alert(res.data.message);
          
    }
          })
      },

  },
}
</script>
