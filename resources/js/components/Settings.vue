<template>

  <div>

    <b-card class="shadow-sm">

      <template v-slot:header>
        <h4 class="mb-0"><i class="fas fa-cog"></i> Store Settings <b-button variant="primary" @click="saveChanges" class="float-right" v-if="user_role == 'main'">Save Changes</b-button> </h4> 
      </template>
    
      <b-row class="mt-2">
        <b-col>
        </b-col>
        <b-col>
          <b-form-input v-model="filter" type="search" id="filterInput" placeholder="Search..." size="sm"></b-form-input>
        </b-col>
      </b-row>

      <b-table id="my-table" class="mt-2" :items="items" :fields="fields" :per-page="perPage" outlined responsive header="false" :filter="filter" @filtered="onFiltered">
        <template v-slot:cell(name)="row">
       <p>

      {{row.item.id}} - {{capitalizeFirstLetter(row.item.name)}}</p>        
        </template>
       <template v-slot:cell(input)="row">
        <b-form-textarea v-model="form[row.item.id]" ></b-form-textarea>        
        </template>
      </b-table>
        <div class="text-center" v-if="!dataLoaded">
        <b-spinner variant="primary"></b-spinner>
      </div>
        
    </b-card>


  </div>

</template>

<script>

 export default {
   props: ['user_role'],
    data(){
      return {
        form: {},
        items: [],
        fields: [
            {key:'name', label:'', sortable: false, },
            {key:'input', label:'', sortable: false, },
        ],
        totalRows: 0,
        currentPage: 1,
        perPage:  100,
        filter: null,
        dataLoaded: false,
         
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
      
        saveChanges(){
            var jsonData = this.form
            axios.put('settings/update', jsonData).then(response => {
              if(response.status == 200){
                 this.makeToast('Changes saved','Saved','success')
              }
            }).catch( error => {
              this.makeToast('Error','Something went wrong, error: '+ error.response.status, 'danger')
            });
        },
    // fetch data 
      getSettings() {
        axios.get('settings/all').then(function(response){
          this.items = response.data.data;
          this.items.forEach(element => {
              this.form[element.id] = element.value;
          });
          // Set the initial number of items
          this.totalRows = this.items.length
          this.dataLoaded = true;
          
          }.bind(this));         
        },
               
        capitalizeFirstLetter(string){
            return string.charAt(0).toUpperCase() + string.slice(1).replace('_',' ')
        },
        // Trigger pagination to update the number of buttons/pages due to filtering
        onFiltered(filteredItems) {
          this.totalRows = filteredItems.length
          this.currentPage = 1
        },
    },
     
    created: function(){
        this.getSettings();         
    }, 
    
    computed: {
    }

}
</script>