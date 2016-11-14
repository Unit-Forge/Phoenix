---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_b8000ecd215a9d60dbc76041902c1d3b -->
## Get all Categories

Returns all categories

> Example request:

```bash
curl "http://localhost/api/documentation/categories" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/documentation/categories`

`HEAD api/documentation/categories`


<!-- END_b8000ecd215a9d60dbc76041902c1d3b -->
<!-- START_d9e8a04fbb500226bb8a84b420291483 -->
## Get a Category

Retrieves a category and returns it

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/documentation/categories/{category}`

`HEAD api/documentation/categories/{category}`


<!-- END_d9e8a04fbb500226bb8a84b420291483 -->
<!-- START_2c38397e713af83f2a6b1866cf0fbed3 -->
## Get all Sections

Returns all Sections

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/documentation/categories/{category}/sections`

`HEAD api/documentation/categories/{category}/sections`


<!-- END_2c38397e713af83f2a6b1866cf0fbed3 -->
<!-- START_d96ef8dd1544122a02c25d51aa8fc241 -->
## Get a Section

Retrieves section and returns it

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/documentation/categories/{category}/sections/{section}`

`HEAD api/documentation/categories/{category}/sections/{section}`


<!-- END_d96ef8dd1544122a02c25d51aa8fc241 -->
<!-- START_36e8d2e56ffa5050aae4fc81a38a8ec4 -->
## Get all Pages

Returns all categories

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}/pages" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}/pages",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/documentation/categories/{category}/sections/{section}/pages`

`HEAD api/documentation/categories/{category}/sections/{section}/pages`


<!-- END_36e8d2e56ffa5050aae4fc81a38a8ec4 -->
<!-- START_2b884dc4fcd46fc80dfcf04cf5961e6e -->
## Get a Page

Retrieves page and returns it

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}/pages/{page}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}/pages/{page}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[]
```

### HTTP Request
`GET api/documentation/categories/{category}/sections/{section}/pages/{page}`

`HEAD api/documentation/categories/{category}/sections/{section}/pages/{page}`


<!-- END_2b884dc4fcd46fc80dfcf04cf5961e6e -->
<!-- START_946d9d96c740104c8a399049676c6ebc -->
## Create a Category

Create a category based on the input

> Example request:

```bash
curl "http://localhost/api/documentation/categories" \
-H "Accept: application/json" \
    -d "name"="qui" \
    -d "order"="8681" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories",
    "method": "POST",
    "data": {
        "name": "qui",
        "order": 8681
},
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/documentation/categories`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 
    order | integer |  required  | 

<!-- END_946d9d96c740104c8a399049676c6ebc -->
<!-- START_1e3d1e646a63dac8ab247f74f1910874 -->
## Update a Category

Updates a category based on input

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}",
    "method": "PUT",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`PUT api/documentation/categories/{category}`


<!-- END_1e3d1e646a63dac8ab247f74f1910874 -->
<!-- START_db15d9932a74ee0c4ca40b2e72246d28 -->
## Delete a Category

Deletes a category based on ID

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}",
    "method": "DELETE",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`DELETE api/documentation/categories/{category}`


<!-- END_db15d9932a74ee0c4ca40b2e72246d28 -->
<!-- START_3167787bf6de96b48c18daf9fd1a43d9 -->
## Create a Section

Create a section based on the input

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections",
    "method": "POST",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/documentation/categories/{category}/sections`


<!-- END_3167787bf6de96b48c18daf9fd1a43d9 -->
<!-- START_a8801de898589042fbc934e98d767131 -->
## Update a Section

Updates a Section based on input

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}",
    "method": "PUT",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`PUT api/documentation/categories/{category}/sections/{section}`


<!-- END_a8801de898589042fbc934e98d767131 -->
<!-- START_9e33e2fdb5cba3a86e58a37d40a2fc9c -->
## Delete a Section

Deletes a Section based on ID

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}",
    "method": "DELETE",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`DELETE api/documentation/categories/{category}/sections/{section}`


<!-- END_9e33e2fdb5cba3a86e58a37d40a2fc9c -->
<!-- START_21702032a0ad22d5f5a0a461ff640574 -->
## Create a Page

Create a page based on the input

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}/pages" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}/pages",
    "method": "POST",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST api/documentation/categories/{category}/sections/{section}/pages`


<!-- END_21702032a0ad22d5f5a0a461ff640574 -->
<!-- START_617c236fc2261421e1fb09ecfe410baa -->
## Update a Page

Updates a page based on input

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}/pages/{page}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}/pages/{page}",
    "method": "PUT",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`PUT api/documentation/categories/{category}/sections/{section}/pages/{page}`


<!-- END_617c236fc2261421e1fb09ecfe410baa -->
<!-- START_7ffff229997451e18f1001f615cb66eb -->
## Delete a Page

Deletes a page based on ID

> Example request:

```bash
curl "http://localhost/api/documentation/categories/{category}/sections/{section}/pages/{page}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/api/documentation/categories/{category}/sections/{section}/pages/{page}",
    "method": "DELETE",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`DELETE api/documentation/categories/{category}/sections/{section}/pages/{page}`


<!-- END_7ffff229997451e18f1001f615cb66eb -->
