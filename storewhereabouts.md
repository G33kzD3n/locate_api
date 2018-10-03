# Store

Used to store the whereabouts of the bus, latitude, longitude and time when request was made.
> The **Event** named *location-update* on channel *busno-channel* is generated when this api returns `Response with status code 201 Created`.
> The api user's must bind to the event-name **location-update** .
>
*EXAMPLE* :
 ```typescript
  let  locationUpdate = this.pusher.init('busno-channel');
  locationUpdate.bind('location-update', (data) => {
      console.log(JSON.stringify(data)
  });
```
>
>NOTE: **busno** is to be passed in the *API-URL* only, not as *Form Payload*.

**URL** : `/api/1.0/buses/busno/store`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "busno" : "[valid bus no of as bus e.g 8840, to be passed in api]",
    "lat"   : "[Latitude of the bus is a number,to be passed in form]",
    "lng"  : "[Longitude of the bus is a number, to be passed in form]",
    "time"  : "[Time is valid DateTime string in format year-month-day hour:min:sec, to be passed in form]"
}
```

**Data example for a bus**

```json
{
   "lat"  : 34.237289,
   "lng" : 74.9990089,
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

**Content example when record present**

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