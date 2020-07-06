<template>
    <div>
        <div class="row">
                    <div class="col-md-6"><h3> <i class="fas fa-tags"></i> Categoeies</h3></div>
                </div>
     
 <table class="table table-striped table-bordered bg-light shadow-sm">
                        <thead>
                          <tr>
                            <th scope="col"></th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(category, index) in categories.data" v-bind:key="category.id">
                                <th scope="row">{{ index +1 }}</th>
                                <td>{{category.name}}</td>
                                <td v-if="category.status == 'hidden'" class="text-danger"><i class="far fa-play-circle"></i> Paused</td>
                                <td v-if="category.status == 'visible'"><i class="far fa-pause-circle"></i> Pause</td>
                                <td></td>
                                <td></td>
                              </tr>
                        </tbody>
                    </table>

                    <pagination :data="categories" @pagination-change-page="fetchCategories" class="float-right">
                        <span slot="prev-nav">Previous</span>
                        <span slot="next-nav">Next</span>
                    </pagination>


    </div>
</template>
<script>
export default {
    data(){
        return{
            categories: [],

        }
    },
    created(){
        this.fetchCategories();
    },
    methods:{
       fetchCategories(page = 1){
           
           axios.get('all_categories?page='+ page).then(response =>{
            //console.log(response.data);
            this.categories = response.data;
           })
       },
       
    }
}
</script>