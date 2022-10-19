<template>
     <router-view v-slot="{ Component }">
      <transition name="slide" mode="out-in"> 
        <Component :is="Component"/>
      </transition>
     </router-view>
   </template>
   
   <script>
   export default {
   
   }
   </script>
   