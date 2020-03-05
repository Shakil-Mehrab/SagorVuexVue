<template>
  <div class="shakillock">
   	<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><router-link to="/home">UserDashbord</router-link></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><router-link to="/home">UserDashbord</router-link></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content" v-if="getallCategory.status=='approved'">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="" alt="User profile picture">
                </div>
                 <p class="text-muted text-center"><a href="">Edit Profile</a></p>
                <h3 class="profile-username text-center">{{getallCategory.name}}</h3>
              </div>
            </div>
            <div class="card card-primary" style="margin-top: -20px">
              <div class="card-header">
                <span style="float:left"><h5 class="box-title">About Company</h5></span>
            	<span style="float:right"><h6 class="box-title"><a href="">Edit Membership</a></h6></span>
              </div>
              <div class="card-body">
               <p><img src="" width="5%" alt="flag"> Country :  {{getallCategory.company_name}}</p>
	            <p><i class="fas fa-city"></i> City :  {{getallCategory.city_id}}</p>
	            <p><i class="fas fa-city"></i> District :  {{getallCategory.district_id}}</p>
	            <p><i class="fas fa-align-justify"></i> Product Type :  {{getallCategory.category_id}}</p>
	            <p><i class="fas fa-phone"></i> {{getallCategory.user_id}}</p>
	            <p><i class="fas fa-envelope"></i> {{getallCategory.user_id}}</p>
	            <p><i class="fa fa-map-marker margin-r-5"></i>{{getallCategory.image}}</p>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header p-2">
               <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Company</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Documents</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                     <div class="post">
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <img class="img-fluid" :src="getallCategory.image" alt="Photo">
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" :src="getallCategory.image" alt="Photo">
                              <img class="img-fluid" :src="getallCategory.image" alt="Photo">
                            </div>
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" :src="getallCategory.image" alt="Photo">
                              <img class="img-fluid" :src="getallCategory.image" alt="Photo">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	<section class="content" v-if="getallCategory.status=='pending'">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary" style="margin-top: -20px">
              <div class="card-header" style="background-color:wheat;text-align:center">
                 <h3><strong style="color:green">You have created your membership</strong>.<br><span style="color:red">Please wait for your confirmation</span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
	







  </div>
</template>
<script>
	export default{
		name:"membershipinformation",
    mounted(){
       return this.$store.dispatch("showMembership")

    },
    computed:{
      getallCategory(){
        return this.$store.getters.getMembership
      }
    },
    methods:{
       deleteCategory(id){
        axios.get('/category/delete/'+id)
        .then(()=>{
            this.$store.dispatch("showUser")
            Toast.fire({
            icon: 'success',
            title: 'Category Deleted Successfully!'
          })
        })
        .catch(()=>{})
       }
    }
	}
</script>
<style scoped>

</style>

 
