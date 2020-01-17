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
                                    <th>Patient ID</th>
                                    <th>Patient</th>
                                    <th>Tooth Part</th>
                                    <!-- <th>Prescription</th> -->
                                    <th>Status</th>
                                    <th>Amount Charge</th>
                                    <th>Payment</th>
                                    <!-- <th>Balance</th>
                                    <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="treatment in treatments" :key="treatment.id">
                                    <td>{{treatment.id}}</td>
                                    <td>{{treatment.patient}}</td>
                                    <td>{{treatment.tooth_no}}</td>
                                    <!-- <td>{{treatment.procedure}}</td> -->
                                    <td>{{treatment.status}}</td>
                                    <td>₱ {{treatment.amount_charge}}</td>
                                    <td><span :class="[treatment.amount_paid === 'PAID' ? 'badge-success' : (treatment.amount_paid === 'UNPAID'?'badge-danger':'badge-primary'), 'badge badge-pill']">{{treatment.amount_paid}}</span>
                                    </td>
                                    <!-- <td>{{treatment.amount_paid}}</td>
                                    <td>{{treatment.balance}}</td>
                                    <td><span :class="[treatment.status === 'On-going' ? 'badge-warning' : (treatment.status === 'Done'?'badge-success':'badge-primary'), 'badge badge-pill']">{{treatment.status | upCase}} 
                                        <i :class="[treatment.status === 'On-going' ? 'fas fa-clock' : (treatment.status === 'Done'?'fas fa-check':'badge-primary')]"></i></span></td>
                                    -->
                                  <td>
                                    <a href="#" class="btn btn-primary btn-sm" @click="editTreatment(treatment)" title="Treatment">Treatment 
                                        <i class="fas fa-heartbeat"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-sm" @click="editTreatment1(treatment)" title="Payment">
                                        <i class="fas fa-check"></i>
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
                    <form @submit.prevent="updateTreatment()">
                    <img style="height: 350px; float: right;" src="img/Tooth Legend.png">
                    <div class="modal-body col-md-6">
                        <label>Patient</label>
                        <div class="form-group">
                            <input v-model="form.patient" type="text" name="patient"
                            placeholder="Patient" 
                            class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <select name="tooth_no" v-model="form.tooth_no" id="tooth_no" class="form-control" :class="{ 'is-invalid': form.errors.has('tooth_no') }">
                                <option value="">Tooth Part</option>
                                <option value="Upper">Upper</option>
                                <option value="Lower">Lower</option>
                            </select>
                            <has-error :form="form" field="tooth_no"></has-error>
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" v-model="form.procedure" name="procedure" placeholder="Prescription"></textarea>
                        </div>
                        <div class="form-group">
                            <input v-model="form.status" type="text" name="status"
                            placeholder="Status" 
                            class="form-control ucfirst" :class="{ 'is-invalid': form.errors.has('status') }">
                            <has-error :form="form" field="status"></has-error>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" v-model="form.amount_charge" name="amount_charge" class="form-control" placeholder="Amount Charge"  :class="{ 'is-invalid': form.errors.has('amount_charge') }">
                                <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                                </div>
                                <has-error :form="form" field="amount_charge"></has-error>
                            </div>
                        </div>
                        <div class="form-group">
                        <textarea class="form-control" v-model="form.notes" name="notes" placeholder="Notes"></textarea>
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
        <!-- End of Modal -->

        <!-- Paid Modal -->
        <div class="modal fade" id="treatmentModal1" tabindex="-1" role="dialog" aria-labelledby="treatmentModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="treatmentModal1Label">Treatment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateTreatment1()">
                    <div class="modal-body col-md-8">
                        <label>Patient</label>
                        <div class="form-group">
                            <input v-model="form.patient" type="text" name="patient"
                            placeholder="Patient" 
                            class="form-control" disabled>
                        </div>
                        <label>Amount Charge</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" v-model="form.amount_charge" name="amount_charge" class="form-control" placeholder="Amount Charge"  :class="{ 'is-invalid': form.errors.has('amount_charge') }" disabled>
                                <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                                </div>
                                <has-error :form="form" field="amount_charge"></has-error>
                            </div>
                        </div>
                        <label>Status</label>
                        <div class="form-group">
                            <select name="amount_paid" v-model="form.amount_paid" id="amount_paid" class="form-control" :class="{ 'is-invalid': form.errors.has('amount_paid') }">
                                <option value="PAID">PAID</option>
                                <option value="UNPAID">UNPAID</option>
                            </select>
                            <has-error :form="form" field="amount_paid"></has-error>
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
        <!-- End of Modal Paid -->

    </div>
</template>
<script>

export default {
    data() {
        return {
            treatments: {},
            form: new Form({
                id: '',
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
        updateTreatment()
        {
            this.$Progress.start();
            this.form.put('treatment/'+this.form.id)
            .then(() => {
            $('#treatmentModal').modal('hide');
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
        updateTreatment1()
        {
            this.$Progress.start();
            this.form.put('treatment/'+this.form.id)
            .then(() => {
            $('#treatmentModal1').modal('hide');
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
        editTreatment(treatment)
        {
            this.form.reset();
            $('#treatmentModal').modal('show');
            this.form.fill(treatment);

        },
        editTreatment1(treatment)
        {
            this.form.reset();
            $('#treatmentModal1').modal('show');
            this.form.fill(treatment);

        },
        loadTreatment()
        {
            axios.get('treatment').then(({ data }) => (this.treatments = data.data));
        },
        
    },
    created(){
        this.loadTreatment();
        Fire.$on('afterCreate',() => {
            this.loadTreatment();
        });

    },
}
</script>