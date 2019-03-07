# Learning Laravel - Eloquent Relationships

This repository was created to learn more about the Eloquent's relatioships.

## Eager Loading

Tutorial from [Laravel News](https://laravel-news.com/eloquent-eager-loading).

### Introduction
At a basic level, ORMs “lazy” load related model data. After all, how’s the ORM supposed to know your intention? Perhaps you will never actually use the related model’s data after querying the model. Not optimizing the query is known as a “N+1” issue. When you use objects to represent queries, you might be making queries without even knowing it.

Imagine that you were received 100 objects from the database, and each record had 1 associated model (i.e. belongsTo). Using an ORM would produce 101 queries by default; one query for the original 100 records, and additional query for each record if you accessed the related data on the model object. In pseudo code, let’s say you wanted to list all published authors that have contributed a post. From a collection of posts (each post having one author) you could get a list of author names like so:

```
$posts = Post::published()->get(); // one query

$authors = array_map(function($post) {
    // Produces a query on the author model
    return $post->author->name;
}, $posts);
```

We are not telling the model that we need all the authors, so an individual query happens each time we get the author’s name from the individual Post model instances.

### How Eager Loading works with Eloquent ORM
As I mentioned, ORMs “lazy” load associations. If you intend to use the associated model data you can trim that 101 query total to 2 queries using eager loading. You just need to tell the model what you need it to load eagerly. So let's see it in action.

We are finally ready to see eager loading in action. Maybe the best way to visualize eager loading is logging queries to the storage/logs/laravel.log file. To log database queries, you can either enable the MySQL log or listen for database calls from Eloquent. To log queries through Eloquent, add the following code to the app/Providers/AppServiceProvider.php boot() method:

```
namespace App\Providers;

use DB;
use Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
    }

    // ...
}
```

Let’s see what happens when we don’t load model relations eagerly. Clear out your storage/log/laravel.log file and run the “tinker” command.

```
php artisan tinker

>>> $posts = App\Post::all();
>>> $posts->map(function ($post) {
...     return $post->author;
... });
>>> ...
```

If you check your laravel.log file, you should see a bunch of queries to get the associated author:

```
[2017-08-04 06:21:58] local.INFO: select * from `posts`  
[2017-08-04 06:22:06] local.INFO: select * from `authors` where `authors`.`id` = ? limit 1 [1] 
[2017-08-04 06:22:06] local.INFO: select * from `authors` where `authors`.`id` = ? limit 1 [1] 
[2017-08-04 06:22:06] local.INFO: select * from `authors` where `authors`.`id` = ? limit 1 [1]
....
```

Empty your laravel.log file again, and this time call with() to eager load the author records:

```
php artisan tinker

>>> $posts = App\Post::with('author')->get();
>>> $posts->map(function ($post) {
...     return $post->author;
... });
...
```

This time you should only see two queries in the log file. The first query for all the posts, and the second query for all the associated authors.

```
[2017-08-04 07:18:02] local.INFO: select * from `posts`  
[2017-08-04 07:18:02] local.INFO: select * from `authors` where `authors`.`id` in (?, ?, ?, ?, ?) [1,2,3,4,5] 
```

If you had multiple related associations, you can eager load them with an array:

```
$posts = App\Post::with(['author', 'comments'])->get();
```

### Lazy Eager Loading
You might only need to gather associated models based on a conditional. In this case, you can lazily invoke additional queries for related data:

```
php artisan tinker

>>> $posts = App\Post::all();
...
>>> $posts->load('author.profile');
>>> $posts->first()->author->profile;
...
```

You should see three queries total, but only if $posts->load() is called.