<template>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Users</h3>
						<div class="card-tools">
                		<button type="submit" class="btn btn-success btn-sm" @click="newModal">Add User <i class="fas fa-user-plus"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<!-- <th>Address</th> -->
									<th>Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="user in users" :key="user.id">
									<td>{{user.id}}</td>
									<td>{{user.name | upCase}}</td>
									<td>{{user.email}}</td>
									<!-- <td>{{patient.address}}</td> -->
									<td><span :class="[user.type === 'Admin' ? 'badge-success' : (user.type === 'Assisstant'?'badge-primary':'badge-primary'), 'badge badge-pill']">{{user.type}}</span></td>
			                      <td>
			                      	<a href="#" class="btn btn-primary btn-sm" @click="editModal(user)">
			                      		<i class="fas fa-edit"></i>
			                      	</a>
			                      	<a href="#" class="btn btn-outline-danger btn-sm" @click="deletePatient(user.id)">
			                      		<i class="fas fa-trash"></i>
			                      	</a>
			                      </td>
								</tr>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>


		<!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
        	<div class="modal-dialog modal-dialog-centered" role="document">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add User</h5>
        				<h5 v-show="editmode" class="modal-title" id="addNewLabel">Edit User</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<form @submit.prevent="editmode ? updateUser() : createUser()">
        			<div class="modal-body">
        				<div class="form-group">
        					<input v-model="form.name" type="text" name="name"
        					placeholder="Name" 
        					class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('name') }">
        					<has-error :form="form" field="name"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.email" type="text" name="email"
        					placeholder="Email" 
        					class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('email') }">
        					<has-error :form="form" field="email"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.password" type="password" name="password"
        					placeholder="Password" 
        					class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
        					<has-error :form="form" field="password"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-show="!editmode" v-model="form.password_confirmation" type="password" name="password_confirmation"
        					placeholder="Re-enter password" 
        					class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
        					<has-error :form="form" field="password"></has-error>
        				</div>
        				<div class="form-group">
        					<select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
        						<option value="">User Role</option>
        						<option value="Admin">Admin</option>
        						<option value="Assisstant">Assisstant</option>
        						<option value="Staff">Staff</option>
        					</select>
        					<has-error :form="form" field="type"></has-error>
        				</div>
        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
        				<button v-show="editmode" type="submit" class="btn btn-primary">Update <i class="fas fa-check"></i></button>
        				<button v-show="!editmode" type="submit" class="btn btn-success">Save <i class="fas fa-check"></i></button>
        			</div>
        			</form>
        		</div>
        	</div>
        </div>

	</div>
</template>
<script>

export default {
	data() {
		return {
		editmode: false,
			users: {},
			form: new Form({
				id: '',
				name: '',
				email: '',
				password: '',
				type: ''
			})
		}
	},
	methods: {
		updateUser()
		{
			this.$Progress.start();
			this.form.put('api/user/'+this.form.id)
			.then(() => {
			$('#addNew').modal('hide');
			swal.fire(
				'Updated!',
				'Patient information updated.',
				'success'
				)
				Fire.$emit('afterCreate');
				this.$Progress.finish();
			Fire.$emit('afterCreate');
			})
			.catch(() => {
				this.$Progress.fail();
			})
		},
		editModal(user)
		{
			this.editmode = true;
			this.form.reset();
			$('#addNew').modal('show');
			this.form.fill(user);
		},
		newModal()
		{
			this.editmode = false;
			this.form.reset();
			$('#addNew').modal('show');
		},
		deletePatient(id)
		{
		swal.fire({
			title: 'Are you sure?',
			text: "You are going to delete this user",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
			}).then((result) => {

			if (result.value) {	
				this.form.delete('api/user/'+id).then(()=>{
						swal.fire(
						'Deleted!',
						'Your file has been deleted.',
						'success'
						)
						Fire.$emit('afterCreate');
					})
					.catch(()=>{
						swal('Failed!', 'There was something wrong.', 'warning');
					});
				}
			})
		},
		loadPatients()
		{
			axios.get('api/user').then(({ data }) => (this.users = data.data));
		},
		createUser() 
		{
			this.$Progress.start();
			this.form.post('api/user')
			.then(()=>{	
			Fire.$emit('afterCreate');
			$('#addNew').modal('hide');
			toast.fire({
				type: 'success',
				title: 'User added successfully.'
				})
				this.$Progress.finish()
			})
			.catch(()=>{
				this.$Progress.fail()
			})
		}
	},
	created(){
		this.loadPatients();
		Fire.$on('afterCreate',() => {
			this.loadPatients();
		});

	},
}
</script>