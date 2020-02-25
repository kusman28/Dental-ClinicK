<template>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4">
            <h3 class="card-title">Medical History</h3>
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-4 input-group input-group-sm">
                            <input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search" placeholder="Search" aria-label="Search">

                            <div class="input-group-append">
                            <button class="btn btn-navbar btn-success" @click="searchit">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
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
                                    <th>Date of Session</th>
                                    <!-- <th>Date</th> -->
                                    <!-- <th>Balance</th>
                                    <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="record in records.data" :key="record.id">
                                    <td>{{record.id}}</td>
                                    <td>{{record.fullname}}</td>
                                    <td>{{record.tooth_no}}</td>
                                    <td>{{record.created_at | myDate}}</td>
                                    <!-- <td>{{treatment.updated_at | myDate}}</td> -->
                                    <!-- <td>{{treatment.amount_paid}}</td>
                                    <td>{{treatment.balance}}</td>
                                    <td><span :class="[treatment.status === 'On-going' ? 'badge-warning' : (treatment.status === 'Done'?'badge-success':'badge-primary'), 'badge badge-pill']">{{treatment.status | upCase}} 
                                        <i :class="[treatment.status === 'On-going' ? 'fas fa-clock' : (treatment.status === 'Done'?'fas fa-check':'badge-primary')]"></i></span></td>
                                    -->
                                  <td>
                                    <!-- <a href="#" class="btn btn-primary btn-sm" @click="editTreatment(treatment)">Prescription
                                        <i class="fas fa-prescription"></i>
                                    </a> -->
                                    <a :href="'/pdfExportMedical/' + record.id" target="_blank" class="btn btn-success btn-sm">Print
                                        <i class="fas fa-print"></i>
                                    </a>
                                  </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
						<pagination :data="records" @pagination-change-page="getResults">
								<!-- <span slot="prev-nav">&lt; Previous</span>
								<span slot="next-nav">Next &gt;</span> -->
						</pagination>
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
                    <div class="modal-body col-md-12">
                        <label>Patient</label>
                        <div class="form-group">
                            <input v-model="form.fullname" type="text" name="fullname"
                            placeholder="Patient" 
                            class="form-control" disabled>
                        </div>
                        <label>Tooth Part/No.</label>
                        <div class="form-group">
                            <input v-model="form.tooth_no" type="text" name="tooth_no"
                            placeholder="Patient" 
                            class="form-control" disabled>
                        </div>
                        <label>Prescription</label>
                        <div class="form-group">
                        <textarea class="form-control" v-model="form.procedure" name="procedure" placeholder="Prescription" disabled></textarea>
                        </div>
                        <label>Payment Status</label>
                        <div class="form-group">
                            <input v-model="form.status" type="text" name="status"
                            class="form-control" disabled>
                        </div>
                        <label>Amount Charge</label>
                        <label class="float-right">Amount Paid</label>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" v-model="form.amount_charge" name="amount_charge" class="form-control" disabled>
                                    <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="text" v-model="form.amount_paid" name="amount_charge" class="form-control" disabled>
                                    <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label>Balance</label>
                        <div class="form-group col-md-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                                </div>
                                <input type="text" v-model="form.balance" name="amount_charge" class="form-control" disabled>
                                <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
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
            records: {},
            search: '',
            form: new Form({
                id: '',
                patient_id: '',
                fullname: '',
                tooth_no: '',
                procedure: '',
            })
        }
    },
    methods: {
        searchit: _.debounce(() => {
		Fire.$emit('searching');
		},0.700),
		getResults(page = 1) {
        axios.get('record?page=' + page)
            .then(response => {
                this.records = response.data;
            });
		},
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
        editTreatment(treatment)
        {
            this.form.reset();
            $('#treatmentModal').modal('show');
            this.form.fill(treatment);

        },
        loadTreatment()
        {
            axios.get('record').then(({ data }) => (this.records = data));
        },
        
    },
    created(){
        Fire.$on('searching', () => {
            let query = this.search;
            axios.get('/find?q=' + query)
            .then((data) => {
                this.records = data.data
            })
            .catch(() => {

            })
		});
        this.loadTreatment();
        Fire.$on('afterCreate',() => {
            this.loadTreatment();
        });

    },
}
</script>