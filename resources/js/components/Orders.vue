<template>

  <div>

    <b-card class="shadow-sm">

      <template v-slot:header>
        <h4 class="mb-0"><b-icon-inbox></b-icon-inbox> Orders <b-button variant="dark" class="float-right" @click="refreshTable()"><b-icon-bootstrap-reboot></b-icon-bootstrap-reboot> Refresh</b-button> </h4> 
      </template>
    
      <b-row class="mt-2">
        <b-col>
          Show <b-form-select class="form-control w-25" v-model="perPage" id="perPageSelect" size="sm" :options="pageOptions"></b-form-select> entries
        </b-col>
        <b-col>
          <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Search..." size="sm"></b-form-input>
        </b-col>
      </b-row>

      <b-table id="my-table" class="mt-2" :items="items" :per-page="perPage" :current-page="currentPage" :fields="fields" outlined bordered hover striped responsive  :filter="filter" @filtered="onFiltered">
        <template v-slot:cell(status)="row">

            <b-badge variant="warning" v-if="row.item.order_status == 'Pending'"><b-icon-stopwatch></b-icon-stopwatch> {{row.item.order_status }}</b-badge>
            <b-badge variant="success" v-else-if="row.item.order_status == 'Delivered'"> <b-icon-check-circle></b-icon-check-circle> {{row.item.order_status }}</b-badge>
            <b-badge variant="danger" v-else><b-icon-x-circle></b-icon-x-circle> {{row.item.order_status }}</b-badge>
     
        </template>  

        <template v-slot:cell(view)="row">
          <b-link v-bind:href="'order_details/'+ row.item.id" class="text-primary" target="_blank"><b-icon-eye></b-icon-eye> View</b-link>
        </template>  

        <template v-slot:cell(delete)="row">
        <b-link href="#" class="text-danger" @click="deleteOrder(row.item.id)"><b-icon-trash></b-icon-trash> Delete</b-link>
        </template>
      </b-table>
        <p class="text-center" v-if="totalRows == 0">No data available in table</p>

      <b-pagination v-model="currentPage" :total-rows="totalRows" :per-page="perPage" align="right" first-text="First" prev-text="Prev" next-text="Next" last-text="Last" class="mt-1"></b-pagination>

    </b-card>


  </div>

</template>

<script>

 export default {
    data(){
      return {
        //show: true,
          items: [],
          fields: [
            {key:'order_number', label:'Order', sortable: true, },
            {key:'customer.name', label:'Name', sortable: true, },
            {key:'created_at', label:'Date', sortable:true },
            {key:'total', label:'Total', sortable:true },
            {key:'order_type', label:'Type', sortable:true },
            {key:'status', label:'Status', sortable:true },
            {key:'view', label:'' },
            {key:'delete', label:'' }
          ],
          totalRows: 0,
          currentPage: 1,
          perPage:  10,
          pageOptions: [10, 25, 50, 100],
          filter: null,
         
      }
    },
       
    mounted() {
   
        },

    methods:{

   
      // fetch data 
      getOrders() {
        axios.get('orders/all').then(function(response){
          this.items = response.data.data;
          // Set the initial number of items
          this.totalRows = this.items.length
          }.bind(this));         
        },
refreshTable(){
 this.getOrders();
},

        // delete data
        deleteOrder(id) {
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
              axios.delete('order/delete/'+ id).then(response => {
              //console.log(response);
              this.getOrders()
            }).catch(err => { console.log(err)})  
            }
          })
            ;
        },
        
        // update status
        updateStatus(id, status) {
          
        },
        // Trigger pagination to update the number of buttons/pages due to filtering
        onFiltered(filteredItems) {
          this.totalRows = filteredItems.length
          this.currentPage = 1
        },
    },
     
    created: function(){
        this.getOrders();         
    }, 
    
    computed: {
    }

}
</script>