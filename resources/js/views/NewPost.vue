<template>
    <div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Add New Post</div>

                        <div class="card-body">
                            <form action="#" @submit.prevent="createNewPost()">
                                <div class="form-group">
                                    <label>Post title</label>
                                    <input v-model="post.title" name="title" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Post Content</label>
                                    <textarea v-model="post.body" name="body" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input @change="addFile()" name="file" type="file" ref="file" class="form-control">
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
                post: {
                    title: null,
                    body: null,
                    file: null
                },
                formData: {}
            }
        },
        methods: {
            addFile() {
                this.file = this.$refs.file.files[0];
            },
            createNewPost() {
                this.formData = new FormData();
                this.formData.append('title', this.post.title);
                this.formData.append('body', this.post.body);
                this.formData.append('file', this.file);
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('access_token')
                axios.post('/api/post/store', this.formData, {headers: {'Content-Type': 'multipart/form-data'}}).then(() => {
                    this.post.title = null
                    this.post.body = null
                    this.post.file = null
                    this.formData = {}
                }).then(() => {
                    alert('Post successfully added!')
                    this.$router.push('/')
                }).catch(err => {
                    alert(err)
                })
            }
        }
    }
</script>
