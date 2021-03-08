<template>
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-body">
                    <form @submit.prevent="submitContact">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" class="form-control" v-model="parameter.name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" v-model="parameter.email">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control" @keypress="acceptNumber($event)" v-model="parameter.phone_number" >
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color:green;border-color:green">Submit</button>
                    </form>
                    <button class="btn btn-primary" style="float:right;margin-top:-38px;background-color:red;border-color:red" @click="cancel()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['datacontact'],
    data(){
        return {
            parameter :{
                id : null,
                name : '',
                phone_number : '',
                email : '',
            },
            is_new : true
        }
    },
    mounted(){
        this.init();
    },
    methods :{
        init(){
            if(this.datacontact){
                this.is_new = false;
                this.parameter.id = this.datacontact.id;
                this.parameter.name = this.datacontact.name;
                this.parameter.phone_number = this.datacontact.phone_number;
                this.parameter.email = this.datacontact.email;
            }
        },
        cancel() {
            this.$router.push('/').catch(err => {})
        },
        acceptNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        },
        submitContact(){
            if(this.parameter.name === ''){
                alert("Please fill name!");
            }else if(this.parameter.email === ''){
                alert("Please fill password!");
            }else if(this.parameter.phone_number === ''){
                alert("Please fill phone number!");
            }else{
                if(this.is_new == true){
                    let url = `/api/add-contact`;
                    this.axios.post(url,this.parameter).then((response)=>{
                        if(response.data.success){
                            alert("Contact created!")
                            this.$router.push('/').catch(err => {})
                        }else{
                            alert("something went wrong");
                        }
                    }); 
                }else{
                    let url = `/api/edit-contact`;
                    this.axios.post(url,this.parameter).then((response)=>{
                        if(response.data.success){
                            alert("Success!")
                            this.$router.push('/').catch(err => {})
                        }else{
                            alert("something went wrong");
                        }
                    }); 
                }
            }

        }
    }
}
</script>