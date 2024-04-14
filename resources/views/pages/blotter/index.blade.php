@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Blotter Lists
	@endif
@endsection

@section("body")
	
<div class="page-header">
	<h1 class="page-title my-auto">Blotter Lists</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Incident</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Blotter Lists</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xl-12">
		<div class="card custom-card">
			<div class="card-header justify-content-between">
				<div class="card-title">
						Manage Blotters
				</div>
				@can("blotter-store")
				<a
					href="{{ route("blotters.create") }}" class="btn btn-sm btn-primary btn-wave waves-light"
				>
					<i class="ti ti-plus fw-semibold align-middle me-1"></i> Create Blotter
				</a>
				@endcan
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table text-nowrap" id="datatable">
						<thead>
							<tr>
								<th>Complainant Name</th>
								<th>Respondent Name</th>
								<th>Involves</th>
								<th>Incident Date</th>
								<th>Date Hearing</th>
								<th>Status</th>
								<th>Tools</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@can("blotter-delete")
	@include("pages.modals.delete")
@endcan

@endsection

@section("scripts")
	<script src="{{ asset("assets/js/form-validation.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script>
		$(document).ready(function() {
			$("#datatable").DataTable({
				order: [[5, "asc"], [4, "asc"], [3, "asc"], [0, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();

			@can("blotter-delete")
			$(document).on("click", ".delete", function() {
				const route = $(this).data("route");
				const title = $(this).data("title");

				$("#delete #to-delete").text(title);
				$("#delete form").attr("action", route);
				$("#delete").modal("show");
			});
			@endcan
		});
	</script>
@endsection