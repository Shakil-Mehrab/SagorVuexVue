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
                  <li class="breadcrumb-item"><router-link to="/">Dashboard</router-link></li>
                  <li class="breadcrumb-item active">Country</li>
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
                  <h3 class="card-title">Country List</h3>
                   <div class="card-tools">
                    <button class="btn btn-primary"><router-link to="/admin/add/country" style="color:white">Add Country</router-link></button>
                  </div>
                </div>
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>ID</th>
                      <th>Country Name</th>
                      <th>Pavilion</th>
                      <th>Flag</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="category in getallCountry">
                      <td>{{category.id}}</td>
                      <td>{{category.name}}</td>
                      <td>{{category.pavilion==1?"Yes":"No"}}</td>
                      <td><img :src="category.image" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td>
                      <td>
                        <router-link :to="`/admin/edit/country/${category.id}`"><button class="btn btn-primary btn-sm">Edit</button></router-link> 
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
       return this.$store.dispatch("showAdminCountry")
    },
    computed:{
      getallCountry(){
        return this.$store.getters.getAdminCountry
      }
    },
    methods:{
      deleteProduct(id){
        axios.get('/admin/country/delete/'+id)
        .then(()=>{
            this.$store.dispatch("showAdminCountry")
            Toast.fire({
            icon: 'success',
            title: 'Country Deleted Successfully!'
          })
        })
        .catch(()=>{})
      }
    }
};
</script>

<style scoped>

</style>

 
