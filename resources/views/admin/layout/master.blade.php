@include('admin.dashboard.includes.header')
@include('admin.dashboard.includes.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Information</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active">@yield('section', 'Data')</li>
            </ol>
        </nav>
    </div>
    <div>

    @yield ('header')
    </div>


    </main>
