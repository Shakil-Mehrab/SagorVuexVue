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
              <li class="breadcrumb-item"><router-link to="/admin/all/category">Category</router-link></li>
              <li class="breadcrumb-item active">Edit category</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-header text-center">
                <h3 class="card-title">Edit Category</h3>
              </div>
              <form role="form"  @submit.prevent="updateCategory()" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input @change="changePhoto($event)" type="file" name="image" id="image" :class="{ 'is-invalid': form.errors.has('image') }">
                          <img :src="form.image" alt="show" width="100" height="100">
                           <has-error :form="form" field="image"></has-error>
                        </div>
                      </div>
                  </div>


                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
	export default{
		name:"store",
		data () {
			    return {
			      // Create a new form instance
			      form: new Form({
			        name: '',
              image:'',
			      })
			    }
			},
    mounted(){
      axios.get(`admin/category/${this.$route.params.id}/edit`)
      .then((response)=>{
        this.form.fill(response.data.product);
      })
      .catch(()=>{})
    },
		methods:{
      changePhoto(event){
          let file = event.target.files[0];
          let reader = new FileReader();
          reader.onload = event =>{
            this.form.image = event.target.result
          };
          reader.readAsDataURL(file);
      },
      updateCategory(){
        this.form.post(`admin/category/update/${this.$route.params.id}`)
        .then((response)=>{
          // this.$router.push('/edit/product/image/'+response.data.product)
          Toast.fire({
            icon: 'success',
            title: 'Category Updated Successfully!'
          })
      })
        .catch(()=>{})
      },
    }
	};
</script>
<style scoped>

</style>

 
