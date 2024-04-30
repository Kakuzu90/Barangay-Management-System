@extends("layouts.app")

@section("title")
	@if (Session::get("status"))
	Welcome {{ auth()->user()->resident->fullname }}
	@else
	System Settings
	@endif
@endsection

@section("styles")
	<link rel="stylesheet" href="{{ asset("assets/libs/quill/quill.snow.css") }}">
	<link rel="stylesheet" href="{{ asset("assets/libs/quill/quill.bubble.css") }}">
@endsection

@section("body")

<div class="page-header">
	<h1 class="page-title my-auto">System Settings</h1>
	<div>
		<ol class="breadcrumb mb-0">
			<li class="breadcrumb-item">
				<a href="javascript:void(0)">Barangay Record Management System</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">System Settings</li>
		</ol>
	</div>
</div>

<div class="row">

	<div class="col-md-6">
		<div class="card custom-card">
			<div class="card-header">
				<h4 class="card-title mb-0">
					System Mission
				</h4>
			</div>
			<div class="card-body">
				<form class="mission" action="{{ route("system-settings.update", $settings["mission"]->id) }}" method="POST">
					@csrf
					@method("PUT")
					<div id="editor">{!! $settings["mission"]->content !!}</div>
					<input type="hidden" name="content" />
					<button
						type="submit"
						class="btn btn-primary btn-wave waves-light mt-3"
					>
						Save Changes
					</button>
				</form>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="card custom-card">
			<div class="card-header">
				<h4 class="card-title mb-0">
					System Vision
				</h4>
			</div>
			<div class="card-body">
				<form class="vision" action="{{ route("system-settings.update", $settings["vision"]->id) }}" method="POST">
					@csrf
					@method("PUT")
					<div id="editor1">{!! $settings["vision"]->content !!}</div>
					<input type="hidden" name="content" />
					<button
						type="submit"
						class="btn btn-primary btn-wave waves-light mt-3"
					>
						Save Changes
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section("scripts")
	<script src="{{ asset("assets/libs/quill/quill.min.js") }}"></script>
	<script src="{{ asset("assets/js/quill.js") }}"></script>
	<script>
		$(document).ready(function() {
			$("form.mission").submit(function() {
				const quill = $(".mission .ql-editor")[0].innerHTML
				$(".mission input[name=content]").val(quill)
			})
			$("form.vision").submit(function() {
				const quill = $(".vision .ql-editor")[0].innerHTML
				$(".vision input[name=content]").val(quill)
			})
		})
	</script>
@endsection