@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	Issue Sports Certificate
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/select2/select2.min.css") }}">
@endsection


@section("body")
<div class="page-header">
	<h1 class="page-title my-auto">Sports Certificate</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Forms</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Sports Certificate</li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Forms</h4>
			</div>
			<div class="card-body">
				<form action="{{ route("certificate.store.sports") }}" method="POST">
					@csrf
					<table class="table table-sm text-nowrap mb-4" id="datatable">
						<thead>
							<tr>
								<th>Resident Name</th>
								<th>Precinct No.</th>
								<th></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					<div class="row g-3">
						
						<div class="col-md-6">
							<label class="form-label fs-14 text-dark">OR Number</label>
							<input type="text" name="or_number" class="form-control" placeholder="Enter or number" required />
						</div>
		
						<div class="col-md-6">
							<label class="form-label fs-14 text-dark">Purpose</label>
							<textarea name="purpose" placeholder="Purpose" class="form-control" required></textarea>
						</div>
		
						<div class="col-12">
							<label class="form-label fs-14 text-dark">Password</label>
							<div class="input-group">
								<input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your password" name="password" required />
								<button type="button" class="btn btn-light bg-transparent" onclick="createpassword('password', this)">
									<i class="ti ti-eye align-middle"></i>
								</button>
							</div>
							<span class="mt-2">
								<b class="text-danger">Important:</b> For security reasons, we must verify your identity when you seek to generate a certificate. Please provide your password to proceed.
							</span>
						</div>
						<div class="col-12">
							<button
								type="submit"
								class="btn btn-primary btn-wave waves-light"
							>
								Generate Form
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Resident Checker</h4>
			</div>
			<div class="card-body">
				<div class="mb-2">
					<label class="form-label fs-14 text-dark">Resident Name</label>
					<select 
						class="form-control select2-ajax" 
						data-select-placeholder="Search by last name..." 
						data-select-case="{{ route("api.case") }}"
						data-select-api="{{ route("api.search") }}" required></select>
				</div>
				<div id="form-loader" class="d-none">
					<div class="text-center py-2">
						<div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
				<div id="form-result" class="text-center d-none">
					<svg class="custom-alert-icon svg-success d-none" style="width: 5rem;height:5rem;" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
					<svg class="custom-alert-icon svg-danger d-none" style="width: 5rem;height:5rem;" xmlns="http://www.w3.org/2000/svg" height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM12 17.3c-.72 0-1.3-.58-1.3-1.3 0-.72.58-1.3 1.3-1.3.72 0 1.3.58 1.3 1.3 0 .72-.58 1.3-1.3 1.3zm1-4.3h-2V7h2v6z"/></svg>
					<h5></h5>
					<a href="#" target="_blank" class="text-primary fw-semibold text-decoration-underline d-none">
						View Case
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/select2/select2.min.js") }}"></script>
	<script src="{{ asset("assets/js/showpassword.js") }}"></script>
	<script src="{{ asset("assets/js/select.js") }}"></script>
	<script>
		$(".select2-ajax").change(function() {
			const id = $(this).val()
			const route = $(this).data("select-case")

			if (id) {
				$('input[name=resident]').val(id)
				$('#form-loader').removeClass('d-none')
				$('#form-result').addClass('d-none')
				$('#form-result h5').removeAttr('class')
				$('#form-result .svg-success').addClass('d-none')
				$('#form-result .svg-danger').addClass('d-none')
				$('#form-result a').addClass('d-none')

				$.ajax({
					url: route + "/" + id,
					type: "GET",
					dataType: "json",
					success: function(response) {
						const htmlContent = ` <tr>
							<td>
								<div class="d-flex justify-content-start align-items-center">
									<div class="avatar avatar-sm">
										<img src="${response.avatar}" alt="Resident Avatar" />
									</div>
									<div class="d-flex flex-column ms-2">
										<p class="fw-bolder mb-0 fs-14">${response.name}</p>
										<span>
											Age:
											<span class="badge bg-danger">${response.age}</span>
											Gender: 
											<span class="text-default">${response.gender}</span>
										</span>
									</div>
								</div>
							</td>
							<td>
								<input type="text" class="form-control" id="res-${id}" name="resident[${id}][precinct]" />
								<input type="hidden" name="resident[${id}][name]" value="${response.name}" />
							</td>
							<td>
								<button type="button"
									class="btn-delete btn btn-icon btn-sm btn-danger btn-wave waves-light"
									>
									<i class="ti ti-trash fs-16"></i>
								</button>
							</td>
						</tr>`;

						if ($(`#res-${id}`).length == 0) {
							$("#datatable").prepend(htmlContent)
						}

						$('#form-loader').addClass('d-none')
						$('#form-result').removeClass('d-none')
						$('#form-result h5').text(response.resident)
						if (response.status) {
							$('#form-result h5').addClass('text-success')
							$('#form-result .svg-success').removeClass('d-none')
						}else {
							$('#form-result .svg-danger').removeClass('d-none')
							$('#form-result h5').addClass('text-danger')
							$('#form-result a').removeClass('d-none')
							$('#form-result a').attr('href', response.link)
						}
					}
				});
			}else {
				$('#form-loader').addClass('d-none')
				$('#form-result').addClass('d-none')
				$('#form-result h5').removeAttr('class')
				$('#form-result .svg-success').addClass('d-none')
				$('#form-result .svg-danger').addClass('d-none')
				$('#form-result a').addClass('d-none')
			}
		})
		$('#datatable').on('click', '.btn-delete', function() {
			$(this).closest('tr').remove();
		});
	</script>
@endsection