<main class="post blog-post col-lg-8">
    <div class="container">
        <div class="post-single">
            @if (!empty($data->image))
            <div class="post-thumbnail">
                <img src="{{ asset($data->image) }}" alt="{{ $data->name }}" class="img-fluid">
            </div>
            @endif

            <div class="post-details">
                <div class="post-meta d-flex justify-content-between">
                    @if ($data->categories->count() > 0)
                    <div class="category">
                        @foreach ($data->categories as $category)
                        <a href="{{ getUrl($category) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    @endif
                </div>
                <h1>{{ $data->name }}
                    @if (Auth::check())
                        <a href="/bookmark" data-value="{{ $data->id }}" class="bookmark saveBookmark" @if(checkBookmark($data->id, Auth::user()->id)) style="opacity: 1" @endif><i class="far fa-bookmark"></i></a>
                    @endif
                </h1>
                <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="javascript:void(0);"
                        class="author d-flex align-items-center flex-wrap">
                        <div class="title"><span>{{ getUser($data) }}</span></div>
                    </a>
                    <div class="d-flex align-items-center flex-wrap">
                        <div class="date"><i class="far fa-clock"></i> {{ date("d/m/Y", strtotime($data->created_at) )
                            }}</div>
                        <div class="views"><i class="far fa-eye"></i> {{ $data->views }}</div>
                        <div class="comments meta-last"><i class="fas fa-comment-alt"></i> {{ countComment($data->id) }}
                        </div>
                    </div>
                </div>
                <div class="post-body">
                    <p class="lead">{{ $data->description }}</p>
                    {!! $data->content !!}
                </div>

                <div class="post-comments">
                    <header>
                        <h3 class="h6">Bình luận<span class="no-of-comments">({{ countComment($data->id) }})</span></h3>
                    </header>

                    @include('public.partials.blog.comment', ['post' => $data->id])
                </div>

                @if (Auth::check())
                    <div class="add-comment">
                        <header>
                            <h3 class="h6">Viết bình luận</h3>
                        </header>
                        <form action="{{ route('public.comment', $data->id) }}" method="POST" class="commenting-form">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea name="comment" id="comment" placeholder="Nhập bình luận"
                                        class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <a class="btn btn-secondary submitComment text-white">Submit Comment</a>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="add-comment">
                        <a href="{{ route('public.login') }}"><h3 class="h6">Đăng nhập để viết bình luận</h3></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('assets/js/comment.js') }}"></script>