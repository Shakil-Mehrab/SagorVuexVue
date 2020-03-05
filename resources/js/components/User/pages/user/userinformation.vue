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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       :src="getallCategory.image" alt="User profile picture">
                </div>
                 <p class="text-muted text-center"><a href="">Edit Profile</a></p>
                <h3 class="profile-username text-center">{{getallCategory.name}}</h3>
              </div>
            </div>
            <div class="card card-primary" style="margin-top: -20px">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <div class="card-body">
               <p class="text-muted"><img :src="getallCategory.image" width="5%" alt="flag"> {{getallCategory.country_id}}</p>
               <p class="text-muted"><i class="fas fa-city"></i> {{getallCategory.city_id}}</p>
               <p class="text-muted"><i class="fas fa-city"></i> {{getallCategory.district_id}}</p>
               <p class="text-muted"><i class="fas fa-envelope"></i> {{getallCategory.email}}</p>
               <p><i class="fa fa-phone"></i>  {{getallCategory.cover_photo}}</p>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <div class="post">
                      <a href="">
                        <img class="img-responsive" :src="getallCategory.cover_photo" width="100%" style="height:330px" alt="Cover Photo">
                      </a>
	                </div>
                  </div>
                </div>
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
		name:"userinformation",
    mounted(){
       return this.$store.dispatch("showUser")

    },
    computed:{
      getallCategory(){
        return this.$store.getters.getUser
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

 
