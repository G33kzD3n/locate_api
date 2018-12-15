
# Update Coordinator.

Used to update the details of an existing coordinator .

**URL** : `/api/admin/1.0/users/{username}`

**Method** : `POST`

**Auth required** : Yes
>**NOTE** : Pass the **{username}** in the api to edit the profile of this user.

>Also set the headers
```
Accept: application/json,
Authorization : Bearer admin_api_token.
```
The endpoint to update the Coordinator is
 ```
 POST :/api/admin/1.0/users/{username}
 ```

>**Authorization Header** need to be set in the post request api, **and please keep space between Bearer and api_token.**
>Example:  Authorization : Bearer **api_token**.
>Where **api_token** is the token recieved on login.

  >Note : Remember , the api users must put avatar and _method in the payload as well .
  Example:
  ```typescript
      const  payload  =  new FormData();
      payload.append('_method', 'PATCH');
      payload.append('avatar', this.file  ==  null  ?  null  : this.file, this.file  ==  null  ?  null  : this.file.name);
      ...
  ```
**Data constraints**   The  required fields for coordinator are.
```json
     "name"      : "required and must be string",
     "username"  : "required|numeric|digits_between:11,11",
     "level"     : "required|numeric|digits_between:1,1|level of coordinator is 2",
     "phone_no" :"required|numeric|digits_between:10,10",
     "dept_id"  :"required|string",
     "bus_no"   : "required|numeric|digits_between:4,4",
     "registered_on":"required|date_format:Y-m-d"
     "stop_id"    : "required|numeric",
```

**Data example for a coordinator update**   Shows passed values.

```json
{
     "name"      : "Samiullah ",
     "username"  : "150451120037",
     "level"     : "1",
     "phone_no"  : "9018887766",
     "dept_id"   : "PGDCS",
     "bus_no"    : "8840",
     "registered_on" : "2018-12-11",,
     "stop_id"    : "5",
}
```

## Success Response

**Code** : `201 Created`
```json
{
     "status" : "user updated successfully."
}
```
## Error Response

**Condition** : If '{username}'  passed in api endpoint not found database.

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
**Condition** : If 'username'  passed in the payload form already exists for some-other user.
**Code** : `400 Bad Request`

**Content** :

```json
{
 "error" : {
     "error_code" : "database_exception_error",
     "error_message" : "Database exception errors occur when database operations throw exception.",
     "database_exception_error" : "Duplicate entry '99999992002' "
   }
}
```
**Condition** : If  'avatar'  passed in the payload form in not an image.
**Code** : `400 Bad Request`

**Content** :

```json
{
     "errors" : "The avatar must be an image."
}
```
**Condition** : If  'avatar'  passed in the payload form has size above 400 Kb.
**Code** : `400 Bad Request`

**Content** :

```json
{
    "errors" : "The avatar size must under 400k only "
}
```
**Condition** : If form validation fails.

**Code** : `404 Not Found`

**Content** :

```json
{
   "errors": {
       "username": [
            "The username must be between 11 and 11 digits."
        ]
    }
}
```