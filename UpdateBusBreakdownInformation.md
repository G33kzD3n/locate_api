
# Update Bus Breakdown

Update to breakdown information of bus.

> The **Event** named *breakdown-info-updated* on channel *busno-channel* is generated when this api returns `Response with status code 200 Ok`.
> The api user's must bind to the event-name **breakdown-info-updated** .

*EXAMPLE* :
 ```typescript
  let  breakdownInfoUpdated = this.pusher.init('busno-channel');
  breakdownInfoUpdated.bind('breakdown-info-updated', (data) => {
      console.log(JSON.stringify(data)
  });
```
>
>NOTE: **{busno}** and **breakdown** are to be passed in the *API-URL* only, not as *Form Payload*.

**URL** : `/api/1.0/buses/{busno}/breakdowns/{breakdown}`

**Method** : `PUT`

**Auth required** : NO

**Data constraints**

```json
{
    "breakdown" : "[valid breakdown id e.g 14]",
    "message"   : "[string]",
    "time"      : "[Time is valid DateTime string in format year-month-day hour:min:sec]"
}
```

**Data example for a bus**

```json
{
   "message"   :"The bus's tyre is punctured the bus may delayed for sometime.",
   "time"      : "2018-06-10 12:51:23"
}
```

## Success Response

**Code** : `200 Ok`

**Content example on ist time**

```json
{
    "status"  : "updated",
    "message" : "The Breakdown message has been updated for students successfully."
}
```

## Error Response

**Condition** : If '{busno}'  passed in api is not found in database.

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

**Condition** : If 'breakdown'  passed in the api is not found in database.

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