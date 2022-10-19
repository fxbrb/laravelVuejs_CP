<template>
     <Sidebar />
     <Header />
   </template>
   
   <script>
   import Header from "../layouts/header.vue";
   import Sidebar from "../layouts/sidebar.vue";
   
   
   export default {
       components: {
           Header,
           Sidebar,
       },
   };
   </script>
   
   <style>
   
   </style>