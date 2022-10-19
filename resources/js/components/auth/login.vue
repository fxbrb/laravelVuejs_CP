<template>
    <div class="login">
        <p class="text-danger" v-if="error">{{ error }}</p>
        <form @submit.prevent="login">
            <input
                type="email"
                placeholder="Enter your Email"
                v-model="form.email"
            />
            <br />
            <input
                type="password"
                placeholder="Enter your Password"
                v-model="form.password"
            />
            <br />
            <input type="submit" value="Login" class="submit" />
        </form>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            error: "",
        };
    },

    methods: {
        login() {
            axios.post("api/login", this.form).then((res) => {
                if (res.data.success) {
                    localStorage.setItem("token", res.data.data.token);
                    this.$router.push("/admin/home");
                    toast.fire({
                        icon: "success",
                        title: res.data.message,
                    });
                    console.log(res.data);
                } else {
                    toast.fire({
                        icon: "error",
                        title: res.data.message,
                    });
                }
            });
        },
    },
};
</script>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Work sans", sans-serif;
    font-size: 16px;
}

.login {
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--dark);
    padding: 0;
    margin: 0;
    width: 100%;
    height: 100vh;

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
    align-items: center;

        input {
            background: rgba(228, 232, 243, 0.8);
            background-position: 0.5rem 0.6rem;
            border: none;

            padding: 0 0 0 4rem;

            width: 20em;
            height: 2.8em;
            outline: none;
            transition: background-color 0.4s;

            &:hover {
                background-color: rgba(255, 255, 255, 255);
            }
        }

        .submit {
            color: var(--white);
            background: var(--orange);
            padding: 0;
            width: 10em;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.4s;

            &:hover,
            &:focus {
                background: var(--light-orange);
                color: var(--white);
            }
        }

        .text-danger {
            color: red;
        }
    }
}
</style>
