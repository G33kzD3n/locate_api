
#  Passengers grouped under Stops.
 Used to collect the ordered collection of passengers belonging to a bus, grouped under a stop , sorted on stop_no [1,2,3,....].

**URL** : `api/1.0/buses/busno/passengers?groupby=stopnames`



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



##  Success Response



**Code** : `200 OK`



**Content example**



```json

{[
	{
		"stop"   : {
			"name"       : "Kashmir University,Main Campus",
			"stop_no"    : 1,
			"lat"        : 34.129881,
			"lng"        : 74.836936,
			"passengers" : [
				{
					"username"      : 15045112614,
					"name"          : "Aletha Pacocha Sr.",
					"dept_code"     : "DCSE",
					"course_code"   : "IMBA",
					"semester_level": 4,
					"avatar"        : "path_to_image",
					"cell_no"       : 9103598514,
					"level"         : 0
				},
				{
					"username"      : 15045115083,
					"name"          : "Freida Adams",
					"dept_code"     : "PGDENG",
					"course_code"   : "BTECHCSE",
					"semester_level": 1,
					"avatar"        : "path_to_image",
					"cell_no"       : 9102394698,
					"level"         : 0
				},
				{
					"username"      : 15045114121,
					"name"          : "Dr. Hermina Schulist",
					"dept_code"     : "DCSE",
					"course_code"   : "BTECHCSE",
					"semester_level": 4,
					"avatar"        : "path_to_image",
					"cell_no"	    : 9029054171,
					"level"         : 0
				}
		   ]
		}
	},
	{
		"stop"{
			"name",
			"stop_no",
			"lat",
			"lng",
			"passengers" : [
				{
					"username",
					"name",
					"dept_code",
					"course_code",
					"semester_level",
					"avatar",
					"cell_no",
					"level"
				},
				{
				}
			]
		}
		..next stop like and so on
	}
]}
```



##  Error Response



**Condition** : If 'busno' passed is not found in database.



**Code** : `404 Not Found`



**Content** :



```json

{

"error": {

"error_code" : "resource_not_found_error",

"error_message": "Resource not found errors arise when your request is trying to access the resources not found in datbase."

}

}

```