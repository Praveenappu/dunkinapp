<template>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
        <h4>ADD USER
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
                <input type="text" v-model="model.useradd.name" class="form-control"/>
            </div> 
            <div class="mb-3"> 
                <label for="">EMAIL</label>
                <input type="text" v-model="model.useradd.email" class="form-control"/>
            </div> 
            <div class="mb-3"> 
                <label for="">PASSWORD</label>
                <input type="text" v-model="model.useradd.password" class="form-control"/>
            </div> 
            <div class="mb-3"> 
            <button type="button" @click="save" class="btn btn-primary">SAVE</button>
            </div> 
            
        </div>
      </div>
    </div>
  </template>
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
            }
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
  