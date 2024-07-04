@extends('layout')
@section('content')
    <?php
    $Parsedown = new Parsedown();
    $curr_page = url('/') . '?q=' . app('request')->input('q') . '&page=' . app('request')->input('page');

    function searchANDpage($search = null, $page = null)
    {
        // Retrieve the current search and page values from the request
        $currentSearch = app('request')->input('q', 'rehan'); // Default search is 'rehan'
        $currentPage = app('request')->input('page', 1); // Default page is 1

        // Use provided search value or default to current search value
        $search = $search ?: $currentSearch;

        // Use provided page value or default to current page value
        $page = $page ?: $currentPage;

        return 'q=' . $search . '&page=' . $page;
    }

    echo searchANDpage(app('request')->input('q'), app('request')->input('page'));
    ?>



    <div class="align-centre" style="padding: 5px">
        <form action="{{ url('/search?') }}" class="search-form" method="GET">
            <div class="form-group">
                <span class="icon icon-search"></span>
                <input type="hidden" name="page" value="{{ app('request')->input('page') }}">
                <input type="text" class="form-control" value="{{ app('request')->input('q') }}" name="q"
                    placeholder="Search Here">
            </div>

        </form>



    </div>








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
    @endforeach




    <div class="row">
        <div class="col">
            <div class="block-27">

                <ul class="colorlib-active">
                    <li>
                        @if (app('request')->input('page', 1) > 1)
                            <a href="{{ url('/search') . '?' . searchANDpage(app('request')->input('q'), app('request')->input('page') - 1) }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        @else
                            <span aria-hidden="true">&laquo;</span>
                        @endif
                    </li>
                    @for ($i = 1; $i <= 7; $i++)
                        <li class="{{ request()->input('page') == $i ? 'active' : '' }}">
                            <a
                                href="{{ url('/search') . '?q=' . app('request')->input('q') . '&page=' . $i }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li>
                        @if (app('request')->input('page', 1) < 7)
                            <a href="{{ url('/search') . '?' . searchANDpage(app('request')->input('q'), app('request')->input('page') + 1) }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        @else
                            <span aria-hidden="true">&raquo;</span>
                        @endif
                    </li>
                </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
