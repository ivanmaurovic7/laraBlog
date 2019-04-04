<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div v-for="post in posts" class="card mb-4" :key="post.id">
                        <div class="card-header">{{post.title}}</div>
                        <div class="imageContainer" :style="{ backgroundImage: 'url(' + post.image + ')' }"></div>
                        <div class="card-body">
                            {{post.body | truncate(300, '...')}}
                            <br>
                            <small>{{post.created_at}}</small>
                            <br><br>
                            <router-link class="btn btn-secondary" :to="{ name: 'post', params: {id: post.id } }">Read more</router-link>
                            <router-link v-if="$store.state.loggedIn" class="btn btn-success" :to="{ name: 'editpost', params: {id: post.id } }">Edit post</router-link>
                            <button v-if="$store.state.loggedIn" @click="deletePost(post.id)" class="btn btn-danger">Delete post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .imageContainer {
        height: 300px;
        width: 100%;
        background-position: center;
        background-size: cover;
    }
</style>


<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                posts: null
            }
        },

        beforeCreate() {
            axios
            .get('/api/posts')
            .then(res => this.posts = res.data)
            .catch(err => alert(err))
        },

        methods: {
            deletePost(id) {
               axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
               axios
               .delete('api/post/'+id)
               .then(() => {
                   this.$router.go()
               })
            }
        }
    }
</script>
