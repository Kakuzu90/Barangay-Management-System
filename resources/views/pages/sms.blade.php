@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	SMS
	@endif
@endsection

@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">SMS</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Announcements</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">SMS</li>
		</ol>
	</div>
</div>

<div class="card custom-card">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table text-nowrap" id="datatable">
				<thead>
					<tr>
						<th>Mobile Number</th>
						<th>Message</th>
						<th>Network</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($data["table"] as $item)
						<tr>
							<td>
								<span>{{ $item->recipient }}</span>
							</td>
							<td>
								<span>{{ $item->message }}</span>
							</td>
							<td>
								<span>{{ $item->network }}</span>
							</td>
							<td>
								<span class="badge fs-12 bg-dark">{{ $item->status }}</span>
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
				order: [[0, "asc"]],
				lengthMenu: false,
				language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
			});
			$("#datatable_length").remove();
		})
	</script>
@endsection