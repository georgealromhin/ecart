<template>

<div>

        <b-form @submit="onSubmit">
      
            <b-form-group id="input-group-1" label="Name*" label-for="input-1">
                <b-form-input id="input-1" class="shadow-sm" v-model="form.name" required placeholder="Enter name" ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Email*" label-for="input-2">
                <b-form-input id="input-2" class="shadow-sm" v-model="form.email" type="email" required placeholder="Enter email"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label="Message*" label-for="input-3" >
                <b-form-textarea id="input-3" class="shadow-sm" v-model="form.message"></b-form-textarea>
            </b-form-group>

            <b-button type="submit" variant="danger" class="w-100 float-right shadow-sm border-0">Submit</b-button>
        </b-form>
  </div>

</template>

<script>

 export default {

    data(){
      return {
        form: { name: '', email: '', message: '', },
      }
    },
       
    mounted() {
   
        },

    methods:{
        onSubmit(evt) {
            evt.preventDefault();

            Swal.fire({title: '',text: 'Sending...',allowEscapeKey: false, allowOutsideClick: false});
            Swal.showLoading();
            const formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('email', this.form.email);
            formData.append('message', this.form.message);

            
            axios.post('send_mail' , formData).then(response => {

                if(response.status == 200){
                     Swal.fire('Success', response.data.msg ,'success');
                     this.resetForm()
                }

          }).catch( error => {
                Swal.fire('Error', error.response.data.message ,'error');
            });
      },
       resetForm() {
            this.form.name = ''
            this.form.email = ''
            this.form.message = ''
       }


    },
     
    created: function(){

    }, 
    
    computed: {
    }

}
</script>