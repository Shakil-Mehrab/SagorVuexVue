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
              <li class="breadcrumb-item active">Add category</li>
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
                <h3 class="card-title">Add Category</h3>
              </div>
              <form role="form"  @submit.prevent="addCategory()">
                <div class="card-body">
            	    <div class="form-group">
                        <label for="country_id">Country</label>
                     	<select class="form-control"   :class="{ 'is-invalid': form.errors.has('country_id') }" v-model="form.country_id">
                     		<option disabled value="">Select One</option>
                            <option :value="cat.id" v-for="cat in getallCategory">{{cat.name}}</option>
                        </select>
	                    <has-error :form="form" field="country_id"></has-error>
	                </div>
					<div class="form-group">
						<label for="name">City Name</label>
						<input type="text" class="form-control" id="name" name="name" placeholder="Category Name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
						<has-error :form="form" field="name"></has-error>
					</div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
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
		    form: new Form({
			    name: '',
		        country_id:''
		    })
		}
	},
	mounted(){
		this.$store.dispatch("showAdminCountry")
	},
	computed:{
		getallCategory(){
	        return this.$store.getters.getAdminCountry
	    }
	},
	methods:{
		addCategory(){
			this.form.post('/admin/city/store')
			.then((response)=>{this.$router.push('/admin/all/city')
			  Toast.fire({
			    icon: 'success',
			    title: 'City Added Successfully!'
			  })
			})
			.catch(()=>{})
		}
	}
};
</script>
<style scoped>

</style>

 
