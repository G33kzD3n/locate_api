# Get User Fees

Used to get the fee details for a user, that will show the total fee amount to be paid, and no of unpaid months.

**URL** : `/api/1.0/users/{username}/fees/unpaid`

**Method** : `GET`

**Auth required** : No.

**Data constraints**

```json
{
    "username"  : "[valid username is 11 digit number from 154045112000-2038] must be present in url after users",
}
```

**Data example for User Fee.**

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
    "data" : {
        "name" :  "Asa O'Reilly",
        "monthly_fee" :  2000,
        "unpaid_months" :  4,
        "total_unpaid_fee" : 8000
    }
}
```

## Error Response

**Condition** : If '{username}'  passed is not found in database.

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
