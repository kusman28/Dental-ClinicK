<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-5">
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Patient</span>
                        <span class="info-box-number">
                            
                          {{patients.length}}
                          <!-- <small>%</small> -->
                      </span>
                            
                    <router-link to="/patients" class="small-box-footer">More info
                        <i class="fas fa-arrow-circle-right"></i>
                      </router-link>
                  </div>
                  <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-teeth nav-icon"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Brace</span>
                <span class="info-box-number">
                {{treatments.length}}
              </span>
              <router-link to="/brace" class="small-box-footer">More info
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-tooth nav-icon"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Extraction</span>
            <span class="info-box-number">
              {{extraction.length}}
            </span>
              <router-link to="/extraction" class="small-box-footer">More info
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-teeth-open nav-icon"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Denture</span>
        <span class="info-box-number">{{denture.length}}</span>

          <router-link to="/denture" class="small-box-footer">More info
              <i class="fas fa-arrow-circle-right"></i>
            </router-link>
    </div>
    <!-- /.info-box-content -->
</div>
<!-- /.info-box -->
</div>
<!-- /.col -->
</div>
</div>
</div>
</div>
</template>

<script>
export default {
    data(){
      return {
      denture: {},
      extraction: {},
      treatments: {},
      patients: {},
      }
    },
    methods: {
      loadPatients()
    {
      axios.get('api/patient').then(({ data }) => (this.patients = data.data));
      axios.get('treatment').then(({ data }) => (this.treatments = data.data));
      axios.get('treatment/denture').then(({ data }) => (this.denture = data.data));
      axios.get('treatment/extraction').then(({ data }) => (this.extraction = data.data));
    },
    },
      created(){
    this.loadPatients();

  },
}
</script>
