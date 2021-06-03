<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">{{ __($config['moduleName']) }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a></li>
                        <?php $segments = ''; ?>
                        @foreach(Request::segments() as $segment)
                            <?php $segments .= '/'.$segment; ?>
                            <li class="breadcrumb-item">
                                <a href="{{ $segments }}">{{$segment}}</a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
