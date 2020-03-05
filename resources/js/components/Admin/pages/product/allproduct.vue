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
              <li class="breadcrumb-item active">Product</li>
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
              <h3 class="card-title">Product List</h3>
               <div class="card-tools">
               </div>
            </div>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Size</th>
                  <th>image</th>
                  <th>Status</th> 
                  <th>Price</th>  
                  <th>Quantity</th>  
                  <th>Action</th>  
                </tr>
                </thead>
                <tbody>
                <tr v-for="category,index in getAllProduct" :key="category.id">
                  <td>{{index+1}}</td>
                  <td>{{category.name|shortlength(2,'...')}}</td>
                  <td>{{category.category.name}}</td>
                  <td>{{category.size}}</td>
                  <td><img :src="category.image1" style="max-height:40px;min-height: 40px;max-width: 40px;min-width: 40px"></td>
                  <td><a href="" @click.prevent="changeStatus(category.id)"><button class="btn btn-primary btn-sm">{{category.status}}</button></a></td>
                  <td>{{category.price}}</td>
                  <td>{{category.qty}}</td>

                  <!-- <td>{{category.created_at | timeformat}}</td> -->

                  <td>
                  	<a href=""><button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button></a>
                  	<router-link :to="`/admin/edit/product/${category.id}`"><button class="btn btn-primary btn-sm">Edit</button></router-link> 
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
		name:"allproducts",
    mounted(){
      this.$store.dispatch("showAdminProduct")
    },
    computed:{
      getAllProduct(){
        return this.$store.getters.getAdminProduct
      }
    },
    methods:{
      deleteProduct(id){
        axios.get('/admin/product/delete/'+id)
        .then(()=>{
            this.$store.dispatch("showAdminProduct")
            Toast.fire({
            icon: 'success',
            title: 'Product Deleted Successfully!'
          })
        })
        .catch(()=>{})
      },
      changeStatus(id){
        axios.get('/admin/status/update/'+id)
        .then(()=>{
            this.$store.dispatch("showAdminProduct")
            Toast.fire({
            icon: 'success',
            title: 'Status Updated Successfully!'
          })
        })
        .catch(()=>{})
      }, 
    }
	};
</script>
<style scoped>

</style>

 
