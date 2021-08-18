<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"postCreate"}' class="btn btn-primary">Create</router-link>
            <router-link :to='{name:"postUpload"}' class="btn btn-primary">Upload</router-link>
            <button type="button" @click="downloadpost()" class="btn btn-primary">Download</button>

        </div>
        <div class="col-12">
            <div class="col-4">
                <form @submit.prevent="getPosts">
                        <div class="input-group">
                            <input
                                v-model="search"
                                type="text"
                                class="form-control"
                                placeholder="Search"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Category</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(post,key) in posts.data" :key="key">
                                    <td>{{ post.id }}</td>
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.description }}</td>
                                    <td>
                                        <router-link :to='{name:"postEdit",params:{id:post.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deletepost(post.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="4" align="center">No posts Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <pagination :data="posts" @pagination-change-page="getPosts"></pagination>
    </div>
</template>

<script>
    import pagination from 'laravel-vue-pagination'

export default {
    name:"posts",
    components:{
            pagination
    },
    
    data(){
        return {
            search:'',
            posts:{}
        }
    },
    mounted(){
        this.getPosts();
    },
    methods:{
        async getPosts(page = 1) {
            await this.axios
                .get(`/api/posts?page= + ${page} & search=${this.search}`)
                .then(response => {
                    this.posts = response.data;
                })
                .catch(error => {
                    console.log(error);
                    this.posts = [];
                });
        },
       
        deletepost(id){
            if(confirm("Are you sure to delete this post ?")){
                this.axios.delete(`/api/posts/${id}`).then(response=>{
                    this.getPosts()
                }).catch(error=>{
                    console.log(error)
                })
            }
        },

        downloadpost() {
            axios.get('api/export', {
                    responseType: 'arraybuffer'
                })
                .then(response => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');
                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', 'post.xlsx');
                    document.body.appendChild(fileLink);
                    fileLink.click();
                })
        }

		
    }
}
</script>