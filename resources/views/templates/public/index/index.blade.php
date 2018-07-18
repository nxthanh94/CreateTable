    <div class="col-lg-12">
        <h1 class="page-header">{{$title}}</h1>
    </div>
    <!-- /.col-lg-12 -->
<div class="row">
    <div class="col-lg-12">
        <article>
        	@if(Auth::check())
        		@if(Auth::user()->content !="")
					{!! Auth::user()->content !!}
        		@else
        			{!!$about['content']!!}
        		@endif
        	@else
        		{!!$about['content']!!}
        	@endif
        </article>
    </div> 
</div>