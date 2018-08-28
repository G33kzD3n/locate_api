# Profile

Used to collect a single user resource for profile.

**URL** : `/api/1.0/users/username`

**Method** : `GET`

**Auth required** : Valid user token must be passed in HTTP Header i.e *Authorization : Bearer* must be passed to request with valid token.

**Data constraints**

```json
{
    "username"  : "[valid username is 11 digit number from 154045112000-2038] must be present in url after users",
    "api_token" : "[60 character string] must be passed in Authorization : Bearer header, Don't use api_token key as form payload."
}
```

**Data example for a student**

```json
{
    "username" : "15045112037",
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
   "data": {
        "level"            :  2,
        "name"             : "Miss Germaine Terry MD",
        "bus_no"           :  8839,
        "dept_code"        :  "CSE",
        "course_code"      :  "BTECHCSE",
        "semester_level"   :   2,
        "avatar"           :  "15045112038.jpg",
        "registration_date":  "2017-01-22",
        "cell_no"          :  9059370950
    }
}
```

## Error Response

**Condition** : If 'username' passed is not found in database.

**Code** : `404 Not Found`

**Content** :

```json
{
    "error": {
        "error_code"   : "resource_not_found_error",
        "error_message": "Resource not found errors arise when your request is trying to access the resources not found in datbase."
    }
}
```
___
**Condition** : If  *Authorization : Bearer* isn't set for request or *Authorization token* is invalid.

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "error": {
        "error_code"   : "token_error",
        "error_message": "Token errors arise when HTTP Authorization request header isn't set for request or the token passed in invalid."
    }
}
```
