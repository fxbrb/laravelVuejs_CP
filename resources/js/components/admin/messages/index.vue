<template>
    <div class="app">
        <Base />
        <main>
            <div class="topBox">
                <h1>Mes messages</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nom & Prénom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-if="messages.length > 0">
                    <tr v-for="item in messages" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.subject }}</td>
                        <td>{{ item.description }}</td>
                        <td>
                            <span
                                class="message_read"
                                @click="update_status(item.id, 0)"
                                v-if="item.status === 1"
                            >
                                Lu
                            </span>
                            <span
                                class="unread_message"
                                @click="update_status(item.id, 1)"
                                v-else
                            >
                                Non Lu
                            </span>
                        </td>
                        <td>
                            <button @click="delete_message(item.id)">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td>Aucun message.</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>
</template>

<script>
import axios from "axios";
import Base from "../layouts/base.vue";
import "../layouts/base.scss";

export default {
    data() {
        return {
            messages: [],
        };
    },

    components: {
        Base,
    },

    mounted() {
        axios.get("/api/messages").then((res) => {
            this.messages = res.data.messages;
             // console.log(this.messages);
        });
    },

    methods: {
        update_status(id, status) {
            const formData = new FormData();
            formData.append("status", status);

            axios
                .post(`/api/messages/update_status/${id}`, formData)
                .then((res) => {
                    toast.fire({
                        type: "success",
                        title: "Status changer avec succes",
                    });
                    axios.get("/api/messages").then((res) => {
                        this.messages = res.data.messages;
                    //     console.log(this.messages);
                    });
                });
        },

        delete_message(id){
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
                    axios.delete("/api/messages/delete/" + id).then(() => {
                        Swal.fire(
                            "Supprimer",
                            "Message supprimer avec succes",
                            "success"
                        );
                    });
                }
                location.reload();
            });
        }
    },
};
</script>
