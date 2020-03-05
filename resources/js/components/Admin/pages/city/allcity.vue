<template>
    <div class="shakillock">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1><router-link to="/">Admin Dashboard</router-link></h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><router-link to="/">Dashborad</router-link></li>
                  <li class="breadcrumb-item active">City</li>
                </ol>
              </div>
            </div>
          </div>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">City List</h3>
                   <div class="card-tools">
                    <button class="btn btn-primary"><router-link to="/admin/add/city" style="color:white">Add City</router-link></button>
                  </div>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Country</th>
                      <th>City</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in getallCountry">
                      <td>{{category.id}}</td>
                      <td>{{category.country.name}}</td>
                      <td>{{category.name}}</td>
                      <td>
                        <router-link :to="`/admin/edit/city/${category.id}`"><button class="btn btn-primary btn-sm">Edit</button></router-link> 
                        <a href="" @click.prevent="deleteProduct(category.id)"><button class="btn btn-danger btn-sm">Delete</button></a>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section> 
    </div>
</template>
<script>
export default{
    name:"country",
    mounted(){
    this.$store.dispatch("showAdminCity")
    },
    computed:{
      getallCountry(){
        return this.$store.getters.getAdminCity
      }
    },
    methods:{
      deleteProduct(id){
        axios.get('/admin/city/delete/'+id)
        .then(()=>{
            this.$store.dispatch("showAdminCity")
            Toast.fire({
            icon: 'success',
            title: 'City Deleted Successfully!'
          })
        })
        .catch(()=>{})
      }
    }
};
</script>

<style scoped>

</style>

 
