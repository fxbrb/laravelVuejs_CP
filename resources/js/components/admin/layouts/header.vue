<template>
    <nav>
        <div class="nav-container">
            <div class="user-info">
                <div class="user-info-item">
                    <p>{{ name }}</p>
                    <p>{{ email }}</p>
                </div>
                <button @click="logout()">
                    <i class="bx bx-log-out"></i>
                </button>
            </div>
        </div>
    </nav>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            name: "",
            email: "",
        };
    },
    mounted() {
        axios.get("/api/user").then((res) => {
            (this.name = res.data.name), (this.email = res.data.email);
        });
    },

    methods: {
        logout() {
            localStorage.removeItem("token");
            this.$router.push("/login");
        },
    },
};
</script>

<style lang="scss" scoped>
nav {
    width: calc(100% - 2rem - 32px);
    background: var(--white);
    position: fixed;
    border-bottom: 1px solid rgba(100, 116, 139, 0.25);
    right: 0;
    transition: 0.4s ease-in-out;

    .nav-container {
        display: flex;
        padding: 1.2rem 1rem;
        justify-content: flex-end;

        .user-info {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: center;

            i {
                font-size:20px;
                color: var(--dark);
            }
        }
    }
}
</style>
