<template>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
        <h4>UPDATE USER
            <RouterLink to="/userview" class="btn btn-primary float-end">USERS</RouterLink>
            <button style="margin-right: 20px;" type="button" @click="logout" class="btn btn-primary float-end">Logout</button>
        </h4>
        </div>
            <div class="card-body">
                <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="mb-0 ms-3" v-for="(error,index) in this.errorList":key="index">
                    {{ error[0] }}
                    </li>
                </ul>
            <div class="mb-3"> 
                <label for="">NAME</label>
                <input type="text" v-model="model.userupdate.name" class="form-control"/>
            </div> 
            <div class="mb-3"> 
                <label for="">EMAIL</label>
                <input type="text" v-model="model.userupdate.email" class="form-control"/>
            </div> 
            <div class="mb-3"> 
                <label for="">PASSWORD</label>
                <input type="text" v-model="model.userupdate.password" class="form-control"/>
            </div> 
            <div class="mb-3"> 
            <button type="button" @click="update" class="btn btn-primary">UPDATE</button>
            </div> 
            
        </div>
      </div>
    </div>
  </template>
  <script>
 import axios from 'axios'
 export default
 {
    name: 'userupdate',
    data()
    {
        return {
            Userid:'',
            errorList:'',
            model:{
                userupdate: {
                    name: '',
                    email: '',
                    password:''
                }
            }
        }
    },
    mounted()
    {
     //console.log(this.$route.params.id);
     this.Userid = this.$route.params.id;
     this.getuser(this.$route.params.id);
    },
    methods:{
        getuser(Userid){
         axios.get(`http://127.0.0.1:8000/userview/${Userid}/edit`).then(res =>{
         console.log(res.data.userfindedit);
         this.model.userupdate = res.data.userfindedit;
         });
        },
        update()
        {
            var $mythis = this;
            axios.put(`http://127.0.0.1:8000/userview/${this.Userid}/update`,this.model.userupdate).then(res =>{
            
            console.log(res.data);
            alert(res.data.message);
            $mythis.errorList = '';
            
         }).catch(function(error){
           if(error.response){
            if(error.response.status == 422)
            $mythis.errorList = error.response.data.errors;
           }
         })
        },
        logout(){
            axios.get('http://127.0.0.1:8000/logout').then(res =>{
            console.log(res.data);
            alert(res.data.message);
            localStorage.clear();
            this.$router.push('/');
        
        });

        }
    },
 }
 </script>
  