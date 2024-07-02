@extends('Layout')
@section('content')
    <?php


    $Parsedown = new Parsedown();
    ?>



    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex">
                <div class="col-xl-8 py-5 px-md-5">
                    <div class="row pt-md-4">

                        <div class="col-md-12">


                            @foreach ($blogs as $row)
                                <div class="blog-entry ftco-animate d-md-flex">
                                    <div style="padding-left:10px; "> <a
                                            onclick="openlightbox('{{ url('public/blog/' . $row->blog_image) }}')"
                                            class="img img-2"
                                            style="background-image: url({{ url('public/blog/' . $row->blog_image) }});"></a>
                                    </div>

                                    <div class="text text-2 pl-md-4" style="text-align: right">
                                        <h3 class="heading"><a
                                                href="{{ url('/blog/' . $row->blog_id) }}">{{ $row->blog_title }}</a></h3>
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
                        </div>

                    </div>

                </div>
                <div class="col-xl-4 sidebar ftco-animate bg-light pt-5"
                    style="overflow: scroll;height: 100%;scrollbar-width: none;">
                    <div class="sidebar-box pt-md-4">
                        <form action="{{ url('http://localhost/urdublog/search?search=') }}" class="search-form" method="GET">
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" name="search" class="form-control" placeholder="Type a keyword and hit enter">
                            </div>
                        </form>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="sidebar-heading">Popular Posts</h3>

                        @foreach ($blogs as $row)
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4"
                                    style="background-image: url({{ url('public/blog/' . $row->blog_image) }});"></a>
                                <div class="text">
                                    <h3 class="heading"><a href="#">{{ $row->blog_title }}</a></h3>
                                    <div class="meta">
                                        <div><a href="#"><span class="icon-calendar"></span>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('F d, Y') }}</a>
                                        </div>
                                        <div><a href="#"><span class="icon-person"></span> Masood Khan</a></div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="sidebar-box subs-wrap img py-4" style="background-image: url(images/bg_1.jpg);">
                        <div class="overlay"></div>
                        <h3 class="mb-4 sidebar-heading">Newsletter</h3>
                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
                        </p>
                        <form action="#" class="subscribe-form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email Address">
                                <input type="submit" value="Subscribe" class="mt-2 btn btn-white submit">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
