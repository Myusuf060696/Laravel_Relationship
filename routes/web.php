<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('create_user', function() {
    $user = \App\User::create([
        'name'     => 'aliyah',
        'email'    => 'aliyah@gmail.com',
        'password' => bcrypt('larasati')
    ]);

    return $user;
});

Route::get('create_profile', function() {
    // $profile = \App\Profile::create([
    //     'user_id' => 1,
    //     'phone'   => '082225039153',
    //     'address' => 'Jalan Merdeka'
    // ]);

    $user = \App\User::find(2);

    $user->profile()->create([
        'phone' => '0882883',
        'address'   => 'Surabaya'
    ]);

    return $user->profile->address;
});

Route::get('/create_user_profile', function() {
    $user = \App\User::find(2);

    $profile = new App\Profile([
        'phone'   => '082225039142',
        'address' => 'Surabaya'
    ]);

    $user->profile()->save($profile);
    return $user;

});


Route::get('/read_user', function(){
    $user = \App\User::find(2);

    return $user->profile->address;
});

Route::get('/read_profile', function() {
    $profile = \App\Profile::where('phone', '082225039142')->first();

    return $profile->user->name;
});


Route::get('/update_profile', function() {
    $user = \App\User::find(2);

    $user->profile()->update([
        'address'   => 'Palembang'
    ]);
    return $user->profile->address;
});

Route::get('/delete_profile', function() {
    $user = \App\User::find(2);
    $user->profile()->delete();

    return $user;
});


Route::get('/create_post', function() {
    $user = \App\User::find(2);

    $user->posts()->create([
        'title' => 'Post1',
        'body'  => 'Haloo'
    ]);

    return 'Success';
});

Route::get('/read_post', function() {
    $user = \App\User::find(2);
    // dd($user->posts()->get());
    $posts = $user->posts()->get();
    foreach($posts as $post){
        $data[] = [
            'name'    => $post->user->name,
            'post_id' => $post->id,
            'title'   => $post->title,
            'body'    => $post->body
        ];
    }

    return $data;
});

Route::get('/update_post', function() {
    $user = \App\User::find(2);

    $user->posts()->whereId(1)->update([
        'title' => 'Judul Edit',
        'body'  => 'Isi Edit'
    ]);

    return $user->posts()->whereId(1)->first();
});

Route::get('/delete_post', function(){
    $user = \App\User::find(2);

    return $user->posts()->delete();

});

Route::get('/create_categories', function() {
    $post = \App\Post::findOrFail(5);


    /* Membuat categori dan pivot */
    $post->categories()->create([
        'slug' => str_slug('Aliyah'),
        'category'  => 'Aliyah'
    ]);

    return 'Yes';
});

Route::get('/read_category', function() {
    $post = \App\Post::find(5);

    // dd($post->categories());
    // $categories = $post->categories;
    // foreach($categories as $category){
    //     echo $category->category."<br>";
    // }

    $category = \App\Category::find(2);
    $posts = $category->posts;

    foreach($posts as $post){
        echo $post->title. '<br>';
    }
});


Route::get('/attach', function() {
    $post = \App\Post::find(5);
    $post->categories()->attach([1,2]);

    return 'Yes';
});

Route::get('/detach', function() {
    $post = \App\Post::find(5);
    $post->categories()->detach([1,2]);

    return 'Yes';
});

/* Menghindari Duplicate, Untuk mengupdate, Atau Memastikan  */
Route::get('/sync', function() {
    $post = \App\Post::find(5);
    $post->categories()->sync([1]);
    return 'Yes';
});
