@extends('layout')
@section('content')
    <?php
    $Parsedown = new Parsedown();
    $curr_page = url('/') . '?q=' . app('request')->input('q') . '&page=' . app('request')->input('page');
    function new_page($page)
    {
        return url('/search') . '?q=' . app('request')->input('q') . '&page=' . $page;
    }
    function searchANDpage($search, $page)
    {
        // If $search and $page parameters are provided, use them
        if ($search != '' && $page != '') {
            $search = app('request')->input('q');
            $page = app('request')->input('page');
            return 'q=' . $search . '&page=' . $page;
        } else {
            // Otherwise, use the request input or default values
            $search = app('request')->input('q', 'rehan');
            $page = app('request')->input('page', 1); // Default page is 1
            return 'q=' . $search . '&page=' . $page;
        }
    }

    // Example usage
    echo searchANDpage(app('request')->input('q'), app('request')->input('page'));

    // echo $curr_page;

    ?>


    {{--
    <div class="align-centre" style="padding: 5px">
        <form action="{{ url('/search?page=' . app('request')->input('page')) }}" class="search-form" method="GET">
            <div class="form-group">
                <span class="icon icon-search"></span>
                <input type="text" class="form-control" value="{{ app('request')->input('q') }}" name="q"
                    placeholder="Search Here">
            </div>
            <p>Total results: {{ $results->total() }}</p>
            <p>Showing {{ $blogs->count() }} results</p> --}}

    {{-- ceil($results->total() / $blogs->count()) --}}
    {{-- </form> --}}





    {{-- </div> --}}







    {{--
    @foreach ($blogs as $row)
        <div class="blog-entry ftco-animate d-md-flex">
            <div style="padding-left:10px; "> <a onclick="openlightbox('{{ url('public/blog/' . $row->blog_image) }}')"
                    class="img img-2" style="background-image: url({{ url('public/blog/' . $row->blog_image) }});"></a>
            </div>

            <div class="text text-2 pl-md-4" style="text-align: right">
                <h3 class="heading"><a href="{{ url('/blog/' . $row->blog_id) }}">{{ $row->blog_title }}</a></h3>
                <div class="meta-wrap">
                    <p class="meta">
                        <span><i class="icon-person mr-2">Masood Khan</i></span>
                        <span><i class="icon-calendar mr-2"></i>{{ $row->created_at }}</span>
                    </p>
                </div>
                <div style="max-height: 60px; overflow: hidden; margin-bottom: 5px">
                    <span>{!! $Parsedown->text($row->blog_short_desc) !!}


                    </span>
                </div>

                <p> <a href="{{ url('/blog/' . $row->blog_id) }}" class="btn-custom">Read More <span
                            class="ion-ios-arrow-forward"></span></a></p>
            </div>
        </div>
    @endforeach --}}

    {{-- <div class="row">
        <div class="col">
    @for ($i = 1; $i <= 7; $i++)
        <li class="{{ request()->is('http://localhost/urdublog/search?page=' . $i) ? 'active' : '' }}">
            <a href="{{ url('http://localhost/urdublog/search?page=' . $i) }}">{{ $i }}</a>
        </li>
    @endfor
        </div>
    </div> --}}


    {{-- <div class="row">
        <div class="col">
            <div class="block-27">

                <ul class="colorlib-active">
                    <li>
                        <a href="$curr_page" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= 7; $i++)
                        <li class="{{ request()->input('page') == $i ? 'active' : '' }}">
                            <a href="{{ new_page($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li>
                        <a href="curr_page" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                </nav>
            </div>
        </div>
    </div> --}}
@endsection
