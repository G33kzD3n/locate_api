# Get Bus Passengers
Used to collect the ordered collection of passengers belonging to a bus, ordered in increasing order[1,2,3..] of stop_no.

**URL** : `/api/1.0/buses/busno/passengers`

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
    "passengers" : [
      {
          "username"        :  15045112018,
          "name"            :  "Lucas Langosh",
          "dept_code"       :  "DCSE",
          "course_code"     :  "IMBA",
          "semester_level"  :  "2",
          "avatar"          :  "path_to_image",
          "cell_no"         :  9026787553,
          "level"           :  "0",
          "stop"            :  {
               "name"   :  "Kanitar",
               "lat"    :  34.135726,
               "lng"    :  74.828302,
               "stop_no":  2
          }
      },
      {
          "username"        :  15045112001,
          "name"            :  "Jaeden Frami",
          "dept_code"       :  "PGDENG",
          "course_code"     :  "MCA",
          "semester_level"  :  "3",
          "avatar"          :  "path_to_image",
          "cell_no"         :  9026787553,
          "level"           :  "0",
          "stop"            :  {
               "name"   :  "Lal Bazar",
               "lat"    :  34.135726,
               "lng"    :  74.828302,
               "stop_no":  5
          }
      },
      {
          "so on..."
      }
    ]
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