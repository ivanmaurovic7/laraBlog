<template>
    <div>
        <div class="container mt-5">
            <div class="card mb-4">
                <div class="card-header">{{post.title}}</div>
                <img :src="post.image" width="100%" height="auto">
                <div class="card-body">
                    {{post.body}}
                    <br>
                    <small>{{post.created_at}}</small>
                    <br><br>
                    <router-link class="btn btn-secondary" :to="{ name: 'home'}">Go back to posts</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                post: null
            }
        },

        mounted() {
            let currentId = this.$route.params.id
            axios
            // Slash before api took me 2 hours to figure out...
            .get('/api/post/'+currentId)
            .then(res => this.post = res.data)
            .catch(err => {
                alert(err)
            })
            }
        }
</script>
