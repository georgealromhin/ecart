<template>
    <div>
        <div class="row">
            <div class="col-md-6"><h3> <i class="fas fa-user-cog"></i> Users Manager</h3></div>
            <div class="col-md-6"><a href="add_user" class="btn btn-primary btn-sm float-right"> <i class="fas fa-user-plus"></i> Add User</a></div>
        </div>
        
        
        <table class="table table-striped table-bordered bg-light shadow-sm mt-2">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <tr v-for="user in users" v-bind:key="user.id">
            <th scope="row">{{user.id}}</th>
            <td>{{user.name}} <i class="fas fa-star text-warning" v-if="user.role == 'main'">
</i> </td>
            <td>{{user.username}}</td>
            <td>{{user.role}}</td>
            <td><a <a v-bind:href="'delete_user/'+ user.id" class="text-danger" v-if="user.role != 'main'"> <i class="fas fa-trash"></i> Delete</a></td>
            </tr>
        </tbody>

        </table>
    </div>
</template>
<script>
export default {
    data(){
        return{
            users: [],
        }
    },
    created(){
        this.fetchUsers();
    },
    methods:{
       fetchUsers(){
           fetch('users').then(res => res.json()).then(response =>{
            this.users = response.data;
           })
       } 
    }
}
</script>
