@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Active Purok Leaders
	@endif
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Active Purok Leaders</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Informations</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ route("purok-leaders.index") }}">Purok Leaders Lists</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Active</li>
		</ol>
	</div>
</div>

<div class="row justify-content-center">
	@forelse ($data["leaders"] as $item)
	<div class="col-xxl-3 col-xl-4 col-md-6">
		<div class="card custom-card">
			<div class="card-body">
				<div class="text-center">
					<span class="avatar avatar-xxl rounded">
						<img src="{{ $item->resident->avatar() }}" alt="Resident Avatar" class="rounded-circle" />
					</span>
				</div>
				<div class="d-flex text-center justify-content-between mt-1 mb-1">
					<div class="flex-fill">
						<p class="mb-0 fw-semibold fs-16 text-truncate max-w-150 mx-auto">
							<a href="{{ route("residents.show", $item->resident_id) }}">{{ $item->resident->fullname }}</a>
						</p>
						<p class="mb-0 fs-12 text-muted text-truncate max-w-150 mx-auto">{{ $item->resident->phone_number }}</p>
					</div>
				</div>
				<div class="text-center">
					<span class="badge bg-primary fs-12">{{ $item->purok->name }}</span>
				</div>
			</div>
			<div class="card-footer border-block-start-dashed text-center p-0">
				<div class="d-flex align-items-center justify-content-center">
						<div class="d-flex p-3 w-100 justify-content-center border-end">
								<div class="text-center ">
									<p class="fw-semibold mb-0">Term From</p>
									<span class="text-muted fs-12">{{ $item->term_from->format("F d, Y") }}</span>
								</div>
						</div>
						<div class="d-flex p-3 w-100 justify-content-center">
								<div class="text-center">
									<p class="fw-semibold mb-0">Term To</p>
									<span class="text-muted fs-12">{{ $item->term_to->format("F d, Y") }}</span>
								</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	@empty
		<div class="col-lg-5 mx-auto">
			<div class="card custom-card">
				<div class="card-body text-center">
					<div class="avatar avatar-xxl avatar-rounded">
						<img src="{{ asset("assets/images/avatar/administrator.png") }}" alt="Avatar" />
					</div>
					<h5 class="text-default mb-0 mt-2">No Current Active Purok Leaders Available</h5>
				</div>
			</div>
		</div>
	@endforelse
</div>
@endsection 