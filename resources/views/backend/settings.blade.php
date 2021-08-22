@extends('backend.master')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 title">
                <h1><i class="fa fa-bars"></i> Settings</h1>
            </div>

            <div class="col-sm-4 cat-form">
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissable fade-in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        {{ Session('message') }}
                    </div>
                @endif
                <h3>Website Settings</h3>
				@if(isset($data)<1)
                <form method="POST" action="{{ url('addsettings') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="tbl" value="{{ encrypt('settings') }}" />
                    <div class="form-group">
                        <label>Logo</label>
						<p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
						<p><label for="file" style="cursor: pointer;" class="btn btn-warning">Upload Image</label></p>
						<p><img id="output"  /></p>
                    </div>
                    <div class="form-group">
                        <label>About Us</label>
                        <textarea name="about" class="form-control" rows="10"></textarea>
                    </div>
                    <div id="socialfieldgroup">
                        <div class="form-group">
                            <label>Social</label>
                            <input type="url" name="social[]" class="form-control">
                            <p class="text-muted">e.g.https://www.facebook/news.com</p>
                        </div>
                    </div>
                    <div class="text-right form-group">
                        <span class="btn btn-warning" id="addsocialfield"><i class="fa fa-plus"></i></span>
                    </div>
					<div class="form-group">
						<span class="alert alert-danger alert-dismissable noshow" id="socialalert">
							<a href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>Soryy !</strong> You Have Reached The  Social fields limit.
						</span>
					</div>

                    <div class="form-group">
                        <button class="btn btn-primary">Add Settings</button>
                    </div>
                </form>
				<script>
					var socialcounter= 1;

					$('#addsocialfield').click(function() {

						socialcounter ++;
						if(socialcounter>5){
							{
								$('#socialalert').show()
								return;
							}
						}
							newDiv = $(document.createElement('div')).attr('class', 'form-group');
							newDiv.after().html('<input type="url" name="social[]"  class="form-control" ></div>');
							newDiv.appendTo('#socialfieldgroup')
						})
					</script>
			@else
			<form method="POST" action="{{ url('updatesettings') }}/{{$data->sid}}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="tbl" value="{{ encrypt('settings') }}" />
				<input type="hidden" name="sid" value="{{$data->sid}}" />

				<div class="form-group">
					<label>Logo</label>
					@if(!empty($data->image))
					<p><img src="{{url('public/settings')}}/{{$data->image}}" id="output"/></p>
					<p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
						<p><label for="file" style="cursor: pointer;" class="btn btn-warning">Replace Image</label></p>
					@else
					<input type="file" name="image" class="form-control">

					@endif
				</div>
				<div class="form-group">
					<label>About Us</label>
					<textarea name="about" class="form-control" rows="10">{{$data->about}}</textarea>
				</div>
				<div id="socialfieldgroup">
					<div class="form-group">
						<label>Social</label>
						@foreach ($data->social as $social)
				<div class="form-group" >

						<input type="url" name="social[]" class="form-control socialcount" value="{{$social}}" >
				</div>
						@endforeach
					</div>
				</div>
				<div class="text-right form-group">
					<span class="btn btn-warning" id="addsocialfield"><i class="fa fa-plus"></i></span>
				</div>
				<div class="form-group">
					<span class="alert alert-danger alert-dismissable noshow" id="socialalert">
						<a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Soryy !</strong> You Have Reached The  Social fields limit.
					</span>
				</div>

				<div class="form-group">
					<button class="btn btn-primary">Update Settings</button>
				</div>
			</form>
				<script>
					var socialcounter= $('.socialcount').length;

					$('#addsocialfield').click(function() {

						socialcounter ++;
						if(socialcounter>5){
							{
								$('#socialalert').show()
								return;
							}
						}
							newDiv = $(document.createElement('div')).attr('class', 'form-group');
							newDiv.after().html('<input type="url" name="social[]"  class="form-control" ></div>');
							newDiv.appendTo('#socialfieldgroup')
						})
					</script>
@endif
            </div>

        </div>
    </div>
<style>
	.noshow{
		display: none;
	}
	.close{
		text-decoration: none !important;
		color: #fff !important;
	}
</style>
    <script>
		var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
	</script>

        @stop
