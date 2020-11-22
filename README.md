# projectLitServer
the restful server for consuming lights from SQL backend

GET commands:
    All:
        returns all light array data
    ARRAY1:
        returns array1 data


PUT commands:
    ALLON:
        turns on all lights of array number given in body "array": #
    ALLOFF:
        turns off all lights of array number given in body "array": #
    TURNON:
    TURNOFF:
Basic setup of XAMPP for MySQL and APACHE server shown in the first five minutes of this video:
https://youtu.be/OEWXbpUMODk


To open SQL database in MYSQL Workbench: 
1) Start MySQL in XAMPP
2) On MySQL Workbench homepage, click "Local Instance ####"
3) Ignore the warning and select "Continue Anyway"
