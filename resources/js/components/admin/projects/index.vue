<template>
    <div class="app">
        <Base />
        <main>
            <div class="topBox">
                <h1>Mes projets</h1>
                <router-link :to="{ name: 'adminProjectNew'}"
                    >Crée un projet</router-link
                >
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Lien</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="projects.length > 0">
                    <tr v-for="item in projects" :key="item.id">
                        <td v-if="item.photo">
                            <img
                                :src="projectImg(item.photo)"
                                alt="projectImg"
                            />
                        </td>
                        <td v-else>
                            <img :src="defaultImg" alt="" />
                        </td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.description }}</td>
                        <td>
                            <a :href="item.link">{{ item.link }}</a>
                        </td>
                        <td>
                            <div class="project_actions">
                                <router-link :to=" {
                                    name: 'adminProjectEdit',
                                    params: {id: item.id}
                                }">
                                    <i class="bx bx-edit"></i>
                                </router-link>
                                <button @click="delete_project(item.id)">
                                    <i class="bx bxs-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td>Aucun projet.</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</template>

<script>
import Base from "../layouts/base.vue";
import axios from "axios";
import '../layouts/base.scss'

export default {
    data() {
        return {
            projects: [],
            defaultImg: "https://via.placeholder.com/150x100",
        };
    },

    components: {
        Base,
    },

    mounted() {
        axios.get("/api/projects").then((res) => {
            this.projects = res.data.data;
            console.log(this.projects);
        });
    },

    methods: {
        projectImg(img) {
            return "/img/upload/" + img;
        },

        delete_project(id) {
            Swal.fire({
                title: "Tu es sur ?",
                text: "Tu ne peux pas revenir en arrière",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, je veux le supprimer",
            }).then((res) => {
                if (res.value) {
                    axios.delete("/api/project/delete/" + id).then(() => {
                        Swal.fire(
                            "Supprimer",
                            "Project supprimer avec succes",
                            "success"
                        );
                    });
                }
                location.reload();
            });
        },
    },
};
</script>


