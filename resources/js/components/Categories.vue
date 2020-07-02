<template>
    <div>
        <h1>categories</h1>
        <div class="card" v-for="category in categories" v-bind:key="category.id">
            <h1>{{category.name}}</h1>
            <h1>{{category.status}}</h1>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return{
            categories: [],
            category:{id:'', name:'', status:''},
            category_id:'',
            pagination:{},
            edit:false

        }
    },
    created(){
        this.fetchCategories();
    },
    methods:{
       fetchCategories(){
           fetch('categories').then(res => res.json()).then(response =>{
            console.log(response.data);
            this.categories = response.data;
           })
       } 
    }
}
</script>