<ul id="top_nav">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			{{ Config::get('languages')[App::getLocale()] }}
		</a>
		<ul class="dropdown-menu">
			@foreach (Config::get('languages') as $lang => $language)
				@if ($lang != App::getLocale())
					<li>
						<a href="{{ route('lang.switch', $lang) }}"><i class="fa fa-flag"></i> {{$language}}</a>
					</li>
				@endif
			@endforeach
		</ul>
	</li>
</ul>		