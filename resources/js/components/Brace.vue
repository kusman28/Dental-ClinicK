<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Brace Patients</h3>
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
                                    <th>Treatment</th>
                                    <th>Status</th>
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
                                    <td><span :class="[treatment.status === 'On-going' ? 'badge-warning' : (treatment.status === 'Done'?'badge-success':'badge-primary'), 'badge badge-pill']">{{treatment.status | upCase}} 
                                        <i :class="[treatment.status === 'On-going' ? 'fas fa-clock' : (treatment.status === 'Done'?'fas fa-check':'badge-primary')]"></i></span></td>
                                  <td>
                                    <a href="#" class="btn btn-primary btn-sm" @click="treatmentX">Treatment 
                                        <i class="fas fa-file-prescription"></i>
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
        <div class="modal fade" id="treatmentModal" tabindex="-1" role="dialog" aria-labelledby="treatmentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="treatmentModalLabel">Treatment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createPatient">
                    <img style="height: 350px; float: right;" src="img/Tooth Legend.png">
                    <div class="modal-body col-md-6">
                        <label>Patient</label>
                        <div class="form-group">
                            <input v-model="form.patiet" type="text" name="patient"
                            placeholder="Status" 
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                <option value="">Tooth No.</option>
                                <option value="1-1 Incisors">1-1 Incisors</option>
                                <option value="1-2 Incisors">1-2 Incisors</option>
                                <option value="1-3 Canine">1-3 Canine</option>
                                <option value="1-4 Premolar">1-4 Premolar</option>
                                <option value="1-5 Premolar">1-5 Premolar</option>
                                <option value="1-6 Molar">1-6 Molar</option>
                                <option value="1-7 Molar">1-7 Molar</option>
                                <option value="1-8 Molar">1-8 Molar</option>
                            </select>
                            <has-error :form="form" field="type"></has-error>
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" id="inputExperience" placeholder="Treatment"></textarea>
                        </div>
                        <div class="form-group">
                            <input v-model="form.lastname" type="text" name="lastname"
                            placeholder="Status" 
                            class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('lastname') }">
                            <has-error :form="form" field="lastname"></has-error>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Amount Charge">
                                <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" id="inputExperience" placeholder="Notes"></textarea>
                        </div>                        
                        <div class="form-group">
                        &nbsp;
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
        treatmentX()
        {
            this.form.reset();
            $('#treatmentModal').modal('show');
        },
        loadTreatment()
        {
            axios.get('treatment').then(({ data }) => (this.treatments = data.data));
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