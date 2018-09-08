
# Bus

Used to collect the coordinator, driver details for a bus..

**URL** : `/api/1.0/buses/busno`

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
      "stops" : [
        [ "Kashmir University,Main Campus", "34.129881", "74.836936" ],
        [ "Kanitar", "34.135726", "74.828302" ],
        ["Omar Colony","34.133820","74.824463"],
        ["Salfia","34.13890","74.821693"],
        [ "Lal Bazar","127520","812982" ],
        [ "Molvi Stop", "34.123011", "74.816494" ],
        [ "Bota Kadal", "34.120178","74.813594"],
        [ "Mill Stop", "34.120390","74.806293"],
        ["Alamgari Bazar","34.119586","74.80666"],
        [ "Hawal", "34.111408","74.809138"],
        ["Islamia College","34.104483","74.808966"],
        [ "Gojwara","34.101022","74.809374"],
        [ "Rajori kadal", "34.099410", "74.205449"],
        [ "Kawdara","34.098961","74.802270"],
        [ "Nawa kadal","34.095895","74.798385"]
      ]
    }
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