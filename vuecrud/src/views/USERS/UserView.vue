<template>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Users
                <RouterLink to="/userview/add" class="btn btn-primary float-end">Add Users</RouterLink>
                <button style="margin-right: 20px;" @click="logout" class="btn btn-primary float-end">Logout</button>
            </h4> 
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                 </tr>
            </thead>
            <tbody v-if="this.userdetail.length > 0">
                <tr v-for="(user, index) in this.userdetail" :key="index">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
            <td>
                <RouterLink :to="{path:'/userview/'+user.id+'/update'}" class="btn btn-success">UPDATE</RouterLink>
                <button style="margin-left: 20px;" @click="deleteuser(user.id)" class="btn btn-danger">DELETE</button>
             </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="4">Loading...</td>
                </tr>
            </tbody>
          </table>
        </div>
    </div>
</div>

 </template>
 <script>
 import axios from 'axios'
 export default
 {
    name: 'userdetail',
    data()
    {
        return{
            userdetail:[]
        }
    },
    mounted()
    {
        this.getuser();
       // console.log("i am here");
    },
    methods: {
        getuser()
        {
            axios.get('http://127.0.0.1:8000/userview').then(res =>{
                this.userdetail = res.data.userdetail
                console.log(this.userdetail)
        });
    },
        deleteuser(Userid){
            if(confirm('Are you sure wants to delete the user?'))
           console.log(Userid);
           axios.delete(`http://127.0.0.1:8000/userview/${Userid}/delete`).then(res =>{
                alert(res.data.message);
                this.getuser();
             });
        },

        logout(){
            axios.get('http://127.0.0.1:8000/logout').then(res =>{
            console.log(res.data);
            alert(res.data.message);
            localStorage.clear();
            this.$router.push('/');
        
        });

        }
    }
 }
 
</script>