# Get Buses

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
          "stops" : {
            "names"   : "Kashmir University,Main Campus;Kanitar;Omar Colony;Salfia;Lal Bazar;Molvi Stop;Bota Kadal;Mill Stop;Alamgari Bazar;Hawal;Islamia College;Gojwara;Rajori kadal;Kawdara;Nawa kadal",
            "latLngs" : [
                [ "34.129881", "74.836936" ],
                [ "34.135726", "74.828302" ],
                [ "34.133820", "74.824463" ],
                [ "34.13890", "74.821693" ],
                [ "34.127520", "34.812982" ],
                "...... so on"
            ]
          }
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
          "stops" : {
            "names"   : "Kashmir University,Main Campus;Kanitar;Omar Colony;Salfia;Lal Bazar;Molvi Stop;Bota Kadal;Mill Stop;Alamgari Bazar;Hawal;Islamia College;Gojwara;Rajori kadal;Kawdara;Nawa kadal",
            "latLngs" : [
                [ "34.129881", "74.836936" ],
                [ "34.135726", "74.828302" ],
                [ "34.133820", "74.824463" ],
                [ "34.13890", "74.821693" ],
                [ "34.127520", "34.812982" ],
                "...... so on"
            ]
          }
        },
        {
          "3rd bus obj."
        }, "so on..."
    ]
}
```