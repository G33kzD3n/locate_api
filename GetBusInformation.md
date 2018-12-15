# Get Bus

Used to collect the complete bus information and its coordinator, driver details ..

**URL** : `/api/1.0/buses/{busno}`

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
    "bus" : {
      "bus_no" : 8840,
      "driver" : {
        "name"    : "Garth Lueilwitz",
        "cell_no" : 9101804206
      },
      "cordinator" : {
        "name"        : "Aidan Bergnaum MD",
        "cell_no"     : 9037980134,
        "department"  : "PGDCS"
      },
      "stops" : {
        "names"  : "Kashmir University,Main Campus;Kanitar;Omar Colony;Salfia;Lal Bazar;Molvi Stop;Bota Kadal;Mill Stop;Alamgari Bazar;Hawal;Islamia College;Gojwara;Rajori kadal;Kawdara;Nawa kadal",
        "latLngs": [
            [ "34.129881", "74.836936" ],
            [ "34.135726", "74.828302" ],
            [ "34.133820", "74.824463" ],
            [ "34.13890", "74.821693" ],
            [ "34.127520", "34.812982" ],
            "...... so on"
        ]
      }
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
        "error_code"   : "resource_not_found_error",
        "error_message": "Resource not found errors arise when your request is trying to access the resources not found in datbase."
    }
}
```