<template>
    <div>
    <div class="row justify-content-md-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">Main Menu</div>
        <div class="card-body">
            <div class="form-group">
                <label for="score">Contact List</label>
                <button type="submit" class="btn btn-primary" style="background-color : blue !important;border-color : blue !important;float : right; margin-right:10px;" @click="newContact()">ADD NEW CONTACT</button>
            </div>
            <div class="form-group"></div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody v-for="contacts in contact_list">
                    <tr>
                        <td>{{contacts.name}}</td>
                        <td>{{contacts.email}}</td>
                        <td>{{contacts.phone_number}}</td>
                        <td align="center"><router-link :to="{name: 'newcontact', params: { datacontact: contacts }}" class="btn btn-primary" style="background-color : green !important;border-color : green">Edit</router-link></td>
                        <td align="center"><button type="submit" class="btn btn-primary" style="background-color : red !important;border-color : red !important;" @click="deletedata(contacts.id)">DELETE</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            contact_list : {},
        }
    },
    mounted(){
        this.init();
    },
    methods :{
        click : function(){
            if(confirm("Do you really want to play?")){
                this.$router.push({name: 'gamepage'});
            }
        },
        init (){
                let url = `/api/contact-list`;
                this.axios.get(url).then((response) => {
                if(response.data.success){
                    this.contact_list = response.data.data;
                }else{
                    alert("something went wrong");
                }
            });
        },
        deletedata (id){
            var formData = new FormData();
            formData.append('id',id);
            if(confirm("Are you sure ? ")){
                let url = `/api/delete-contact`;
                this.axios.post(url,formData).then((response) => {
                    if(response.data.success){
                        alert("Delete success!");
                        location.reload();
                    }else{
                        alert("something went wrong");
                    }
                });
            }
        },
        newContact () {
            this.$router.push('/new-contact').catch(err => {})
        },
    }
}
</script>