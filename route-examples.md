# Laravel Route Examples

This file contains various examples of how to define routes in Laravel.

## Basic Routes

Returning a view:
```php
Route::get('/', function () {
    return view('welcome');
});

Route::get("/jobs", function () {
    return view("jobs");
})->name("jobs");
```

## Request Information

Getting details from the incoming request:
```php
Route::get("/test", function (Request $request) {
    return [
        "method" => $request->method(),
        "url" => $request->url(),
        "fullUrl" => $request->fullUrl(),
        "path" => $request->path(),
        "ip" => $request->ip(),
        "userAgent" => $request->userAgent(),
        "header" => $request->header(),
    ];
});
```

## Query Parameters

Accessing query parameters from the request URL:
```php
Route::get("/users", function (Request $request) {
    return [
        "query" => $request->query("name")
        // "query"=>$request->only(["name","email"])
        // "query"=>$request->all(),
        // "query"=>$request->has("name"),
        // "query"=>$request->has("filter"),
        // "query"=>$request->input("name"),
        // "query"=>$request->input("name","Default Name"),
        // "query"=>$request->except(["password"]),
    ];
});
```

## Responses

### HTML Response

Returning a raw HTML response with a specific status code and content type header:
```php
Route::get("/test2", function () {
    return response("<h1>Hello-World</h1>", 200)->header("Content-Type", "text/html");
});
```

### JSON Response

Returning a JSON response and setting a cookie:
```php
Route::get("/test3", function () {
    return response()->json(["name" => "Ahmed", "age" => "40"])->cookie("name", "Ahmed Lotfy");
});
```

### File Download

Forcing a file download:
```php
Route::get("/download", function () {
    return response()->download(public_path("favicon.ico"));
});
```

## Cookies

### Setting a Cookie
```php
Route::get("/set-cookie", fn () => response("Cookie has been set.")->cookie("name", "Ahmed Lotfy"));
```

### Reading a Cookie
```php
Route::get("/read-cookie", function (Request $request) {
    $cookieValue = $request->cookie("name");
    return response()->json(["cookie" => $cookieValue], 200);
});
```

## Custom Response

Creating a custom response with a specific status code:
```php
Route::get("notfound", function () {
    return new Response("Page Not Found !", 404);
});
