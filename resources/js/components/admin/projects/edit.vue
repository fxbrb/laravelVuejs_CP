<template>
    <div class="app">
        <Base />
        <main>
            <div class="topBox">
                <h1>Editer un projet</h1>
                <button @click="goBack()">Annuler</button>
            </div>
            <form @submit.prevent="update_project()">
                <div class="form_box">
                    <label for="title">Titre</label>
                    <input type="text" v-model="project.title" />
                </div>
                <div class="form_box">
                    <label for="description">Description</label>
                    <textarea
                        cols="10"
                        rows="5"
                        v-model="project.description"
                    ></textarea>
                </div>
                <div class="form_box">
                    <label for="link">Lien</label>
                    <input type="text" v-model="project.link" />
                </div>
                <div class="form_box">
                    <label for="photo">Photo</label>
                    <div class="project_img">
                        <img :src="get_projectImg()" alt="projectImage" />
                        <input type="file" @change="upload_projectImg" />
                    </div>
                </div>
                <div class="submitBtn">
                    <button>Editer mon projet</button>
                </div>
            </form>
        </main>
    </div>
</template>

<script>
import Base from "../layouts/base.vue";
export default {
    data() {
        return {
            project: {
                photo: '',
            },
        };
    },

    components: {
        Base,
    },

    mounted() {
        axios.get(`/api/project/edit/${this.$route.params.id}`).then((res) => {
            this.project = res.data.project
            console.log(this.project)
        });
    },

    methods: {
        goBack() {
            this.$router.go(-1);
        },

        update_project(){
            axios.put(`/api/project/update/${this.$route.params.id}`, {
                title: this.project.title,
                description: this.project.description,
                link: this.project.link,
                photo: this.project.photo
            })
            .then(() => {
                this.$router.push('/admin/projects')
                toast.fire({
                    icon: 'success',
                    title: 'Projet mis a jour.'
                })
            })
        },

        get_projectImg() {
             let photo = "https://via.placeholder.com/170x170";
             if (this.project.photo) {
                 if (this.project.photo.indexOf("base64") != -1) {
                     photo = this.project.photo;
                 } else {
                     photo = "/img/upload/" + this.project.photo;
                 }
             }
             return photo;
         },

         upload_projectImg(e) {
             let file = e.target.files[0];
             let reader = new FileReader();
 
             if (file["size"] < 2111775) {
                 reader.onloadend = (file) => {
                     this.project.photo = reader.result;
                 };
                 reader.readAsDataURL(file);
             } else {
                 swal({
                     icon: "error",
                     title: "Erreur",
                     text: "Fichier trop volumineux!",
                 });
             }
         },
    },
};
</script>

<style lang="scss" scoped>
form {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    .form_box {
         display: flex;
         flex-direction: column;
         gap: 5px;
         width: 50%;
 
         label {
             font-size: 13px;
             color: var(--grey);
         }
 
         input,
         textarea {
             border: none;
             border-bottom: 1px solid rgb(136, 136, 136, 0.3);
             background: var(--light-grey);
             outline: none;
             padding: 0.5rem 0;
             font-size: 15px;
         }
 
         textarea {
             resize: vertical;
         }
 
         input[type="file"]::file-selector-button {
             margin: 0;
             padding: 15px 30px;
             color: var(--dark);
             border-radius: 10px;
             transition: all 300ms ease;
             cursor: pointer;
             margin-right: 5px;
             border: none;
 
             &:hover {
                 background: var(--white);
                 color: var(--dark);
                 border: 1px solid var(--dark);
             }
         }
 
         .project_img {
             display: flex;
             gap: 30px;
             align-items: flex-end;
 
             img {
                 width: 170px;
                 height: 170px;
                 object-fit: cover;
             }
             input {
                 border: none;
             }
         }
     }
}
</style>