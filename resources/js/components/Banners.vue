<template>

  <div>

    <b-card class="shadow-sm">

      <template v-slot:header>
        <h4 class="mb-0"><b-icon-images></b-icon-images> Banners </h4> 
      </template>
<!-- Button trigger modal -->
      <b-button id="show-btn" variant="primary" v-if="user_role == 'main'" @click="showModal()">+ Add Banner</b-button>

      <b-table id="my-table" class="mt-2" :items="items" :per-page="perPage" :current-page="currentPage" :fields="fields" outlined bordered hover striped responsive>
        <template v-slot:cell(image)="row">
             <b-img v-bind="imageProps" :src="row.item.image" alt="Image"></b-img>  
        </template>
        <template v-slot:cell(delete)="row">
        <b-link href="#" class="text-danger" @click="deleteOrder(row.item.id)" v-if="user_role == 'main'"><b-icon-trash></b-icon-trash> Delete</b-link>
        </template>
      </b-table>
        <div class="text-center" v-if="!dataLoaded">
        <b-spinner variant="primary"></b-spinner>
      </div>
        <p class="text-center" v-if="totalRows == 0 && dataLoaded">No data available in table</p>

      <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="right" first-text="First" prev-text="Prev" next-text="Next" last-text="Last" class="mt-1"></b-pagination>

    </b-card>

    <!-- Modal -->
    <b-modal ref="banner-modal"  size="xl" centered  hide-footer title="Add New Banner">

      <b-form @submit="onSubmit">
       
            <b-img  v-bind="imageProps" center :src="imageUrl" alt="Image 1" class="rounded"></b-img>

            <p class="text-center text-info mt-2">Recommended image size 1110x470</p>

                <b-row class="mt-2">
              <b-col>
            <b-button variant="dark" class="mt-2 w-100" @click="resetImage">Reset image</b-button> 
              </b-col>
              <b-col>
            <b-form-file  placeholder="Choose or Drop image here..." @change="openImage" @drop="openImage" drop-placeholder="Drop file here..." accept='image/*' required></b-form-file>
              </b-col>
            </b-row>


            <b-row class="mt-5">
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
        //show: true,
          items: [],
          fields: [
            {key:'image', label:'Image', sortable: false, },
            {key:'delete', label:'' }
          ],
          totalRows: 0,
          currentPage: 1,
          perPage:  10,
          pageOptions: [10, 25, 50, 100],
          filter: null,
          dataLoaded: false,
            imageUrl: 'images/banners/header_image.webp',
            imageProps: { width: 555, height: 235},
      }
    },
       
    mounted() {
   
        },
methods:{
    makeToast(title, text, variant) {
            this.$bvToast.toast(text, {
            title: title,
            variant: variant,
            autoHideDelay: 1000,
            solid: true
            })
        },

      openImage(e){
          this.imagePath = e.target.files[0];
          this.imageUrl = URL.createObjectURL(this.imagePath);
      },
      resetImage(){
          this.imageUrl = 'images/banners/header_image.webp';
          this.imagePath = null;
      },
      resetForm(){
         this.form.name = null;
         this.form.price = null;
         this.form.des = null;
         this.form.category_id = null;
         this.resetImage()
      },
      
      showModal() {
        
        this.$refs['banner-modal'].show()
      },
      hideModal() {
        this.$refs['banner-modal'].hide()
      },
      // fetch data 
      getBanners() {
        axios.get('banners/all').then(response => {
            this.items = response.data.data;
            // Set the initial number of items
            this.totalRows = this.items.length
            this.dataLoaded = true;
          }).catch( error => {
              this.makeToast('Error','Could not load images, error: '+ error.response.status, 'danger')
            });        
        },
        refreshTable(){
          this.getBanners();
        },
 // submit form (add data)
      onSubmit(evt) {
          
        evt.preventDefault();
        const formData = new FormData();
        formData.append('image', this.imagePath);

        axios.post('banner/create', formData).then(response => {
              if(response.status == 200){
                this.makeToast('Added','New Banner Added','success')
                this.resetImage()
                this.getBanners()
              }
          }).catch( error => {
              this.makeToast('Error','Something went wrong, error: '+ error.response.status, 'danger')
          });
      },
   
        // delete data
        deleteOrder(id) {
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0080FF',
            cancelButtonColor: '#FF2645',
            confirmButtonText: 'Yes',
            focusCancel: true
          }).then((result) => {
            if (result.value) {
              axios.delete('banner/delete/'+ id).then(response => {
              if(response.status == 200){
                this.makeToast('Deleted','Banner Deleted','success')
                this.getBanners()
                this.hideModal()
              }
            }).catch( error => {
              this.makeToast('Error','Something went wrong, error: '+ error.response.status, 'danger')
            });
            }
          })
            ;
        },
        

       
    },
     
    created: function(){
        this.getBanners();         
    }, 
    
    computed: {
    }

}
</script>