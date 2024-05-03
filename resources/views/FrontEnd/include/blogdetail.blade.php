@extends('FrontEnd.master')
@section('title')
    Chi Tiết Bài Viết
@endsection
@section('content')
    <div class="mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="">
                       
						<div class="single-article-text">
							<div class="single-artcile-bg">
                                <img src="/blog/{{$blogdetails->blogdetail_image}}" class="img-fluid w-100" alt="" style="height: 450px;">
                            </div>
							<p class="blog-meta">
								<span class="author"><i class="fas fa-user"></i>Admin</span>
								<span class="date"><i class="fas fa-calendar"></i>Ngày Viết: {{$blogdetails->created_at->format('Y-m-d')}}</span>
                                <span class="comment"><i class="fas fa-comment"></i>Số Lượng Bài Viết: {{$blogdetails->blog_slug}}</span>
							</p>
							<h2>{{$blogdetails->blogdetail_content}}</h2>
							<p>
                                {{$blogdetails->blogdetail_detail}}
                            </p>
						</div>
                      
                        
						<!-- Phầm Comment Bài Viết -->
						<div class="comments-list-wrap">
							<h3 class="comment-count-title">{{$blogdetails->getComment->count()}} Comments</h3>
							@foreach($blogdetails->getComment as $comment)
							<div class="comment-list">
								<div class="single-comment-body">
									<div class="comment-user-avater">
										<img src="{{asset('/frontend')}}/img/vegetable-item-6.jpg" alt="">
									</div>
									<div class="comment-text-body">
										<h4>{{$comment->customer->name}} <span class="comment-date">{{date('d M Y',strtotime($comment->created_at))}} at {{date('h:i A',strtotime($comment->created_at))}}</span> <button class="btn btn-sm btn-light">Phản Hồi</button></h4>
										<p>
											{{$comment->comment}}
										</p>
										
									</div>
								</div>
							</div>
							@endforeach
						</div>

						<div class="comment-template">
							<h4>Để lại lời bình luận</h4>
							<p>Nếu bạn có ý kiến đừng ngần ngại gửi cho chúng tôi ý kiến của bạn.</p>
							<form action="{{ route('comment_blog') }}" method="post">
								@csrf
								<input type="hidden" name="customer_id" value="{{ session('customer_id') }}">
								<input type="hidden" name="blogdetail_id" value="{{$blogdetails->blogdetail_id}}">
								<p><textarea name="comment" id="comment" cols="30" rows="10" placeholder="Lời nhắn"></textarea></p>
								<p><input class="btn btn-info btn-block" type="submit" value="Gửi"></p>
							</form>
						</div>

					</div>
				</div>
				<div class="col-lg-4">
					<div class="sidebar-section">
						<div class="recent-posts">
							<h4>Bài Viết Gần Đây</h4>
							<ul>
								<li><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></li>
								<li><a href="single-news.html">A man's worth has its season, like tomato.</a></li>
								<li><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></li>
								<li><a href="single-news.html">Fall in love with the fresh orange</a></li>
								<li><a href="single-news.html">Why the berries always look delecious</a></li>
							</ul>
						</div>
						<div class="tag-section">
							<h4>Từ Khóa Tìm Kiếm</h4>
							<ul>
								<li><a href="single-news.html">Apple</a></li>
								<li><a href="single-news.html">Strawberry</a></li>
								<li><a href="single-news.html">BErry</a></li>
								<li><a href="single-news.html">Orange</a></li>
								<li><a href="single-news.html">Lemon</a></li>
								<li><a href="single-news.html">Banana</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title text-center">
                        <h2 class="text-center">Bài Viết Được Yêu Thích</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fas fa-calendar"></i> Ngày Viết: May 4,2019</li>
                                <li><i class="fas fa-comment"></i> Số Lượng Bài Viết: 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-2.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="img/blog/blog-3.jpg" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection