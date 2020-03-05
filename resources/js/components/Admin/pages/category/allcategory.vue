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
              <li class="breadcrumb-item"><router-link to="/">Admin Dashboard</router-link></li>
              <li class="breadcrumb-item active">Category</li>
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
              <h3 class="card-title">Category List</h3>
               <div class="card-tools">
              <button class="btn btn-primary"><router-link to="/admin/add/category" style="color:white">Add Category</router-link></button>
            </div>
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Image</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="category in getallCategory">
                  <td>{{category.id}}</td>
                  <td>{{category.name}}</td>
                  <td><img :src="category.image" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td>
                  <td>{{category.created_at | timeformat}}</td>

                  <td>
                    <router-link :to="`/admin/edit/category/${category.id}`"><button class="btn btn-primary btn-sm">Edit</button></router-link> 
                    <a href="" @click.prevent="deleteCategory(category.id)"><button class="btn btn-danger btn-sm">Delete</button></a>
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
        name:"category",
    mounted(){
        this.$store.dispatch("showAdminCategory")//return bad dilam 1 tarikh
    },
    computed:{
      getallCategory(){
        return this.$store.getters.getAdminCategory
      }
    },
    methods:{
       deleteCategory(id){
        axios.get('admin/category/delete/'+id)
        .then(()=>{
            this.$store.dispatch("showAdminCategory")
            Toast.fire({
            icon: 'success',
            title: 'Category Deleted Successfully!'
          })
        })
        .catch(()=>{})
       }
    }
    };
</script>
<style scoped>

</style>

 
