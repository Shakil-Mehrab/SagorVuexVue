<template>
  <div class="shakillock">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a href="/admin">UserDashboard</a></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/home">Product</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-around">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Add</h3>
              </div>
              <form role="form"  @submit.prevent="editProductImage()" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 form-control" style="background: black;color:white">
                       <div class="title text-center"><h3>Basic Info</h3></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input @change="changePhoto($event)" type="file" name="image1" id="image1" :class="{ 'is-invalid': form.errors.has('image1') }">
                                <img :src="form.image1" alt="show" width="100" height="100">
                                 <has-error :form="form" field="image1"></has-error>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-success form-control"> Submit Product</button>
                        </div>
                    </div>
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
                    image1: ''
                  })
                }
            },
        mounted(){
          
        },
        computed:{
            getallCategory(){
                return this.$store.getters.getCategory
            }
        },
        methods:{
            changePhoto(event){
                let file = event.target.files[0];
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.image1 = event.target.result
                };
                reader.readAsDataURL(file);
            },
          editProductImage(){
            console.log(this.form.image1);
            this.form.post(`/user/product/image/update/${this.$route.params.id}`)
            .then((response)=>{
              // this.$router.push('/edit/product/image/'+response.data.product)
              Toast.fire({
                icon: 'success',
                title: 'Product Added Successfully!'
              })
          })
            .catch(()=>{})
          }
        }
    };
</script>
<style scoped>

</style>

 
