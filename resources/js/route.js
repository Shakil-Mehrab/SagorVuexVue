import userHome from './components/user/userHome.vue';

import allProduct from './components/User/pages/products/allproduct.vue';
import addProduct from './components/User/pages/products/create.vue';
import editProductImage from './components/User/pages/products/editProductImage.vue';
import editProduct from './components/User/pages/products/edit.vue';

import userInformation from './components/User/pages/user/userinformation.vue';
import membershipInformation from './components/User/pages/user/membership/membershipinformation.vue';

// admin
import adminDashboard from './components/Admin/adminDashboard.vue';

import adminAllProduct from './components/Admin/pages/product/allproduct.vue';
import editAdminProduct from './components/Admin/pages/product/edit.vue';

import adminAllCategory from './components/Admin/pages/category/allcategory.vue';
import addCategory from './components/admin/pages/category/create.vue';
import editCategory from './components/admin/pages/category/edit.vue';

import adminAllCountry from './components/Admin/pages/country/allcountry.vue';
import addCountry from './components/admin/pages/country/create.vue';
import editCountry from './components/admin/pages/country/edit.vue';

import adminAllCity from './components/Admin/pages/city/allcity.vue';
import addCity from './components/admin/pages/city/create.vue';
import editCity from './components/admin/pages/city/edit.vue';

import adminAllDistrict from './components/Admin/pages/district/alldistrict.vue';
import addDistrict from './components/admin/pages/district/create.vue';
import editDistrict from './components/admin/pages/district/edit.vue';

import adminMembershipInformation from './components/Admin/pages/membership/membershipinformation.vue';
import adminUserInformation from './components/Admin/pages/user/userinformation.vue';


export const routes = [
  { path: '/home', component: userHome },

  { path: '/all/product', component: allProduct},
  { path: '/add/product', component: addProduct},
  { path: '/edit/product/:id', component: editProduct},
  { path: '/edit/product/image/:id', component: editProductImage},

  { path: '/user/information', component: userInformation},
  { path: '/membership/information', component: membershipInformation},

// admin
  { path: '/', component: adminDashboard},

  { path: '/admin/all/product', component: adminAllProduct},
  { path: '/admin/edit/product/:id', component: editAdminProduct},

  { path: '/admin/all/category', component: adminAllCategory},
  { path: '/admin/add/category', component: addCategory},
  { path: '/admin/edit/category/:id', component: editCategory},

  { path: '/admin/all/country', component: adminAllCountry},
  { path: '/admin/add/country', component: addCountry},
  { path: '/admin/edit/country/:id', component: editCountry},

  { path: '/admin/all/city', component: adminAllCity},
  { path: '/admin/add/city', component: addCity},
  { path: '/admin/edit/city/:id', component: editCity},

  { path: '/admin/all/district', component: adminAllDistrict},
  { path: '/admin/add/district', component: addDistrict},
  { path: '/admin/edit/district/:id', component: editDistrict},

  { path: '/admin/membership/information', component: adminMembershipInformation},
  { path: '/admin/user/information', component: adminUserInformation},




]