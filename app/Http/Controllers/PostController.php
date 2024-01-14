<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index(){

        $posts= Post::with('comment')->get();
        return view('frontend.home',compact('posts'));

    }
    public function store(request $request){
        Post::create([
            'userid'=> $request->id,
            'content'=>$request->content,


        ]);
        return redirect()->back()->with('message','post added succesfully') ;
    }
    // public function addlike($authid,$postid){
    //     $post=Post::find($postid);
    //     $like=$post->likes;
    //     $islike=0;


    //     if($like){
    //         foreach($like as $like){
    //             if($like['userid']==$authid){
    //                 $islike++;
    //                 break;
    //             }
    //         }
    //     }else{
    //         $like= [];

    //     }
    //     if($islike == 0){
    //         array_push($like,['userid',$authid]);
    //         $post->update([
    //             'likes' => $like,
    //         ]);
    //     }
    //     return redirect()->back();

    // }
    public function addLike($authId, $postId)
{
    $post = Post::find($postId);
    $likes = $post->likes;
    $isLiked = false;

    if ($likes) {
        foreach ($likes as $like) {
            if ($like['userid'] == $authId) {
                $isLiked = true;
                break;
            }
        }
    } else {
        $likes = [];
    }

    if (!$isLiked) {
        $likes[] = ['userid' => $authId];

        $post->update([
            'likes' => $likes,
        ]);
    }

    return redirect()->back();
}
public function removelike($authId, $postId)
{
    $post = Post::find($postId);
    $likes = $post->likes;

    if ($likes) {
        foreach ($likes as $key => $like) {
            if ($like['userid'] == $authId) {
                unset($likes[$key]);
                break;
            }
        }

        $post->update([
            'likes' => array_values($likes), // Reindex the array
        ]);
    }

    return redirect()->back();
}


}
