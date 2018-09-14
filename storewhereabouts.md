# Store

Used to store the whereabouts of the bus, latitude, longitude and time when request was made.

**URL** : `/api/1.0/buses/busno/store`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "busno" : "[valid bus no of as bus e.g 8840]",
    "lat"   : "[Latitude of the bus is a number]",
    "long"  : "[Longitude of the bus is a number]",
    "time"  : "[Time is valid DateTime string in format year-month-day hour:min:sec ]"
}
```

**Data example for a bus**

```json
{
   "lat"  : 34.237289,
   "long" : 74.9990089,
   "time" : "2018-06-10 12:51:23"
}
```

## Success Response

**Code** : `201 Created`

**Content example on ist time**

```json
{
  "status": "inserted whereabouts"
}
```
## Success Response

**Code** : `201 Created`

**Content example when record present **

```json
{
  "status": "updated whereabouts"
}
```

## Error Response

**Condition** : If 'busno'  passed is not found in database.

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
## Error Response

**Condition** : If validation fails

**Code** : `400 Bad Request`

**Content** :

```json
{
    "errors": {
        "time": [
            "The time does not match the format Y-m-d h:i:s."
        ]
    }
}
```