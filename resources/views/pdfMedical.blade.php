@extends('layouts.master')
<!DOCTYPE html>
<html>
<head>
	<title>{{$record->fullname}}</title>

	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<style type="text/css">
	.pdf-container{
		position: relative;
	}
	.header-wrapper{
		text-align: center;
		margin: 30px 0 45px 0;
	}
	.logo{
		width: 200px;
		display: block;
	}
	.address{
		margin: 0;
	}
	}
	.address1{
		margin: 0;
        font-size: 24px;
	}
	.footer-wrapper{
		position: absolute;
		bottom: 0;
		text-align: center;
	}
</style>
</head>
<body>
	{{-- <p style="font-size: 12px; float: right;">Appointment Date: {{$record->created_at->format('d/m/y')}}</p><br> --}}
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="pdf-container">
					<div class="header-wrapper">
						<img class="logo" src="img/clinick-logo.png">
						<p class="address">Tumaga, Zamboanga City <br> 09363242353</p>
						<p class="mt-4 address1">Medical History</p>
					</div>
					<p>Patient Name: <b>{{$record->fullname}}</b></p>
					<p>Tooth Part/No.: <b>{{$record->tooth_no}}</b></p>
					<p>Prescription: <i>{{$record->procedure}}</i></p>
					<p>Date of Session: <b>{{date('d-m-Y', strtotime($record->created_at))}}</b></p>
					{{-- <table class="table table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Patient Type</th>
								<th>Prescription</th>
								<th>Amount Charge</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{$treatment->fullname}}</td>
								<td>{{$treatment->type}}</td>
								<td>{{$treatment->procedure}}</td>
								<td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>{{$treatment->amount_charge}} - {{$treatment->amount_paid}}</td>
							</tr>
						</tbody>
					</table> --}}
					<div class="footer-wrapper">
						<p class="">Keep this document as a copy of your record.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/bootstrap.min.js"></script>
</body>
</html>