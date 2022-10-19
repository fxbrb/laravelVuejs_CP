<template>
    <div class="app">
        <Base />
        <main>
            <div class="topBox">
                <h1>Editer mon profil</h1>
                <button @click="goBack()">Annuler</button>
            </div>
            <form @submit.prevent="updateAbout()">
                <div class="form_left_part">
                    <div class="form_box">
                        <label for="name">Nom & Prénom</label>
                        <input type="text" v-model="about.name" />
                    </div>
                    <div class="form_box">
                        <label for="email">Email</label>
                        <input type="email" v-model="about.email" />
                    </div>
                    <div class="form_box">
                        <label for="phone">Téléphone</label>
                        <input type="text" v-model="about.phone" />
                    </div>
                    <div class="form_box">
                        <label for="address">Adresse</label>
                        <input type="text" v-model="about.address" />
                    </div>
                    <div class="form_box">
                        <label for="tagline">Slogan</label>
                        <input type="text" v-model="about.tagline" />
                    </div>
                </div>
                <div class="form_right_part">
                    <div class="form_box">
                        <label for="description">Description</label>
                        <textarea v-model="about.description"></textarea>
                    </div>
                    <div class="form_box">
                        <label for="photo">Photo</label>
                        <div class="about_img">
                            <img :src="get_avatar()" alt="aboutImage" />
                            <input type="file" @change="upload_avatar" />
                        </div>
                    </div>
                    <div class="form_box">
                        <div class="about_cv">
                            <label for="cv">CV</label>
                            <input type="file" @change="upload_cv" />
                        </div>
                    </div>
                </div>
                <div class="submitBtn">
                    <button type="submit">Mettre à jour</button>
                </div>
            </form>
        </main>
    </div>
</template>

<script>
import Base from "../layouts/base.vue";
import axios from "axios";
import { ref } from "vue";

export default {
    data() {
        return {
            about: {
                name: "",
                photo: "",
                email: "",
                phone: "",
                address: "",
                description: "",
                tagline: "",
                cv: "",
            },
        };
    },
    components: {
        Base,
    },

    mounted() {
        axios.get("/api/about").then((res) => {
            this.about = res.data;
            console.log(this.about);
        });
    },

    methods: {
        goBack() {
            this.$router.go(-1);
        },

        updateAbout() {
            axios
                .post(`/api/edit/about/${this.about.id}`, this.about)
                .then((res) => {
                    console.log(res.data);
                    toast.fire({
                        icon: "success",
                        title: "Informations mit a jour",
                    });
                    this.$router.push("/admin/home");
                });
        },

        upload_avatar(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file["size"] < 2111775) {
                reader.onloadend = (file) => {
                    this.about.photo = reader.result;
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

        upload_cv(e) {
            let file = e.target.files[0];
            let reader = new FileReader();

            if (file["size"] < 2111775) {
                reader.onloadend = (file) => {
                    this.about.cv = reader.result;
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

        get_avatar() {
            let photo = "/img/user.png";
            if (this.about.photo) {
                if (this.about.photo.indexOf("base64") != -1) {
                    photo = this.about.photo;
                } else {
                    photo = "/img/upload/" + this.about.photo;
                }
            }
            return photo;
        },
    },
};
</script>

<style lang="scss" scoped>
form {
    display: flex;
    width: 100%;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 0 1rem;

    .form_left_part,
    .form_right_part {
        width: 50%;
        display: flex;
        flex-direction: column;
        padding: 0 1.5rem;
        gap: 15px;
    }

    .form_box {
        display: flex;
        flex-direction: column;
        gap: 5px;

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

        .about_img {
            display: flex;
            gap: 10px;
            align-items: flex-end;

            img {
                width: 250px;
                height: 250px;
                object-fit: cover;
            }
            input {
                border: none;
            }
        }

        .about_cv {
            display: flex;
            flex-direction: column;
            gap: 5px;

            input {
                border: none;
            }
        }
    }

    .submitBtn {
        margin-top: 1.5rem;

        button {
            margin: 0;
            padding: 0.7rem 1rem;
            color: var(--light-grey);
            background: var(--dark);
            border-radius: 10px;
            transition: all 300ms ease;
            cursor: pointer;
            border: none;

            &:hover {
                background: var(--white);
                color: var(--dark);
                border: 1px solid var(--dark);
            }
        }
    }
}
</style>
