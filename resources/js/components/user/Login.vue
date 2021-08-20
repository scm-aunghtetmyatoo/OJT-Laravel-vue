<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="alert alert-danger" v-if="message">
              {{ message }}
            </div>
            <h3>Login</h3>
            <form @submit.prevent="login">
              <div class="form-group">
                <input
                  type="text"
                  v-model="email"
                  class="form-control"
                  placeholder="Email"
                  name="email"
                />
              </div>
              <div class="form-group">
                <input
                  type="password"
                  v-model="password"
                  class="form-control"
                  placeholder="Password"
                  id="password"
                  name="password"
                />
              </div>
              <button type="submit" class="btn btn-primary btn-block">
                Login
              </button>
            </form>
          </div>
          <div class="card-footer">
            <small
              ><span class="muted">Don't have an account?</span>
              <a href="#">Register</a></small
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      message: "",
    };
  },

  methods: {
    login(){
				this.axios.post('/api/login',{
					email: this.email,
					password: this.password
				})
				.then(response => {
            this.$store.commit("LOGIN", true);
             localStorage.setItem("token", response.data.token);
            this.$router.push({ name: "postList" });
				}).catch(error => {
					console.log(response.error);
				})
			}
  },
};
</script>