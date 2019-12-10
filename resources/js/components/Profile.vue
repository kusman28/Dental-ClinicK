<style type="text/css">
	.widget-user-header
	{
		/* background-position: center center; */
		background-size: cover;
	}
</style>
<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 mt-5">
				<div class="card card-widget widget-user">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header text-white" style="height:200px; background-image:url(./img/mock-up.png)">
						<!-- <h3 class="widget-user-username text-left">{{this.form.name}}</h3>
						<h5 class="widget-user-desc text-left">{{this.form.type}}</h5> -->
					</div>
					<div class="widget-user-image">
						<img class="img-circle" style="margin-top: 90px;" :src="getProfilePhoto()" alt="User Avatar">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header">Name</h5>
									<span>{{this.form.name}}</span>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class="col-sm-4 border-right">
								<div class="description-block">
									<h5 class="description-header">Email</h5>
									<span>{{this.form.email}}</span>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
							<div class="col-sm-4">
								<div class="description-block">
									<h5 class="description-header">User Type</h5>
									<span>{{this.form.type}}</span>
								</div>
								<!-- /.description-block -->
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					</div>
				</div>
			</div>
			
			<div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <h4>
                          Bio
                        </h4>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        {{this.form.bio}}
                      </p>
                    </div>
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                          <has-error :form="form" field="name"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                          <has-error :form="form" field="email"></has-error>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputBio" class="col-sm-2 control-label">Bio</label>

                        <div class="col-sm-10">
                          <textarea class="form-control" v-model="form.bio" id="inputBio" placeholder="Bio" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                        </div>
                      </div>
                    
                      <div class="form-group">
                      	<label for="inputEmail" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="file" @change="updateProfile" name="photo" class="form-input">
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">Password</label>
						  <div class="input-group col-md-8">
							<input type="password" v-model="form.password" class="form-control" v-show="!showPass" placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">	
                          <input type="text" v-model="form.password" class="form-control" v-show="showPass" placeholder="Password" :class="{ 'is-invalid': form.errors.has('password') }">	
			
						  <has-error :form="form" field="password"></has-error>
						<span class="input-group-append">
							<button class="btn btn-primary m-t-1" @click.prevent="showPass = !showPass"><span v-show="!showPass">Show Password</span><span v-show="showPass">Hide Password</span></button>
						</span>
                      </div>
                      </div>
					  
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-success btn-flat">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>

		</div>
	</div>
</template>
<script>
export default {
	data() 
	{
		return {
			showPass: false,
			form: new Form({
				id: '',
				name: '',
				email: '',
				password: '',
				type: '',
				bio: '',
				photo: ''
			})
		}
	},
	mounted()
	{
		console.log('Component mounted.')
	},
	methods:{
		// Best approach on updating profile.
		getProfilePhoto() {
		 let prefix = (this.form.photo.match(/\//) ? '' : '/img/profile/');
		 return prefix + this.form.photo;
		},
		getProfilePhoto()
		{
			let photo = (this.form.photo.length > 200) ? this.form.photo : "img/profile/" + this.form.photo;
			return photo;
			return "img/profile/"+ this.form.photo;
		},
		updateInfo()
		{
			this.$Progress.start();
			this.form.put('api/profile')
			.then(() => {
				//Fire.$emit('AfterCreate');
        swal.fire(
				'Updated!',
				'User information updated.',
				'success'
				)
				this.$Progress.finish();
			})
			.catch(() => {

				this.$Progress.fail();
			});
		},
		updateProfile(e)
		{
			// console.log('sd');		
			let file = e.target.files[0];
			console.log(file);
			let reader = new FileReader();
			if (file['size'] < 2111775) {
				reader.onloadend = (file) => {
				// console.log('RESULT', reader.result)
				this.form.photo = reader.result;
				}
				reader.readAsDataURL(file);
			} else {
				swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Too large to upload the file.'
				})
			}

		}
	},
	created()
	{	
		axios.get('api/profile')
		.then(({ data }) => (this.form.fill(data)));
	}
}
</script>