@extends('layouts.app')

@section('title'){!! $blog->name . ' | ' . env('APP_NAME') !!}@endsection
@section('description'){!!  html_entity_decode(\Str::limit(strip_tags($blog->detail), 100)) !!}@endsection
@section('keywords'){!! $blog->category->name . ', ' . implode(', ', $blog->tags->pluck('name')->toArray()) !!}@endsection


@section('content')
    <div class="section breadcrumb_section bg_gray custom_breadcrumb">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 mb-3">
                    <div class="page-title">
                        <h1>{!! $blog->name !!}</h1>
                    </div>
                </div>
                <div class="col-md-12">
                    @include('layouts.breadcrumb')
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single_post">
                        <div class="blog_img">
                            <img src="{!! $blog->image ? image($blog->image, 1110) : image($blog->cover, 1110) !!}"
                                 alt="{!! $blog->name !!}">
                            <div class="blog_tags">
                                <a class="blog_tags_cat"
                                   style="background-color: {{ $blog->category->color ?: "#4382FF" }}"
                                   href="{!! $blog->category->url !!}">
                                    {!! $blog->category->name !!}
                                </a>
                            </div>
                        </div>
                        <div class="blog_content">
                            <div class="blog_text">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <h2 class="blog_title">{!! $blog->name !!}</h2>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="float-right">
                                            <img class="author-circle d-none d-sm-inline"
                                                 src="{!! image($blog->admin->image, 50, 50) !!}"
                                                 alt="{!! $blog->admin->name !!}" height="30">
                                            <span>{!! $blog->admin->name !!}</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="blog_meta">
                                    <li>
                                        <i class="far fa-calendar-alt"></i>
                                        <span>{!! localeDate($blog->date) !!}</span>
                                    </li>
                                    <li class="d-none d-sm-block">
                                        <i class="far fa-comments"></i>
                                        <span>{!! $comments->count() !!} Yorum</span>
                                    </li>
                                    <li class="d-none d-sm-block">
                                        <i class="far fa-eye"></i>
                                        <span>{!! $blog->view_count !!} Görüntülenme</span>
                                    </li>
                                </ul>
                                <div class="blog-detail">
                                    {!! $blog->detail !!}
                                </div>
                                <div class="blog_post_footer">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-md-8 mb-3 mb-md-0">
                                            <div class="artical_tags">
                                                <i class="fa fa-tags"></i>
                                                @foreach($blog->tags as $tag)
                                                    <a href="{!! $tag->category->url . '?tags=' . $tag->slug !!}">{!! strto('lower', $tag->name) !!}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($others->isNotEmpty())
                        <div class="blog_detail_others d-none d-sm-block">
                            <div class="container">
                                <h3>Diğer Yazılar</h3>
                                <div class="row">
                                    @foreach($others as $other)
                                        <div class="blog_post col-lg-4 col-md-4">
                                            <div class="blog_img">
                                                <a href="{!! $other->url !!}">
                                                    <img src="{!! image($other->cover, 340, 230) !!}"
                                                         alt="{!! $other->name !!}"
                                                         width="350" height="230">
                                                </a>
                                            </div>
                                            <div class="blog_content">
                                                <div class="blog_text">
                                                    <h5 class="blog_heading"><a
                                                            href="{!! $other->url !!}">{!! $other->name !!}</a>
                                                    </h5>
                                                    <ul class="blog_meta">
                                                        <li>
                                                            <i class="far fa-calendar-alt"></i>
                                                            <span>{!! localeDate($other->date) !!}</span>
                                                        </li>
                                                        @if($other->comments_count > 0)
                                                            <li>
                                                                <i class="far fa-comments"></i>
                                                                <span>{!! $blog->comments_count !!} Yorum</span>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="comment-area">
                        @if($comments->isNotEmpty())
                            <div class="content_title">
                                <h5>({!! $comments->count() !!}) Yorum</h5>
                            </div>
                            <ul class="list_none comment_list">
                                @foreach($comments as $comment)
                                    <li class="comment_info">
                                        <div class="d-flex">
                                            <div class="comment_user d-none d-lg-block d-md-block">
                                                <div class="profile-image ">
                                                    {!! getProfileImage($comment->user_name) !!}
                                                </div>
                                            </div>
                                            <div class="comment_content">
                                                <div class="d-lg-flex d-md-flex d-sm-block">
                                                    <div class="meta_data">
                                                        <h6>
                                                            {!! $comment->user_name !!}
                                                        </h6>
                                                        <div class="comment-time">
                                                            {!! localeDate($comment->created_at) !!}
                                                        </div>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <p>
                                                            Bu yazıyı
                                                            {!! $comment->useful == 1 ? "<span class='text-success'>faydalı buldu.</span>" : "<span class='text-danger'>faydalı bulmadı.</span>" !!}
                                                        </p>
                                                    </div>
                                                </div>
                                                {!! $comment->detail !!}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="alert hidden"></div>
                        <form class="field_form">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 mt-2">
                                        <div class="content_title">
                                            <h5>Mesajını Gönder</h5>
                                        </div>
                                    </div>
                                    <div class="offset-lg-2 offset-md-2 col-lg-6 col-md-6">
                                        <div class="btn-group float-lg-right">
                                            <span class="mr-5 mt-2">Faydalı mı?</span>
                                            <label class="btn btn-sm btn-success active"
                                                   style="border-top-left-radius: 1.25rem; border-bottom-left-radius: 1.25rem; !important">
                                                <input type="radio" name="useful" value="1" checked> Evet
                                            </label>
                                            <label class="btn btn-sm btn-light"
                                                   style="border-top-right-radius: 1.25rem; border-bottom-right-radius: 1.25rem; !important">
                                                <input type="radio" name="useful" value="0"> Hayır
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <input name="user_name" class="form-control" placeholder="Adınız" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <input name="user_email" class="form-control" placeholder="E-posta Adresiniz"
                                           type="email">
                                </div>
                                <div class="form-group col-md-12">
                                        <textarea rows="5" name="detail" class="form-control"
                                                  placeholder="Mesajınız"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <button class="btn btn-default" id="senderBtn"
                                            title="Yorumunu Gönder!">Gönder
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('#senderBtn').on('click', function (e) {
            e.preventDefault()
            var formData = $(this).closest('form').serialize();
            $.ajax({
                'url': "{{ route('blog.commentSave') }}",
                'method': "post",
                'data': formData,
                success: function (response) {
                    content = "" +
                        "<ul>" +
                        "   <li>İlginiz için teşekkür ederim. Mesajınız onaya gönderilmiştir.</li>" +
                        "</ul>";

                    $('div.alert').html(content);
                    $('div.alert').removeClass('alert-danger');
                    $('div.alert').addClass('alert-success').show();
                    $('.field_form').remove();
                },
                error: function (response) {
                    content = "<ul>";
                    console.log(response)
                    $.each(response.responseJSON, function (k, value) {
                        content += "<li>" + value + "</li>";
                    });
                    content += "</ul>";

                    $('div.alert').html(content);
                    $('div.alert').addClass('alert-danger').show();

                }
            })
        });

        $("input[name='useful']").on('click', function () {
            var el = $(this).parent();

            if ($(this).val() == 1) {
                el.removeClass('btn-light');
                el.addClass('btn-success');
                el.closest('.btn-group').find('label.active').removeClass('btn-danger').removeClass('active').addClass('btn-light')
            } else {
                el.removeClass('btn-light');
                el.addClass('btn-danger');
                el.closest('.btn-group').find('label.active').removeClass('btn-success').removeClass('active').addClass('btn-light')
            }
            el.addClass('active');
        });

        $('.blog-detail').find('img').parent().addClass('text-center');
    </script>

    @php
        $coverImageSize = getimagesize(asset("/assets/images/logo.png"));
        $imageImageSize = getimagesize(image($blog->image));
    @endphp
    <script type="application/ld+json">
    {
       "@context": "http://schema.org",
       "@type": "BlogPosting",
       "author": {
            "@type": "Person",
            "name": "{{ $blog->admin->name }}"
       },
       "url": "{{ $blog->url }}",
       "publisher":{
          "@type":"Organization",
          "name":"{{ env("APP_NAME") }}",
          "url": "{{ env("APP_URL") }}",
          "logo":{
              "@type"	: "ImageObject",
              "url"	: "{{ url("/assets/images/logo.png") }}",
              "height": {{ $coverImageSize[1] }},
              "width" : {{ $coverImageSize[0] }}
          }
       },
       "headline": "{{ $blog->name }}",
       "mainEntityOfPage": "{{ $blog->url }}",
       "articleBody": "{{ html_entity_decode(\Str::limit(strip_tags($blog->detail), 150)) }}",
       "image":{
           "@type"	: "ImageObject",
           "url"	: "{{ image($blog->cover) }}",
           "height": {{ $coverImageSize[1] }},
           "width" : {{ $coverImageSize[0] }}
       },
       "datePublished":"{{ $blog->created_at }}",
       "dateModified":"{{ $blog->updated_at }}"
    }
    </script>
@endpush
