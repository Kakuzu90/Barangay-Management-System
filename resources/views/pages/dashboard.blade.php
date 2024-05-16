@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Dashboard
	@endif
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Dashboard</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Home</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="card">
				<div class="card-body p-5">
						<div class="row">
								<div class="col-xl-6 my-auto">
										<h2 class="fw-bold text-primary">Mission</h2>
										<p class="mb-0">{!! $data["mission"] !!}</p>
								</div>
								<div class="col-xl-6 mt-xl-0 mt-5">
										<div class="text-center">
												<img src="{{ asset("assets/images/landing/Team goals-pana.png") }}" 
												alt="Mission Image" height="300" class="about-img" />
										</div>
								</div>
						</div>
				</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card">
				<div class="card-body p-5">
						<div class="row">
								<div class="col-xl-6 mt-xl-0 mt-5">
										<div class="text-center">
												<img src="{{ asset("assets/images/landing/Vision statement-pana.png") }}" 
												alt="Mission Image" height="300" class="about-img" />
										</div>
								</div>
								<div class="col-xl-6 my-auto">
									<h2 class="fw-bold text-primary">Vision</h2>
									<p class="mb-0">{!! $data["vision"] !!}</p>
								</div>
						</div>
				</div>
		</div>
	</div>
</div>
@endsection