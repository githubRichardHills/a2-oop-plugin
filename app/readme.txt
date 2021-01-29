

1) a2-oop-plugin.php requires init.php which, in turn, requires Dbh.php and Controller.php.
2) a2-oop-plugin.php then instantiates $Controller, which is a new object of the Controller class.
3) the __construct() method calls to include the Model class
4) the __construct() method of the Controller class parses any user input and calls the appropriate method of the Controller class, passing whatever parameters have been recieved.
5) the __construct() method of the Controller class includes the View class and then instantiates it, passing an argument
