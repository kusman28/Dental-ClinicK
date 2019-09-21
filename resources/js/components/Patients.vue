<template>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List of Patients</h3>
						<div class="card-tools">
                		<button type="submit" class="btn btn-success btn-sm" @click="newModal">Add Patient <i class="fas fa-user-plus"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Age</th>
									<th>Address</th>
									<th>Contact</th>
									<th>Patient Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="patient in patients" :key="patient.id">
									<td>{{patient.id}}</td>
									<td>{{patient.firstname}} {{patient.middlename}} {{patient.lastname}}</td>
									<td>{{patient.age}}</td>
									<td>{{patient.address}}</td>
									<td>{{patient.contact_no}}</td>
									<td><span :class="[patient.type === 'Denture' ? 'badge-success' : (patient.type === 'Brace'?'badge-warning':'badge-primary'), 'badge badge-pill']">{{patient.type | upCase}}</span>
									</td>
			                      <td>
			                      	<a href="#" class="btn btn-primary btn-sm" @click="editModal(patient)">
			                      		<i class="fas fa-edit"></i>
			                      	</a>
			                      	|
			                      	<a href="#" @click="deletePatient(patient.id)">
			                      		<i class="fas fa-trash red"></i>
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
        				<h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add Patient</h5>
        				<h5 v-show="editmode" class="modal-title" id="addNewLabel">Edit Patient</h5>
        				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        					<span aria-hidden="true">&times;</span>
        				</button>
        			</div>
        			<form @submit.prevent="editmode ? updatePatient() : createPatient()">
        			<div class="modal-body">
        				<div class="form-group">
        					<input v-model="form.firstname" type="text" name="firstname"
        					placeholder="Firstname" 
        					class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('firstname') }">
        					<has-error :form="form" field="firstname"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.middlename" type="text" name="middlename"
        					placeholder="Middlename" 
        					class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('middlename') }">
        					<has-error :form="form" field="middlename"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.lastname" type="text" name="lastname"
        					placeholder="Lastname" 
        					class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('lastname') }">
        					<has-error :form="form" field="lastname"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.age" type="text" name="age"
        					placeholder="Age" 
        					class="form-control" :class="{ 'is-invalid': form.errors.has('age') }">
        					<has-error :form="form" field="age"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.address" type="text" name="address"
        					placeholder="Address" 
        					class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('address') }">
        					<has-error :form="form" field="address"></has-error>
        				</div>
        				<div class="form-group">
        					<input v-model="form.contact_no" type="text" name="contact_no"
        					placeholder="Contact No." 
        					class="form-control" :class="{ 'is-invalid': form.errors.has('contact_no') }">
        					<has-error :form="form" field="contact_no"></has-error>
        				</div>
        				<div class="form-group">
        					<select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
        						<option value="">Patient Type</option>
        						<option value="Brace">Brace</option>
        						<option value="Extraction">Extraction</option>
        						<option value="Denture">Denture</option>
        					</select>
        					<has-error :form="form" field="type"></has-error>
        				</div>
        			</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        				<button v-show="editmode" type="submit" class="btn btn-primary btn-flat">Update</button>
        				<button v-show="!editmode" type="submit" class="btn btn-success btn-flat">Save</button>
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
			patients: {},
			form: new Form({
				id: '',
				fullname: '',
				firstname: '',
				middlename: '',
				lastname: '',
				age: '',
				address: '',
				contact_no: '',
				type: ''
			})
		}
	},
	methods: {
		updatePatient()
		{
			this.$Progress.start();
			this.form.put('api/patient/'+this.form.id)
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
		editModal(patient)
		{
			this.editmode = true;
			this.form.reset();
			$('#addNew').modal('show');
			this.form.fill(patient);
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
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {

			if (result.value) {	
				this.form.delete('api/patient/'+id).then(()=>{
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
			axios.get('api/patient').then(({ data }) => (this.patients = data.data));
		},
		createPatient() 
		{
			this.$Progress.start();
			this.form.post('api/patient')
			.then(()=>{	
			Fire.$emit('afterCreate');
			$('#addNew').modal('hide');
			toast.fire({
				type: 'success',
				title: 'Patient added successfully.'
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