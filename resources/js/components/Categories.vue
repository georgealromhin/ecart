<template>

  <div>

    <b-card class="shadow-sm">

      <template v-slot:header>
        <h4 class="mb-0"><b-icon-tag-fill></b-icon-tag-fill> Categories</h4> 
      </template>

      <!-- Button trigger modal -->
      <b-button id="show-btn" variant="primary" @click="showModal(true, null, null)">+ Add New Category</b-button>

      <b-row class="mt-2">
        <b-col>
          Show <b-form-select class="form-control w-25" v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select> entries
        </b-col>
        <b-col>
          <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Search..." size="sm"></b-form-input>
        </b-col>
      </b-row>

      <b-table id="my-table" class="mt-2" :items="items" :per-page="perPage" :current-page="currentPage" :fields="fields" outlined bordered hover striped responsive  :filter="filter" @filtered="onFiltered">
        
        <template v-slot:cell(status_check)="row">
          <b-link href="#" class="text-danger" v-if="row.item.status == 'hidden' && user_role == 'main'" @click="updateStatus(row.item.id, row.item.status)"><b-icon-play-fill></b-icon-play-fill> Paused</b-link>
          <b-link href="#" class="text-primary" v-if="row.item.status == 'visible' && user_role == 'main'" @click="updateStatus(row.item.id, row.item.status)"><b-icon-pause-fill></b-icon-pause-fill> Pause</b-link>
        </template>

        <template v-slot:cell(edit)="row">
          <b-link href="#" class="text-primary" @click="showModal(false, row.item.name, row.item.id)" v-if="user_role == 'main'"><b-icon-pencil-square></b-icon-pencil-square> Edit</b-link>
        </template>  

        <template v-slot:cell(delete)="row">
        <b-link href="#" class="text-danger" @click="deleteItem(row.item.id)" v-if="user_role == 'main'"><b-icon-trash></b-icon-trash> Delete</b-link>
        </template>
      </b-table>
      <div class="text-center" v-if="!dataLoaded">
        <b-spinner variant="primary"></b-spinner>
      </div>
        <p class="text-center" v-if="totalRows == 0 && dataLoaded">No data available in table</p>

      <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="right" first-text="First" prev-text="Prev" next-text="Next" last-text="Last" class="mt-1"></b-pagination>

    </b-card>


    <!-- Modal -->
    <b-modal ref="category-modal" centered  hide-footer :title="modalTitle">

      <b-form @submit="onSubmit">

        <b-form-group id="input-group-2" label="Category name:" label-for="input-name">
          <b-form-input id="input-name" v-model="form.name" required placeholder="Enter Category name" ></b-form-input>
        </b-form-group>
        <b-form-input id="input-id" v-model="form.id" hidden></b-form-input>
        <b-row class="mt-2">
          <b-col>
            <b-button variant="danger"  @click="hideModal()" class="w-100">Close</b-button>
          </b-col>
          <b-col>
            <b-button type="submit" variant="primary" class="w-100">Save</b-button>
          </b-col>
        </b-row>

      </b-form>

    </b-modal>

  </div>

</template>

<script>

 export default {
    props: ['user_role'],
    data(){
      return {
        form:{ id:'', name:'', },
        //show: true,
          items: [],
          fields: [
            {key:'name', label:'Name', sortable: true, },
            //{key:'status', label:'Status', sortable:false },
            {key:'status_check', label:'Status', sortable:false },
            {key:'edit', label:'' },
            {key:'delete', label:'' }
          ],
          totalRows: 0,
          currentPage: 1,
          perPage:  10,
          pageOptions: [10, 25, 50, 100],
          filter: null,
          modalTitle: null,
          formEdit: false,
          dataLoaded : false,
          
      }
    },
       
    mounted() {
   
        },

    methods:{

      showModal(add, name, id) {
        this.form.name = name;
        this.form.id = id;
         if (add){
           this.modalTitle = 'Add New Category';
           this.formEdit = false;
         }else{
            this.modalTitle = 'Edit Category';
           this.formEdit = true;
           
         }
        this.$refs['category-modal'].show()
      },
      hideModal() {
        this.$refs['category-modal'].hide()
      },
      // submit form (add data)
      onSubmit(evt) {
        evt.preventDefault();

        if(this.formEdit){
         var obj = {'name': this.form.name}
            //var strngObj = qs.stringify(obj)
          axios.put('category/update/'+this.form.id , obj).then(response => {
            //console.log(response);
            this.hideModal()
            this.getCategories()
          }).catch(err => { console.log(err)});
        }else{
          const formData = new FormData();
          formData.append('name', this.form.name);
          axios.post('category/create', {name: this.form.name}).then(response => {
            //console.log(response);
            this.hideModal()
            this.getCategories()
          }).catch(err => { console.log(err)});
            
        }
        
      },
   
      // fetch data 
      getCategories() {
        axios.get('categories/all').then(function(response){
          this.items = response.data.data;
          // Set the initial number of items
          this.totalRows = this.items.length
          this.dataLoaded = true;
          }.bind(this));         
        },

        // delete data
        deleteItem(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.value) {
              axios.delete('category/delete/'+ id).then(response => {
              //console.log(response);
              this.getCategories()
            }).catch(err => { console.log(err)})  
            }
          })
            ;
        },
        
        // update status
        updateStatus(id, status) {
           var _status = 'visible';
           if(status == 'visible'){
             _status = 'hidden'
           }
           axios.put('category_status/update/'+_status+'/'+id).then(function(response){
             //console.log(response);
          }).then(
             this.getCategories()
          ); 
        },
        // Trigger pagination to update the number of buttons/pages due to filtering
        onFiltered(filteredItems) {
          this.totalRows = filteredItems.length
          this.currentPage = 1
        },
    },
     
    created: function(){
        this.getCategories();
         
    }, 
    
    computed: {
    }

}
</script>