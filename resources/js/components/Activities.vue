<template>
	<div class="container">
		<!-- Main content -->
        
        <!-- Timelime example  -->
        <div class="row">
		<h3 class="card-title mt-4">Activities</h3>
          <div class="col-md-12">

            <!-- The time line -->
            <ul class="timeline" v-for="activity in activities" :key="activity.id">

    <!-- timeline time label -->
    <br>
    <li class="time-label">
        <span class="bg-success">
            {{activity.created_at | myDate}}
        </span>
    </li>
    <!-- /.timeline-label -->

    <!-- timeline item -->
    <li>
        <!-- timeline icon -->
        <!-- <i class="fa fa-history"></i> -->
        <div class="timeline-item">
            <span class="bg-info time"><i class="fa fa-clock-o"></i> {{activity.created_at | myTime}}</span>

            <h3 class="timeline-header"><a href="#">{{activity.causer.name}}</a></h3>

            <div class="timeline-body">
                {{activity.description | upCase}}<b> {{activity.properties.attributes.type | allCaps}}</b><br>
                 
                Name: <b>{{activity.properties.attributes.fullname}}</b><b>{{activity.properties.attributes.name}}</b>
            </div>

            <div class="timeline-footer">
                <!-- <a href="users" class="btn btn-primary btn-sm"><i class="fa fa-external-link-alt"></i></a> -->
            </div>
        </div>
    </li>
    <br>
    <!-- END timeline item -->

    <li>
    	<i class="fa fa-clock bg-info"></i>
    </li>

</ul>
          </div>
          <!-- /.col -->
        </div>
      <!-- /.timeline -->
	</div>
</template>

<script>
	export default {
		data (){
            return {
                activities: {},
            }
        },
        // methods: {
        //     load(){
        //         axios.get('/api/activities').then(response => {
		// 		this.activities = response.data.data;
		// 	})
        //     }
        // },
		created(){
            // this.load();
			axios.get('/api/activities').then(response => {
				this.activities = response.data;
			})
		}
	}
</script>