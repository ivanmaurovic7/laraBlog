<template>
    <div>
        <div>
            <div class="col-md-4 v-container mt-5 mx-auto">
                <div class="card mb-4">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form @submit.prevent="login()">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="text" class="form-control" v-model="username" placeholder="Enter email">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" v-model="password" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
                username: '',
                password: ''
            }
        },
        methods: {
            login() {
                return new Promise((resolve, reject) => {
                    axios.post('/api/login', {username: this.username, password: this.password})
                    .then(res => {
                        const token = res.data.access_token

                        // Not the best solution, can be issues with cross-side scripting -> better practice is to use cookies
                        localStorage.setItem('access_token', token)

                        this.$store.commit('loggedInPerform')
                        this.$router.push({name: 'home'})

                        resolve(res)
                    })
                    .catch(err => {
                        alert(err)
                        reject(err)
                    })
                })
            }
        }
    }
</script>
