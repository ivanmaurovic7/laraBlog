<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Post</div>

                        <div class="card-body">
                            <form action="#" @submit.prevent="editPost()">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Post Title</label>
                                    <input v-model="title" name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Post Content</label>
                                    <textarea v-model="body" name="body" class="form-control" rows="3"></textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
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
                title: null,
                body: null
            }
        },

        created() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
            axios
            // Slash before api took me 2 hours to figure out...
            .get('/api/post/'+this.$route.params.id)
            .then(res => {
                this.title = res.data.title
                this.body = res.data.body
            })
            .catch(err => {
                alert(err)
            })
        },

        methods: {
            editPost() {
                let title = this.title
                let body = this.body
                let post = {title, body}
                axios.patch('/api/post/'+this.$route.params.id, post).then(() => {
                    this.title = ''
                    this.body = ''
                }).then(() => {
                    alert('Post successfully edited!')
                    this.$router.push('/')
                }).catch(err => {
                    alert(err)
                })
            }
        }
    }
</script>
