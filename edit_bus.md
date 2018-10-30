
# Edit an existing Bus.  
  
Used to create a new bus into the bus inventory.  
  
**URL** : `/api/admin/1.0/buses/busno/edit`  
  
**Method** : `PUT`  
  
**Auth required** : Yes  
>**NOTE** : Pass the **busno** of the bus you want to edit in the *API-URL*  

>Set the headers 
```  
	Content-Type : application/json,  
	Accept: application/json,  
	Authorization : Bearer admin_api_token.  
```  
>**Example** : Suppose you created the bus with bus_no 8840, and it was saved successfully using _create bus api_ , now you want to edit both the bus_no and gps_device_id.  

The endpoint to edit this bus is  
 ```  
 PUT : api/admin/1.0/buses/8840/edit  
 ```   
 make a PUT request, and pass the form with fields   
 ```  
 bus_no  
 gps_device_id   
 ```  
 as shown in **Data example for a bus**  
  
>**Authorization Header** need to be set in the post request api, **and please keep space between Bearer and api_token.**  

>Example:  Authorization : Bearer **api_token**.  
>
>Where **api_token** is the token recieved on login.  
  
  
**Data constraints**  
>Note: This is the actual form that need to be passed as payload to api.  
```json  
{  
    "bus_no"       : "[valid bus no of as bus e.g 8840, to be passed as form payload]",  
    "gps_device_id"  : "[unique gps device id]",  
}  
```  
  
**Data example for a bus**  
  
```json  
{  
   "bus_no"  : 8812,  
   "gps_device_id" : "sdsada-123Wwdqw-sadas142-sssdass"  
}  
```  
  
## Success Response  
  
**Code** : `201 Created`  
```json  
{  
  "status": "created"  
}  
```  
## Error Response  
  
**Condition** : If 'busno'  passed in form payload or gps_device id is  already found in database.  
  
**Code** : `422 Unprocessable Entity`  
  
**Content** :  
  
```json  
{  
   "errors": {  
        "bus_no": [  
            "The bus no has already been taken."  
        ],  
        "gps_device_id": [  
            "The gps device id has already been taken."  
        ]  
    }  
}  
```