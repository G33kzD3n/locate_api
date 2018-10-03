
# Breakdown Store

Used to store the breakdown info.
> The **Event** named *breakdown-info-created* on channel *busno-channel* is generated when this api returns `Response with status code 201 Created`.
> The api user's must bind to the event-name **breakdown-info-created** .
 ```json
 Also the "record_id" in the "success response" must be saved , so that "coordinator" can later "update the message for this breakdown information".
 ```
 >
>NOTE: **busno** is to be passed in the *API-URL* only, not as *Form Payload*.

*EXAMPLE* :
 ```typescript
  let  breakdownInfoCreated = this.pusher.init('busno-channel');
  breakdownInfoCreated.bind('breakdown-info-created', (data) => {
      console.log(JSON.stringify(data)
  });
```
>
**URL** : `/api/1.0/buses/busno/breakdown`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "busno" : "[valid bus no of as bus e.g 8840, to be passed in api]",
    "type"   : "[valid string, to be passed in form.]",
    "time"  : "[Time is valid DateTime string in format year-month-day hour:min:sec, to be passed in form]"
}
```

**Data example for a bus**

```json
{
   "type" :"puncture",
   "time" : "2018-06-10 12:51:23"
}
```

## Success Response

**Code** : `201 Created`

**Content example on ist time**

```json
{
   "record_id" :"id of the created record",
   "status": "created",
   "message": "The Breakdown message has been saved successfully."
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