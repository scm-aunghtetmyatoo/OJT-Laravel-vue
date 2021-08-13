<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update post</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
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
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"update-post",
    data(){
        return {
            post:{
                title:"",
                description:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showPost()
    },
    methods:{
        async showPost(){
            await this.axios.get(`/api/posts/${this.$route.params.id}`).then(response=>{
                const { title, description } = response.data
                this.post.title = title
                this.post.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/posts/${this.$route.params.id}`,this.post).then(response=>{
                this.$router.push({name:"postList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>