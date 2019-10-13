<?php

require_once 'vendor/autoload.php';
require_once 'db.conf.php';

class User extends \Illuminate\Database\Eloquent\Model {

    public function posts(){
        return $this->hasMany(Post::class);
    }

}



class Post extends \Illuminate\Database\Eloquent\Model {
    public function User (){
        return $this->belongsTo(User::class);
    }

    public function Category (){
        return $this->belongsTo(Category::class);
    }


    public function Tag (){
return $this->belongsToMany(Tag::class);
    }
}

class Category extends \Illuminate\Database\Eloquent\Model {
    public function posts(){
        return $this->hasMany(Post::class);
    }
}

class Tag extends \Illuminate\Database\Eloquent\Model {
    public function Post () {
        return $this->belongsToMany(Post::class);
    }
}

//SELECT * FROM tables.posts WHERE user_id=1;
echo 'Вывод постов пользователя';
echo '<hr>';
$user = User::find(1);
//var_dump($user);
//var_dump($user->posts);
var_dump($user->name);
echo '<hr>';
foreach ($user->posts as $post){
    var_dump($post->id);
    var_dump($post->title);
    var_dump($post->description);
    echo '<hr>';

}

//SELECT * FROM tables.posts WHERE category_id=5;
echo 'Вывод постов по категории';
echo '<hr>';
$category=Category::find(5);
//var_dump($category);
//var_dump($category->posts);
var_dump($category->title);
echo '<hr>';
foreach ($category->posts as $post){
    var_dump($post->id);
    var_dump($post->title);
    var_dump($post->description);
    echo '<hr>';
}

//SELECT * FROM tables.users LEFT JOIN posts p on users.id = p.user_id;
echo 'Вывод пользователя по посту';
echo '<hr>';
foreach(Post::all() as $post) {
    var_dump($post->id);
    var_dump($post->title);
    var_dump($post->description);
    var_dump($post->user->name);
    echo '<hr>';
}

//SELECT * FROM tables.categories LEFT JOIN posts p on categories.id = p.category_id;
echo 'Вывод категории по посту';
echo '<hr>';
foreach (Post::all() as $post) {
    var_dump($post->id);
    var_dump($post->title);
    var_dump($post->description);
    var_dump($post->category->title);
    echo '<hr>';
}

//SELECT * FROM posts LEFT JOIN post_tag pt on posts.id = pt.post_id WHERE posts.id=2;
echo 'Вывод тегов поста';
echo '<hr>';
$post=Post::find(2);
//var_dump($post);
var_dump($post->title);
//var_dump($post->tag);
echo '<hr>';
foreach ($post->tag as $tag){
    var_dump($tag->id);
    var_dump($tag->title);
    var_dump($tag->description);
    echo '<hr>';
}

//SELECT * FROM tags LEFT JOIN post_tag pt on tags.id = pt.tag_id WHERE tag_id=3;
echo 'Вывод постов по тегу';
echo '<hr>';
$tag=Tag::find(3);
//var_dump($tag);
//var_dump($tag->post);
var_dump($tag->title);
echo '<hr>';
foreach ($tag->post as $post) {
    var_dump($post->id);
    var_dump($post->title);
    var_dump($post->description);
    echo '<hr>';
}