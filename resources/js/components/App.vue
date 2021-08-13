<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Laravel Vue Crud App - TechvBlogs</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" to="/users" class="nav-item nav-link">Users</router-link>
                        <router-link exact-active-class="active" to="/posts" class="nav-item nav-link">Posts</router-link>
                    </div>
                </div>
            </div>
        </nav>
        
        
        
       
        <div class="container mt-5">
            <router-view></router-view>
        </div>
    </main>
</template>
 
<script>
    export default {}
</script>

