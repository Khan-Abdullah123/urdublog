@extends('layout')
@section('content')
    <?php
    // Function to detect if the text is in Urdu
    function isUrdu($text)
    {
        return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
    }

    $Parsedown = new Parsedown();
    ?>




    <section class="ftco-section ftco-no-pt ftco-no-pb mobile-class">
        <div class="container">
            <div class="row d-flex">
                <div class="col-12 px-md-5 py-5">
                    <div class="row pt-md-4">
                        <h1 class="mb-3 {{ isUrdu($blog->blog_title) ? 'urdu-alignment' : 'english-alignment' }}">
                            {{ $blog->blog_title }}</h1>

                        <div class=" about-author d-flex p-4 bg-light " style="width: 100%; ">
                            <div class="mobile-class desc">
                                <h3>{!! $Parsedown->text($blog->post_qoute) !!}</h3>
                            </div>
                        </div>

                        <img src="{{ url('public/blog/' . $blog->blog_image) }}" alt="" style="max-height: 450px; width: 100%;     object-fit: contain;
    object-position: center;">

                        <p class=" mobile-class paragraph">{!! $Parsedown->text($blog->blog_short_desc) !!}</p>

                        <p class="mobile-class paragraph">{!! $Parsedown->text($blog->blog_long_desc) !!}</p>

                    </div>

                </div>
            </div>

        </div>
        </div>
    </section>


@endsection
