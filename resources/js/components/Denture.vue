<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Treatment</h3>
                        <div class="card-tools">
                        <!-- <button type="submit" class="btn btn-success btn-sm" @click="newModal">Add Patient <i class="fas fa-user-plus"></i></button> -->
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Patient</th>
                                    <th>Tooth No.</th>
                                    <th>Procedure</th>
                                    <th>Amount Charge</th>
                                    <th>Amount Paid</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="treatment in treatments" :key="treatment.id">
                                    <td>{{treatment.id}}</td>
                                    <td>{{treatment.patient}}</td>
                                    <td>{{treatment.tooth_no}}</td>
                                    <td>{{treatment.procedure}}</td>
                                    <td>{{treatment.amount_charge}}</td>
                                    <td>{{treatment.amount_paid}}</td>
                                    <td>{{treatment.balance}}</td>
                                    <td><span :class="[treatment.status === 'On-going' ? 'badge-warning' : (treatment.status === 'Done'?'badge-success':'badge-primary'), 'badge badge-pill']">{{treatment.status}} 
                                        <i :class="[treatment.status === 'On-going' ? 'fas fa-clock' : (treatment.status === 'Done'?'fas fa-check':'badge-primary')]"></i></span></td>
                                  <td>
                                    <a href="#" class="btn btn-primary btn-sm" @click="editModal(user)">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    |
                                    <a href="#" @click="deleteUser(user.id)">
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
                        <h5 class="modal-title" id="addNewLabel">Add Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createPatient">
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
                        <button type="submit" class="btn btn-success btn-flat">Save</button>
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
            treatments: {},
            form: new Form({
                patient: '',
                tooth_no: '',
                procedure: '',
                amount_charge: '',
                amount_paid: '',
                balance: '',
                type: '',
                status: ''
            })
        }
    },
    methods: {
        //newModal()
        //{
          //  this.form.reset();
          //  $('#addNew').modal('show');
        //},
        loadTreatment()
        {
            axios.get('treatment/denture').then(({ data }) => (this.treatments = data.data));
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
        this.loadTreatment();
        Fire.$on('afterCreate',() => {
            this.loadTreatment();
        });

    },
}
</script>