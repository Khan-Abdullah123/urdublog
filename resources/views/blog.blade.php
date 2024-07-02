@extends('Layout')
@section('content')
    <?php
    // Function to detect if the text is in Urdu
    function isUrdu($text)
    {
        return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
    }
    $Parsedown = new Parsedown();

    ?>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row d-flex" style="width: 100%">
                <div class="col-xl-12 px-md-5 py-5" col-xl-4 sidebar ftco-animate bg-light pt-5 fadeInUp ftco-animated">
                    <div class="row pt-md-4">

                        @foreach ($blogs as $row)
                            <div class="col-md-12" style="width: 100%;">
                                <div class="blog-entry-2 ftco-animate">
                                    <a onclick="openlightbox('{{ url('public/blog/' . $row->blog_image) }}')"
                                        class="img img-2"
                                        style="background-image: url({{ url('public/blog/' . $row->blog_image) }});"></a>
                                    <div class="text pt-4">
                                        <h3
                                            class="heading {{ isUrdu($row->blog_title) ? 'urdu-alignment' : 'english-alignment' }}">
                                            <a href="{{ url('/blog/' . $row->blog_id) }}">{{ $row->blog_title }}</a>
                                        </h3>
                                        <p style="max-height: 60px; overflow: hidden; margin-bottom: 5px;">
                                            {!!$Parsedown->text ($row->blog_short_desc )!!}</p>
                                        <div class="author mb-4 d-flex align-items-center">

                                            <div class="ml-3 info">
                                                <span>Written by</span>
                                                <span><a href="{{ url('/blog/' . $row->blog_id) }}"
                                                        class="btn btn-primary p-3 px-xl-4 py-xl-3"
                                                        style="float: right">Continue Reading</a>
                                                </span>
                                                <h3><a href="#">Masood Khan</a>, <span>{{ $row->created_at }}</span>
                                                </h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endforeach

    </section>
@endsection
