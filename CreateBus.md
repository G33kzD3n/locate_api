
# Create Bus.
Used to create a new bus into the bus inventory.

**URL** : `/api/admin/1.0/buses`

**Method** : `POST`

**Auth required** : Yes
>NOTE: **Authorization Header** need to be set in the post request api, **and please keep space between Bearer and api_token.**
>Set the headers
```
Content-Type : application/json,
Accept: application/json,
Authorization : Bearer admin_api_token.

```
>Example:  Authorization : Bearer **api_token**.
>Where **api_token** is the token recieved on login.

**Data constraints**

```json
{
    "bus_no"     : "[valid bus no of as bus e.g 8840, to be passed as form payload]",
    "gps_device_id"  : "[unique gps device id]",
}
```

**Data example for a bus**

```json
{
   "bus_no"  : 8812,
   "gps_device_id" : "sdsada-123Wwdqw-sadas142-sssdass"
}
```

## Success Response

**Code** : `201 Created`
```json
{
  "status": "created"
}
```
## Error Response

**Condition** : If 'busno'  passed in form payload or gps_device id is  already found in database.

**Code** : `422 Unprocessable Entity`

**Content** :

```json
{
   "errors": {
        "bus_no": [
            "The bus no has already been taken."
        ],
        "gps_device_id": [
            "The gps device id has already been taken."
        ]
    }
}
```