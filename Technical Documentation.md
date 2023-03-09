# **Partx's Technical documentation**

## Languages ​​used
* HTML/CSS
* PHP 7.4.9
* JavaScript
* SQL

## Database

### **MCD**

![MCD](https://raw.githubusercontent.com/mahecpnv/Partx/main/Documentation/Conception/MCD/v1.0/Partx_MCD_v1.0.png?token=AOSK3ZL3T6M2NP6LIEZPKYTA2GF2Y)

### **MLD**
![MLD](https://raw.githubusercontent.com/mahecpnv/Partx/main/Documentation/Conception/MLD/MLD_Partx.png?token=AOSK3ZORBG4356JXJ6A7IJLA2GF62)

***
## File structure
We used the *'Model-View-Controller'* software architecture. We separated the controller's and model's files in two groups. One to manage the users (register, login, get etc.), and one to manage the events (add, update, delete, get etc.). In the controller, we also have a file only for redirections. To connect to the database, we use another file. This file make the connection to the DB, execute de query (execute Select query or IUD Query), and return values from the execution. -> *true* or *false* for IUD queries and arrays with values for the selection queries.

***

## Libraries
* BootStrap - v4.0.0
* Font-Awesome
* themify icons
* Animate css

***
