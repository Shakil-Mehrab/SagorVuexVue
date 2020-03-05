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
              <div class="card-header text-center">
                <h3 class="card-title">Product Add</h3>
              </div>
              <form role="form"  @submit.prevent="editProduct()">

                <div class="card-body">
                	<div class="col-lg-12 col-md-12 col-sm-12 form-control" style="background: black;color:white">
                       <div class="title text-center"><h3>Basic Info</h3></div>
                    </div>
                    <div class="row">
                    	<div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="name">Name</label>
		                    <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
		                    <has-error :form="form" field="name"></has-error>
	                  </div>
	                   <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="brand" class="control-label">Brand</label>
		                    <input type="text" id="brand" name="brand" class="form-control" placeholder="Brand" v-model="form.brand" :class="{ 'is-invalid': form.errors.has('brand') }">
		                    <has-error :form="form" field="brand"></has-error>
		                </div>
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="price" class="control-label">Price</label>
		                    <input type="text" class="form-control" id="price" name="price" placeholder="Price (TK)" v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }">
		                    <has-error :form="form" field="price"></has-error>
		                </div>
                    </div>
                    <div class="row">
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
	                        <label for="category_id">Category</label>
	                     	<select class="form-control"   :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
	                     		<option disabled value="">Select One</option>
	                            <option :value="cat.id" v-for="cat in getallCategory">{{cat.name}}</option>
	                        	
	                        </select>
		                    <has-error :form="form" field="category_id"></has-error>
		                </div>
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="size">Size</label>
		                    <input type="text" class="form-control" id="size" name="size" placeholder="Size" v-model="form.size" :class="{ 'is-invalid': form.errors.has('size') }">
		                    <has-error :form="form" field="size"></has-error>
		                </div>
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="discount">Discount (%)</label>
		                    <input type="text" name="discount" id="discount" class="form-control" placeholder="Discount (%)"  v-model="form.discount" :class="{ 'is-invalid': form.errors.has('discount') }">
		                    <has-error :form="form" field="discount"></has-error>

		                </div>
		            </div>
		            <div class="col-lg-12 col-md-12 col-sm-12 form-control" style="background: black;color:white">
	                    <div class="title text-center"><h3>Quantity Info</h3></div>
	                </div>
		            <div class="row">
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="qty"><h4>Quantity</h4></label>
		                    <input type="text" id="qty" class="form-control" name="qty" placeholder="Quantity" v-model="form.qty" :class="{ 'is-invalid': form.errors.has('qty') }">
		                    <has-error :form="form" field="qty"></has-error>
		                 </div>
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="min_order"><h4>Minimum Order Quantity</h4></label>
		                    <input type="text" id="min_order" class="form-control" name="min_order" placeholder="Minimum Order Quantity" v-model="form.min_order" :class="{ 'is-invalid': form.errors.has('min_order') }">
		                    <has-error :form="form" field="min_order"></has-error>
		                </div>
		                <div class="form-group col-lg-4 col-md-4 col-sm-12">
		                    <label for="max_order"><h4>Maximum Order Quantity</h4></label>
		                    <input type="text" id="max_order" class="form-control" name="max_order" placeholder="Maximum Order Quantity" v-model="form.max_order" :class="{ 'is-invalid': form.errors.has('max_order') }">
		                    <has-error :form="form" field="max_order"></has-error>
		                </div>
		            </div>
		            <div class="col-lg-12 col-md-12 col-sm-12 form-control" style="background: black;color:white">
	                    <div class="title text-center"><h3>Detail Information</h3></div>
	                </div>
		             <div class="row">
	                  <div class="form-group col-lg-12">
	                       <textarea class="form-control" id="detail" name="detail" placeholder="Detailed Information" v-model="form.detail" :class="{ 'is-invalid': form.errors.has('detail') }"></textarea>
		                    <has-error :form="form" field="detail"></has-error>

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
		        name: '',
		        brand: '',
		        price: '',
		        qty: '',
		        min_order: '',
		        max_order: '',
		        discount: '',
		        size: '',
		        category_id: '',
		        detail: '',

		      })
		    }
		},
		mounted(){
			this.$store.dispatch("showCategory")
			axios.get(`user/product/${this.$route.params.id}/edit`)
			.then((response)=>{this.form.fill(response.data.product);})
			.catch(()=>{})
		},
		computed:{
			getallCategory(){return this.$store.getters.getCategory}
		},
		methods:{
		    editProduct(){
		      	this.form.post(`user/product/update/${this.$route.params.id}`)
		      	.then((response)=>{
		      	  // this.$router.push('/edit/product/image/'+response.data.product)
		          Toast.fire({
		            icon: 'success',
		            title: 'Product Updated Successfully!'
		          })
		        })
		      	.catch(()=>{})
		    }
		}
	};
</script>
<style scoped>

</style>

 
