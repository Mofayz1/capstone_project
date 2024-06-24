@extends($activeTemplate.'layouts.frontend')
@section('content')
@include($activeTemplate . 'partials.breadcrumb')
<section class="blog-details-section pt-120 pb-120">
  	<div class="container">
    	<div class="row">
	        <div class="col-lg-12">
	            @php echo $data->data_values->details @endphp
      		</div>
    	</div>
  	</div>
</section>
@endsection


