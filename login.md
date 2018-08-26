# Login

Used to collect Token, Level, Bus No for a registered User.
The End users in this use-case are not the admin's.

**URL** : `/api/1.0/login`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "username" : "[valid username is 11 digit number from 154045112000-2038]",
    "password" : "[valid password is date in format Year-month-day]"
}
```

**Data example for a student**

```json
{
    "username" : "15045112037",
    "password" : "1990-01-01"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
   "bus_no": 8840,
   "token" : "93144b288eb1fdccbe46d6fc0f241a51766ecd3d",
   "level" : 2
}
```

## Error Response

**Condition** : If 'username' and 'password' validation fails.

**Code** : `404 BAD REQUEST`

**Content** :

```json
{
   "errors": {
       "username": [
            "The username must be between 11 and 11 digits."
        ],
        "password": [
            "The password does not match the format Y-m-d."
        ]
    }
}
```

**Condition** : If 'username' and 'password' validation passes but no user found.

**Code** : `401 BAD REQUEST`

**Content** :

```json
{
   "errors": {
      'error_title'  => 'Authtication Failed.',
      'error_message'=> 'Credentials donot match.',
    }
}
```
