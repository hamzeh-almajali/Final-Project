@extends('frontend.main_master')
@section('header')
@include('frontend.body.header')
@endsection
@section('body')

<div class="gap gray-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="row" id="page-contents">
                    @include('frontend.body.rightsidebar')

                    <div class="col-lg-6">
                        <div class="central-meta">
                            <div class="new-postbox">
                                <figure>
                                    <img src="{{asset('images/'.Auth::user()->profile_image)}}" alt="">
                                </figure>
                                <div class="newpst-input">
                                    <form method="post" action="{{route('postcreate')}}">
                                        @csrf
                                        <textarea rows="2" placeholder="write something" name="content"></textarea>
                                        <div class="attachments">
                                            <ul>
                                                {{-- <li>
                                                    <i class="fa fa-music"></i>
                                                    <label class="fileContainer">
                                                        <input type="file">
                                                    </label>
                                                </li> --}}
                                                <li>
                                                    <i class="fa fa-image"></i>
                                                    <label class="fileContainer">
                                                        <input type="file" accept="image/*" name="file">
                                                    </label>
                                                </li>
                                                <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
                                                {{-- <li>
                                                    <i class="fa fa-video-camera"></i>
                                                    <label class="fileContainer">
                                                        <input type="file">
                                                    </label>
                                                </li> --}}
                                                {{-- <li>
                                                    <i class="fa fa-camera"></i>
                                                    <label class="fileContainer">
                                                        <input type="file">
                                                    </label>
                                                </li> --}}
                                                <li>
                                                    <button type="submit">Post</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div><!-- add post new box -->
                        <div class="loadMore">
                        @foreach ($posts as $post )
                        
                        <div class="central-meta item">
                            <div class="user-post">
                                <div class="friend-info">
                                    <figure>
                                        <img src="{{asset('images/'.$post->user->profile_image)}}" alt="">
                                    </figure>
                                    <div class="friend-name">
                                        <ins><a href="time-line.html" title="">{{Auth::user()->name}}</a></ins>
                                        <span>{{$post->created_at->diffForHumans()}}</span>
                                    </div>
                                    <div class="post-meta">
                                        @if (!$post->image)
                                        <img src="{{asset('frontend/assets/images/resources/user-post.jpg')}}" alt="">
                                        @endif
                                        <div class="we-video-info">
                                            <ul>
                                                <li>
                                                    <span class="views" data-toggle="tooltip" title="views">
                                                        <i class="fa fa-eye"></i>
                                                        <ins>1.2k</ins>
                                                    </span>
                                                </li>

                                                <li>
                                                    <span class="comment" data-toggle="tooltip" title="Comments">
                                                        <i class="fa fa-comments-o"></i>
                                                        <ins>{{$post->comment->count()}}</ins>
                                                    </span>
                                                </li>
                                                <li>
                                                    @if($post->isLikedBy(Auth::user()->id))
                                                    <span class="like" data-toggle="tooltip" title="like" style="color: orange;">
                                                        <a href="{{route('removelike',['authid'=>Auth::user()->id ,'postid' => $post->id])}}"><i class="ti-heart"></i></a>
                                                        <ins>{{$post->totalLikes()}}</ins>
                                                    </span>
                                                    @else
                                                    <span class="like" data-toggle="tooltip" title="like">
                                                        <a href="{{route('addlike',['authid'=>Auth::user()->id ,'postid' => $post->id])}}"><i class="ti-heart"></i></a>
                                                        <ins>{{$post->totalLikes()}}</ins>
                                                    </span>


                                                    @endif
                                                </li>
                                                {{-- <li>
                                                    <span class="dislike" data-toggle="tooltip" title="dislike">
                                                        <i class="ti-heart-broken"></i>
                                                        <ins>200</ins>
                                                    </span>
                                                </li>
                                                <li class="social-media">
                                                    <div class="menu">
                                                      <div class="btn trigger"><i class="fa fa-share-alt"></i></div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-html5"></i></a></div>
                                                      </div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-facebook"></i></a></div>
                                                      </div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-google-plus"></i></a></div>
                                                      </div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-twitter"></i></a></div>
                                                      </div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-css3"></i></a></div>
                                                      </div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-instagram"></i></a>
                                                        </div>
                                                      </div>
                                                        <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-dribbble"></i></a>
                                                        </div>
                                                      </div>
                                                      <div class="rotater">
                                                        <div class="btn btn-icon"><a href="#" title=""><i class="fa fa-pinterest"></i></a>
                                                        </div>
                                                      </div>

                                                    </div>
                                                </li> --}}
                                            </ul>
                                        </div>
                                        <div class="description">

                                            <p>
                                                {{$post->content}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="coment-area">
                                    <ul class="we-comet">
                                        @foreach ($post->comment as $comment )


                                        <li>
                                            <div class="comet-avatar">
                                                <img src="{{asset('images/'. $comment->user->profile_image)}}" alt="">
                                            </div>
                                            <div class="we-comment">
                                                <div class="coment-head">
                                                    <h5><a href="time-line.html" title="">{{$comment->user->name}}</a></h5>
                                                    <span>{{$comment->created_at->diffForHumans()}}</span>
                                                    <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                </div>
                                                <p>{{$comment->content }}</p>
                                            </div>

                                        </li>
                                        @endforeach
                                        <li>
                                            <a href="#" title="" class="showmore underline">more comments</a>
                                        </li>
                                        <li class="post-comment">
                                            <div class="comet-avatar">
                                                <img src="{{asset('images/'.Auth::user()->profile_image)}}" alt="">
                                            </div>
                                            <div class="post-comt-box">
                                                <form method="post" action="{{route('commentcreate')}}">
                                                    @csrf
                                                    <textarea placeholder="Post your comment" name="content"></textarea>
                                                    <input type="hidden" name="userid" value="{{Auth::user()->id}}" />
                                                    <input type="hidden" name="postid" value="{{$post->id}}" />
                                                    <button type="submit" style="color: orange"> send</button>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                    @include('frontend.body.liftsidebar')
                </div></div></div></div></div>

@endsection
@section('footer')
@include('frontend.body.footer')
@endsection
