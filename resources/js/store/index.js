 export default{
 	state: {
    product: [],
    user: [],
    membership: [],
//admin
    adminProduct: [],
    category: [],
    country: [],
    citiy:[],
    district: [],
  },
  getters:{
    getProduct(state){
      return state.product;
    },
    getUser(state){
      return state.user;
    },
    getMembership(state){
      return state.membership;
    },
//admin
    getAdminProduct(state){
      return state.adminProduct;
    },
    getAdminCategory(state){
      return state.category;
    },
    getAdminCountry(state){
      return state.country;
    },
    getAdminCity(state){
      return state.citiy;
    },
    getAdminDistrict(state){
      return state.district;
    },
  },
  actions:{
    showProduct(context){
       axios.get('/user/product')
       .then((response)=>{context.commit('products',response.data.products)})
    },
    showUser(context){
       axios.get('/user/user')
       .then((response)=>{context.commit('user',response.data.user)})
    },
     showMembership(context){
       axios.get('/user/membership')
       .then((response)=>{context.commit('membership',response.data.membership)})
    },
//admin
    showAdminProduct(context){
       axios.get('/admin/product')
       .then((response)=>{context.commit('adminproducts',response.data.adminproducts)})
    },
    showAdminCategory(context){
       axios.get('/admin/category')
       .then((response)=>{context.commit('admincategories',response.data.admincategories)})
    },
    showAdminCountry(context){
       axios.get('/admin/country')
       .then((response)=>{context.commit('admincountries',response.data.admincountries)})
    },
    showAdminCity(context){
       axios.get('/admin/city')
       .then((response)=>{context.commit('admincities',response.data.admincities)})
    },
    showAdminDistrict(context){
       axios.get('/admin/district')
       .then((response)=>{context.commit('admindistricts',response.data.admindistricts)})
    },
  },
  mutations: {
    products(state,data) {
      return state.product=data;
    },
    user(state,data) {
      return state.user=data;
    },
    membership(state,data) {
      return state.membership=data;
    },
//admin
    adminproducts(state,data) {
      return state.adminProduct=data;
    },
    admincategories(state,data) {
      return state.category=data;
    },
    admincountries(state,data) {
      return state.country=data;
    },
    admincities(state,data) {
      return state.citiy=data;
    },
    admindistricts(state,data) {
      return state.district=data;
    },
  },
 }
 
