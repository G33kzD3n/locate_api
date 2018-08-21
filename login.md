# Login

Used to collect a Token, Level, Bus No for a registered User.
These users in this use-case are not the admin's.

**URL** : `/api/1.0/login/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "user_id": "[valid user_id is actually the rollno/employe_id issued by the the university]",
    "password": "[password in plain text]"
}
```

**Data example for a student**

```json
{
    "user_id": "15045112037",
    "password": "abcd1234"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{	
	"level" : "2",
	"bus_no”: "8840",
    "token" : "93144b288eb1fdccbe46d6fc0f241a51766ecd3d"
}
```

## Error Response

**Condition** : If 'user_id' and 'password' combination is wrong.

**Code** : `400 BAD REQUEST`

**Content** :

```json
{
    "field_errors": [
        "Unable to login with provided credentials."
    ]
}
