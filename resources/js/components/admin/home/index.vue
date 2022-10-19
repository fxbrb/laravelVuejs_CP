<template>
    <div class="app">
        <Base />
        <main>Home content</main>
    </div>
</template>

<script>
import Base from "../layouts/base.vue";

export default {
    data() {
        return {};
    },
    components: {
        Base,
    },
};
</script>

<style lang="scss">
:root {
    --dark: #223843;
    --white: #eff1f3;
    --light-grey: #dbd3d8;
    --light-orange: #d8b4a0;
    --orange: #d77a61;
    --sidebar-width: 300px;
}

body {
    background: var(--light);

    .slide-enter-from,
    .slide-leave-to {
        opacity: 0;
        transform: translateX(-100%);
    }

    .slide-enter-active,
    .slide-leave-active {
        transition: 0.3s ease-out;
    }
}
button {
    cursor: pointer;
    appearance: none;
    border: none;
    outline: none;
    background: none;
}
.app {
    display: flex;
    main {
        background: var(--light-grey);
        transition: 0.4s ease-in-out;
        flex: 1 1 0;
        padding: 6rem 1rem 0;

        @media (max-width: 1024px) {
            padding-left: 6rem;
        }

        .topBox {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5rem;
            align-items: center;

            padding: 1rem 1rem 0;

            a {
                padding: 1rem;
                background: var(--orange);
                text-decoration: none;
                color: var(--white);
                border-radius: 6px;
                transition: 0.3s ease;

                &:hover {
                    background: var(--white);
                    color: var(--orange);
                    border: 1px solid var(--orange);
                }
            }

            h1 {
                font-size: 20px;
                color: var(--dark);
                text-decoration: underline;
            }
        }
    }
}
</style>
