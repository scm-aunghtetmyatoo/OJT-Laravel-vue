<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Post</h4>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="create">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" v-model="post.title">
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" v-model="post.description">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "create-post",
        data() {
            return {
                post: {
                    title: "",
                    description: ""
                }
            }
        },
        methods: {
            async create() {
                await this.axios.post('/api/posts', this.post).then(response => {
                    this.$router.push({
                        name: "postList"
                    })
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }

</script>
