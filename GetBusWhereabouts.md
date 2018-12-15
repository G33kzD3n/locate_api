# Get Bus Whereabouts
Used to collect the latest whereabouts of the bus.

**URL** : `/api/1.0/buses/{busno}/whereabouts`

**Method** : `GET`

**Auth required** : NO

**Data constraints**

```json
{
    "busno" : "[valid bus no of as bus e.g 8840]"
}
```

**Data example for a bus**

```json
{
    "busno" : 8840
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
  "bus": {
      "lat"  : 34.237289,
      "lng"  : 74.9990089,
      "time" : "2018-06-10 12:51:23"
    }
}
```

## Error Response

**Condition** : If '{busno}'  passed is not found in database.

**Code** : `404 Not Found`

**Content** :

```json
{
    "error": {
        "error_code"    : "resource_not_found_error",
        "error_message" : "Resource not found errors arise when your request is trying to access the resources not found in datbase."
    }
}
```