@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	List of Transaction
	@endif
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">List of Transaction</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Reports</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">List of Transaction</li>
		</ol>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table text-nowrap" id="datatable">
				<thead>
					<tr>
						<th>Resident Name</th>
						<th>Purpose</th>
						<th>OR Number</th>
						<th>Transaction Type</th>
						<th>By</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($data["transactions"] as $item)
							<tr>
								<td>
									<div class="d-flex justify-content-start align-items-center">
										<div class="avatar avatar-sm">
											<img src="{{ $item->resident->avatar() }}" alt="Resident Avatar" />
										</div>
										<div class="d-flex flex-column ms-2">
											<p class="fw-bolder mb-0 fs-14">{{ $item->resident->fullname }}</p>
											<span>
												Age:
												<span class="badge bg-danger">{{ $item->resident->age }}</span>
												Gender: 
												<span class="text-default">{{ $item->resident->gender }}</span>
											</span>
										</div>
									</div>
								</td>
								<td>
									<span>{{ $item->purpose }}</span>
								</td>
								<td>
									<span class="fw-semibold text-primary">{{ $item->or_number }}</span>
								</td>
								<td>
									<span>{{ $item->type }}</span>
								</td>
								<td>
									<div class="d-flex justify-content-start align-items-center">
										<div class="avatar avatar-sm">
											<img src="{{ $item->official->resident->avatar() }}" alt="Resident Avatar" />
										</div>
										<div class="d-flex flex-column ms-2">
											<p class="fw-bolder mb-0 fs-14">{{ $item->official->resident->fullname }}</p>
											<span>
												Position:
												<span class="badge bg-primary">{{ $item->official->position->name }}</span>
											</span>
										</div>
									</div>
								</td>
								<td>
									<span>{{ $item->created_at->format("F d, Y") }}</span>
								</td>
							</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection

@section("scripts")
<script>
	$(document).ready(function() {
		$("#datatable").DataTable({
			ordering: false,
			lengthMenu: false,
			language: {
					searchPlaceholder: 'Search...',
					sSearch: '',
			},
		});
		$("#datatable_length").remove();
	});
</script>
@endsection