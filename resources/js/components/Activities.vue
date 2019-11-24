<template>
	<div class="container">
		<h3 class="card-title mt-4">Activities</h3>
		<!-- Main content -->
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">

            <!-- The time line -->
            <ul class="timeline" v-for="(activity, i) in activities" :key="i">

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
            <span class="time"><i class="fa fa-clock-o"></i> {{activity.created_at | myTime}}</span>

            <h3 class="timeline-header"><a href="#">{{activity.causer.name}}</a></h3>

            <div class="timeline-body">
                <b>{{activity.description | upCase}}</b> {{activity.properties.attributes.type}}<br>
                {{activity.properties.attributes.name}} name
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
		data: ()=> ({
			activities: []
		}),
		created(){
			axios.get('/api/activities').then(response => {
				this.activities = response.data;
			})
		}
	}
</script>