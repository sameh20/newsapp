<!DOCTYPE html  >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@yield('title')
<title>NEWS SITE</title>

<link href="{{url('public/css/font-awesome.min.css')}}" rel="stylesheet"  />

<link href="{{url('public/css/bootstrap.min.css')}}" rel="stylesheet"  />
<link href="{{url('public/css/bootstrap-theme.min.css')}}" rel="stylesheet"  />
<link href="{{url('public/css/style.css')}}" rel="stylesheet"  />
<script src="{{url('public/js/jquery.min.js')}}"></script>
<script src="{{url('public/js/bootstrap.min.js')}}"></script>

</head>

<body>
<div class="col-md-12 top" id="top">
	<div class="col-md-9 top-left">
    	<div class="col-md-3">
    		<span class="day">{{date('l,d,M ,Y')}}</span> 
        </div>
        <div class="col-md-9">
        	<span class="latest">Latest News Bar: </span> <a href="{{url('article')}}/{{$latestnews->slug}}">{{$latestnews->title}}</a>
        </div>
    </div>
<div class="col-md-3 top-social">
@foreach($settings->social as $key =>$social)
<a href="{{$social}}" class="social-icon"><i class="fa fa-{{$icons[$key]}}"></i></a>
@endforeach
    </div>
</div>

<div class="col-md-12 brand">
	<div class="col-md-4 name">
		@if($settings->image)
		<a href="{{url('/')}}"><img src="{{url('public/settings')}}/{{$settings->image}}" width="90%" height="70" alt="logo"/></a>
@endif
	</div>
    <div class="col-md-8">
		@if($leaderboard )
    	<a href="{{$sidebartop->url}}"><img src="{{url('public/advertisments')}}/{{$leaderboard->image}}"
			 width="100%" alt="{{$leaderboard->title}}" /></a>
		@endif
    </div>
</div>

<div class="col-md-12 main-menu">
	<div class="col-md-10 menu">
		<nav class="navbar">
			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar"> 
					<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
            		<span class="icon-bar"></span>
        		</button>
    		</div>
    		<div class="collapse navbar-collapse" id="mynavbar">
    			<ul class="nav nav-justified">
    				<li><a href="{{url('/')}}" class="active"><span class="glyphicon glyphicon-home">
						</span></a></li>
						@foreach ($categories as $cat)
						<li><a href="{{url('category')}}/{{$cat->slug}}" class="text-uppercase">{{$cat->title}}</a></li>
						@endforeach
        		</ul> 
			</div>
		</nav>
	</div>
	<div class="col-md-2 ">
		<div class="search">
    	<input type="search" class="form-control" id="search-content" />
		<span class="glyphicon glyphicon-search search-btn"></span>
		<div id="search-output">

		</div>
    </div>
</div> 
{{-- head --}}

@yield('content')

<!--- footer -->
<div class="col-md-12 bottom">
    <div class="col-md-4">
        <h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">About Us</span></h3>
		@if($settings->image)
		<a href="{{url('/')}}"><img src="{{url('public/settings')}}/{{$settings->image}}" width="100%" height="85" alt="logo"/></a>
@endif
        <p align="justify">{{$settings->about}}</p>
    </div>
    <div class="col-md-4">
        <div class="col-md-12">
            <h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Quick Links</span>
			</h3>
			<ul class="nav">
				@foreach($pages as  $page)
			  <li><a href="{{url('page')}}/{{$page->slug}}" class="text-uppercase">{{$page->title}}</a></li>
			  @endforeach
			  <li><a href="{{url('contact-us')}}" class="text-uppercase">Contact Us</a></li>

		  </ul> 
        </div>    
            </div>
        
    <div class="col-md-4">
        <h3 style="border-bottom:2px solid #ccc;"><span style="border-bottom:2px solid #f00;">Contact Us</span></h3>
		@if($settings->image)
		<a href="{{url('/')}}">	<img src="{{url('public/settings')}}/{{$settings->image}}" width="100%" height="85" alt="logo"/></a>
		@endif
        <p>Follow us at:</p>
			@foreach($settings->social as $key =>$social)
			<a href="{{$social}}" class="social-icon"><i class="fa fa-{{$icons[$key]}}"></i></a>
			@endforeach
			<a href="#top" class="goto"><span class="glyphicon glyphicon-chevron-up"></span></a>

			</div>
    </div>


<div class="col-md-12 text-center copyright">
Copyright &copy; {{date('Y')}} | LaraNews Powered by: <a href="#">Sameh Abo Elmagd</a>
</div>
<script>            
	$(document).ready(function() {
		var duration = 500;
		$(window).scroll(function() {
			if ($(this).scrollTop() > 500) {
				$('goto').fadeIn(duration);
			} else {
				$('goto').fadeOut(duration);
			}
		});

		$('goto').click(function(event) {
			event.preventDefault();
			$('html').animate({scrollTop: 0}, duration);
			return false;
		})
		$('#search-content').keyup(function(){
			var text = $('#search-content').val()
			if(text.length <1){
			$('#search-output').hide()

				return false
			}else{
				$.ajax({
					type:'get',
					url: "{{url ('search-content')}}",
					data : {text:text},
					success : function(res){
						$('#search-output').show();
						$('#search-output').html(res)
					}
				})
			}
	
  })
	});
	var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
   };

</script>	
<style>
	.search{
		position: relative;
	}
	.search-btn{
		color: #fff;
		top:-25px;
		left: 160px;
		font-size: 18px;
		
	}
	.social-icon{
	background-color: #2ca0c9;
	padding: 5px 10px;
	color: #fff;
	font-size: 20px;
   }
   .top-social{
	padding-top: 8px;
  }
    .realtive{
	position: relative;
  }
    .realtive .caption{
	position:absolute;
	bottom: 0px;
	width: 100%;
	padding: 10px;
	left: 0;
	background: rgba(0, 0, 0,0.7);
	text-transform: capitalize
    }
    .image-gallery img{
	width:100%;
 	}	
	.flex{
			display: flex;
			flex-wrap: nowrap;
			margin: 0 -5px;
		}
		.flex div{
			width: 30%;
			padding: 0 5px;
		}
		.goto {
		color:rgb(44, 160, 201);
		font-size: 35px;
		position: fixed;
		bottom: 5px;
		right: 20px;
		z-index: 10;
		}	
		.also-like h3{
			color: #333
		}	
		a{
			text-decoration: none !important;
		}
	   .search input{
	     border:1px solid #249bc6;
	     background:#242424;
	     color:#f1f1f1;
	     margin-top:3px;
	}
	 #search-output{
		 position: absolute;
		 width: 100%;
		 height: auto;
		 padding: 10px;
		 box-sizing: border-box;
		 background: #fff;
		 top:100%;
		 left:0;
		 display:none;
		 z-index: 2;
	 }
	 #search-output ul{
		 list-style: none;
		 border: 3px solid #249bc6
	 }
	 #search-output ul li a{
		 padding: 0 0 5px;
		 display: block;
		 color: #333;
	 }
	 
       .view-count h3,.share-this h3{
		   color: #333;
	   }
	   .twitt-btn{
		   position: relative;
		   top: 5px;
	   }
	   .sidebar-adv{
		   margin:30px 0 ;
	   }
</style>
</body>
</html>
