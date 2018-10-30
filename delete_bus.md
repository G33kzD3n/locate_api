
# Delete an existing Bus.  
  
Used to delete an existing bus from the bus inventory.  
  
**URL** : `/api/admin/1.0/buses/busno/delete`  
  
**Method** : `DELETE`  
  
**Auth required** : Yes  
>**NOTE** : Pass the **busno** of the bus you want to delete in the *API-URL*  
>Also set the headers 
```  
Content-Type : application/json,  
Accept: application/json,  
Authorization : Bearer admin_api_token.  
```  
>Example:Suppose you created the bus with bus_no 8840, and it was saved successfully using _create bus api_ , now you want to delete the bus.  
>
The endpoint to delete this bus is  
 ```  
 DELETE : api/admin/1.0/buses/8840/delete  
 ```   
 make a DELETE request, without any payload.
  
>**Authorization Header** need to be set in the post request api, **and please keep space between Bearer and api_token.**  
>Example:  Authorization : Bearer **api_token**.  
>Where **api_token** is the token recieved on login.  
  
  
**Data constraints**   None  
  
**Data example for a bus**  
  
```json  
{  
   "busno"  : "8812 passed in url, not as form element"  
    
}  
```  
  
## Success Response  
  
**Code** : `200 Ok`  
```json  
{  
  "status": "deleted"  
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