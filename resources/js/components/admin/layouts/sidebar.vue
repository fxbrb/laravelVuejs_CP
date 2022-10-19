<template>
    <!-- Nav Main -->
    <aside :class="`${is_expanded ? 'is-expanded' : ''}`">
        <div class="logo">
            <span>FXB</span>
            <span>PORTFOLIO ADMIN</span>
        </div>

        <div class="menu-toggle-wrap">
            <button class="menu-toggle" @click="is_expanded = !is_expanded">
                <i class="bx bx-chevrons-right box-icons"></i>
            </button>
        </div>

        <h3>Menu</h3>
        <div class="menu">
            <router-link to="/admin/home" class="button">
                <i class="bx bx-home box-icons"></i>
                <span class="text">Home</span>
            </router-link>
            <router-link :to="{ name: 'adminUserIndex' }" class="button">
                <i class="bx bx-user box-icons"></i>
                <span class="text">Utilisateurs</span>
            </router-link>
            <router-link :to="{ name: 'adminAbout' }" class="button">
                <i class="bx bx-info-circle box-icons"></i>
                <span class="text">About</span>
            </router-link>
            <router-link to="/admin/projects" class="button">
                <i class='bx bx-folder-open box-icons'></i>
                <span class="text">Project</span>
            </router-link>
            <router-link to="/admin/messages" class="button">
                <i class='bx bx-envelope box-icons'></i>
                <span class="text">Messages</span>
            </router-link>
        </div>

        <div class="flex"></div>

        <div class="menu">
            <router-link to="/settings" class="button">
                <i class="bx bxs-cog box-icons"></i>
                <span class="text">Settings</span>
            </router-link>
        </div>
    </aside>
    <!-- End Nav Main -->
</template>

<script>
import { ref, computed } from "vue";

const isExpandedRef = ref(localStorage.getItem("is_expanded") === "true");

window.IS_EXPANDED = computed({
    get() {
        return isExpandedRef.value;
    },
    set(value) {
        isExpandedRef.value = !!value;
        localStorage.setItem("is_expanded", isExpandedRef.value);
    },
});

export default {
    data() {
        return {
            is_expanded: window.IS_EXPANDED,
        };
    },
};
</script>

<style lang="scss" scoped>
aside {
    display: flex;
    flex-direction: column;
    background-color: var(--dark);
    color: var(--light-grey);
    width: calc(2rem + 32px);
    overflow: hidden;
    min-height: 100vh;
    padding: 1rem;
    z-index: 1;
    transition: 0.4s ease-in-out;

    .flex {
        flex: 1 1 0%;
    }
    .logo {
        margin-bottom: 1rem;
        span {
            color: var(--white);
            font-weight: 700;
            font-style: italic;

            &:nth-child(2) {
                opacity: 0;
            }
        }
    }
    .menu-toggle-wrap {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1rem;
        position: relative;
        top: 0.6rem;
        transition: 0.2s ease-in-out;
        .menu-toggle {
            transition: 0.2s ease-in-out;
            .box-icons {
                font-size: 2rem;
                color: var(--white);
                transition: 0.2s ease-out;
            }
            &:hover {
                .box-icons {
                    color: var(--orange);
                    transform: translateX(0.5rem);
                }
            }
        }
    }
    h3,
    .button .text {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    h3 {
        color: var(--grey);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }
    .menu {
        margin: 0 -1rem;
        .button {
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.2s ease-in-out;
            padding: 0.8rem 1rem;
            .box-icons {
                font-size: 2rem;
                color: var(--white);
                transition: 0.2s ease-in-out;
            }
            .text {
                color: var(--white);
                transition: 0.2s ease-in-out;
            }
            &:hover {
                background-color: var(--dark-alt);
                .box-icons,
                .text {
                    color: var(--orange);
                }
            }
            &.router-link-exact-active {
                background-color: var(--orange);
                color: var(--white);
                border-right: 5px solid var(--white);
                .box-icons,
                .text {
                    color: var(--white);
                }
            }
        }
    }
    .footer {
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        p {
            font-size: 0.875rem;
            color: var(--grey);
        }
    }

    &.is-expanded {
        width: var(--sidebar-width);
        .menu-toggle-wrap {
            top: 0.6rem;

            .menu-toggle {
                transform: rotate(-180deg);
            }
        }
        .logo {
            display: flex;
            gap: 5px;
            span {
                color: var(--white);
                font-weight: 700;
                font-style: italic;
                &:nth-child(2) {
                    transition: 1.5s ease-in-out;
                    opacity: 1;
                }
            }
        }
        h3,
        .button .text {
            opacity: 1;
        }
        .button {
            .box-icons {
                margin-right: 1rem;
            }
        }
        .footer {
            opacity: 0;
        }
    }
    @media (max-width: 1024px) {
        position: absolute;
        z-index: 99;
    }
}
</style>
