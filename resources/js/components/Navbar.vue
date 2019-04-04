<template>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <router-link :to="{ name: 'home' }" class="remove-link-default navbar-brand">My Blog</router-link>
            <div class="navbar-collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link :to="{ name: 'home' }" class="remove-link-default">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="$store.state.loggedIn" :to="{ name: 'newpost' }" class="remove-link-default">Add New Post</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="!$store.state.loggedIn" :to="{ name: 'login' }" class="remove-link-default">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link v-if="$store.state.loggedIn" v-on:click.native="logout()" to="/" class="remove-link-default">Log out</router-link>
                    </li>
                </ul>
            </div>
        </nav>
</template>

<script>
    import axios from 'axios'

    export default {
        methods: {
            logout() {
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
                axios.post('/api/logout')
                .then(() => {
                    this.$store.commit('loggedOutPerform')
                    localStorage.removeItem('access_token')
                    this.$router.go({name:'home'})
                })
                .catch(err => {
                    localStorage.removeItem('access_token')
                    alert(err)
                })
            }
        }
    }
</script>
