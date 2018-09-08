
# Buses

Used to collect the buses collection, with bus driver and coordinator details.

**URL** : `/api/1.0/buses`

**Method** : `GET`

**Auth required** : NO

**Data constraints** : None

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "buses" : [
        {
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
            [],[],[] "....."
          ]
        },
        {
          "bus_no" : 8839,
          "driver" : {
            "name"    : "Rodricks ",
            "cell_no" : 9797556691
          },
          "cordinator" : {
            "name"        : "Bergnaum MD",
            "cell_no"     : 9419980134,
            "department"  : "PGDCS"
          },
          "stops" : [
            [ "Gojwara", "34.129881", "74.836936" ],
            ["Salfia","34.13890", "74.821693"],
            [] "......"
          ]
        },
        {
          "3rd bus obj."
        }, "so on..."
     ]
}
```