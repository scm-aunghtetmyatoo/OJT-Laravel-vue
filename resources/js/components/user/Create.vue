<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add user</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="user.email">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input v-bind:type="[showPassword ? 'text' : 'password']" class="form-control" v-model="user.password">


                                        <div class="input-group-append">
                                            <span class="input-group-text" @click="showPassword = !showPassword">
                                                <i class="fa" :class="[showPassword ? 'fa-eye' : 'fa-eye-slash']" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" class="form-control" v-model="user.type">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" v-model="user.phone">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Date of birth</label>
                                    <input type="date" class="form-control" v-model="user.dob">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" v-model="user.address">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Profile</label>
                                    <input type="file" name="profile" class="form-control-file" id="profile"
                                        @change="onFileChange">
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
</template>

<script>
    export default {
        name: "add-user",

        data() {
            return {
                user: {
                    name: "",
                    email: "",
                    password: "",
                    type: "",
                    phone: "",
                    dob: "",
                    address: "",
                    profile: "",
                },
                showPassword: false,
            }
        },
        methods: {
            onFileChange(event) {
                this.user.profile = event.target.files[0];
            },
            async create() {
                let formData = new FormData();

                formData.append("name", this.user.name);
                formData.append("email", this.user.email);
                formData.append("password", this.user.password);
                formData.append("type", this.user.type);
                formData.append("phone", this.user.phone);
                formData.append("dob", this.user.dob);
                formData.append("address", this.user.address);
                formData.append("profile", this.user.profile);

                await this.axios.post('/api/users/store', formData).then(response => {
                    this.$router.push({
                        name: "userList"
                    })
                }).catch(error => {
                    console.log(error)
                })
            }
            
            
        }
    }

</script>
