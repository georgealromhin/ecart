<template>

  <div>

    <b-card class="shadow-sm">

      <template v-slot:header>
        <h4 class="mb-0"><b-icon-archive></b-icon-archive> Products</h4> 
      </template>
    
      <!-- Button trigger modal -->
      <b-button id="show-btn" variant="primary" @click="showModal(true, null, null)">+ Add New Product</b-button>

      <b-row class="mt-2">
        <b-col>
          Show <b-form-select class="form-control w-25" v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select> entries
        </b-col>
        <b-col>
          <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Search..." size="sm"></b-form-input>
        </b-col>
      </b-row>

      <b-table id="my-table" class="mt-2" :items="items" :per-page="perPage" :current-page="currentPage" :fields="fields" outlined bordered hover striped responsive  :filter="filter" @filtered="onFiltered">
        
        <template v-slot:cell(image)="row">
             <b-img rounded="circle" center v-bind="imageProps2" fluid :src="row.item.image" alt="Image"></b-img>  
        </template>

        <template v-slot:cell(status_check)="row">
          <b-link href="#" class="text-danger" v-if="row.item.status == 'hidden'" @click="updateStatus(row.item.id, row.item.status)"><b-icon-play-fill></b-icon-play-fill> Paused</b-link>
          <b-link href="#" class="text-primary" v-if="row.item.status == 'visible'" @click="updateStatus(row.item.id, row.item.status)"><b-icon-pause-fill></b-icon-pause-fill> Pause</b-link>
        </template>

        <template v-slot:cell(edit)="row">
          <b-link href="#" class="text-primary" @click="showModal(false, row.item.name, row.item.id)"><b-icon-pencil-square></b-icon-pencil-square> Edit</b-link>
        </template>  

        <template v-slot:cell(delete)="row">
        <b-link href="#" class="text-danger" @click="deleteItem(row.item.id)"><b-icon-trash></b-icon-trash> Delete</b-link>
        </template>
      </b-table>
        <p class="text-center" v-if="totalRows == 0">No data available in table</p>

      <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="right" first-text="First" prev-text="Prev" next-text="Next" last-text="Last" class="mt-1"></b-pagination>

    </b-card>


    <!-- Modal -->
    <b-modal ref="product-modal" size="lg" hide-footer :title="modalTitle">

      <b-form @submit="onSubmit">
       
            
                <b-row>
                    


<b-col cols="3">
                <b-img thumbnail center v-bind="imageProps" fluid :src="imageUrl" alt="Image 1"></b-img>

<b-form-file v-model="form.image" :state="Boolean(file)" placeholder="" @change="openImage" @drop="openImage" drop-placeholder="Drop file here..." accept='image/*'></b-form-file>
<b-button variant="dark" size="sm" class="mt-2 w-100" @click="resetImage">Reset image</b-button> 
</b-col>
    <b-col  cols="9">
        
    
            <b-form-group id="input-group-2" label="Category:" label-for="select-category" class="mt-3">
                 <select name="select-category" id="select-category" class="form-control" v-model="form.category_id" required>
            <option v-for="category in categories"  v-bind:key="category.id" :value="category.id" >{{category.name}}</option>
            </select>
            </b-form-group>
           
        
        <b-form-group id="input-group-2" label="Product name:" label-for="input-name" class="mt-3">
          <b-form-input id="input-name" v-model="form.name" required ></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="Price" label-for="input-price">
          <b-form-input type="number" min="0" step="0.1" value="0" id="input-price" v-model="form.price" required></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-2" label="Description" label-for="input-des">
            <b-form-textarea
            id="input-des"
            v-model="form.des"
            rows="2"
            required
            ></b-form-textarea>
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
    </b-col>

    </b-row>
      </b-form>

    </b-modal>

  </div>

</template>

<script>

 export default {
    data(){
      return {
          imageProps: { width: 200, height: 200},
          imageProps2: { width: 35, height: 35},
        form:{ id:'', name:'', price:'', des:'',image:'', category_id:''},
        //show: true,
          items: [],
          categories: [],
          fields: [
            {key:'image', label:'Image', sortable: false, },
            {key:'name', label:'Name', sortable: true, },
            {key:'price', label:'Price', sortable: true, },
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
          imageUrl: 'images/default.jpg'
      }
    },
       
    mounted() {
   
        },

    methods:{
openImage(e){
    const file = e.target.files[0];
      this.imageUrl = URL.createObjectURL(file);
},
resetImage(){
    this.imageUrl = 'images/default.jpg';
},
      showModal(add, name, id) {
        this.form.name = name;
        this.form.id = id;
         if (add){
           this.modalTitle = 'Add New Peoduct';
           this.formEdit = false;
         }else{
            this.modalTitle = 'Edit Product';
           this.formEdit = true;
           
         }
        this.$refs['product-modal'].show()
      },
      hideModal() {
        this.$refs['product-modal'].hide()
      },
      // submit form (add data)
      onSubmit(evt) {
        evt.preventDefault();

        if(this.formEdit){
         var obj = {'name': this.form.name}
            //var strngObj = qs.stringify(obj)
          axios.put('edit_product/'+this.form.id , obj).then(response => {
            //console.log(response);
            this.hideModal()
            this.getProducts()
          }).catch(err => { console.log(err)});
        }else{
          const formData = new FormData();
          //formData.append('image', this.form.image.target.files[0]);
          formData.append('name', this.form.name);
          formData.append('price', this.form.price);
          formData.append('des', this.form.des);
          formData.append('category_id', this.form.category_id);
          console.log(this.form.category_id);
          axios.post('add_product', formData).then(response => {
            //console.log(response);
            this.hideModal()
            this.getProducts()
          }).catch(err => { console.log(err)});
            
        }
        
      },
   
      // fetch data 
      getProducts() {
        axios.get('all_products').then(function(response){
          this.items = response.data.data;
          // Set the initial number of items
          this.totalRows = this.items.length
          }.bind(this));         
        },
        // fetch data 
        getCategories() {
            axios.get('all_categories').then(function(response){
            this.categories = response.data.data;
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
              axios.delete('delete_category/'+ id).then(response => {
              //console.log(response);
              this.getProducts()
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
           axios.get('change_status/'+_status+'/'+id).then(function(response){
             //console.log(response);
          }).then(
             this.getProducts()
          ); 
        },
        // Trigger pagination to update the number of buttons/pages due to filtering
        onFiltered(filteredItems) {
          this.totalRows = filteredItems.length
          this.currentPage = 1
        },
    },
     
    created: function(){
        this.getProducts();
        this.getCategories();
         
    }, 
    
    computed: {
    }

}
</script>