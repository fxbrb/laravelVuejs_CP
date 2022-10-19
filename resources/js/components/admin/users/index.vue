<template>
    <div class="app">
        <Base />
        <main>
            <div class="topBox">
                <h1>Utilisateurs</h1>
            </div>
            <table>
               <thead>
                    <tr>
                         <th>Photo</th>
                         <th>Nom & Prénom</th>
                         <th>Email</th>
                         <th>Role</th>
                         <th>Action</th>
                    </tr>
               </thead>
               <tbody v-if="users.length > 0">
                    <tr v-for="item in users" :key="item.id">
                         <td>{{item.photo}}</td>
                         <td>{{item.name}}</td>
                         <td>{{item.email}}</td>
                         <td>{{item.type}}</td>
                         <td></td>
                    </tr>
               </tbody>
               <tbody v-else>
                    <tr>
                         <td>Aucun utilisateur.</td>
                    </tr>
               </tbody>
            </table>
        </main>
    </div>
</template>

<script>
import Base from "../layouts/base.vue";
import axios from 'axios';
export default {

     data() {
          return {
               users: []
          }
     },

    components: {
        Base,
    },

    mounted() {
     axios.get('/api/users').then((res) => {
          this.users = res.data.users
          console.log(this.users)
     })
    }
};
</script>

<style></style>
