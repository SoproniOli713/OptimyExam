!!!DISCLAIMER : My Comments are personal to my preferences and will also disagree to your practices

1. class

- Lack of type declaration, the class methods and properties lack type declaration which makes it a less strict and prone to type-related bugs.
- Inconsistent Use of Encapsulation, making use of protected rather than private
- limited use of contructors for required/essential properties which may lead to incomplete or invalid states
- Overuse of setters, make use of setters if needed only, setters may lead to object inconsistent state, reduces the immutability of the class, make use of contructor to define properties required.
- no validation of input in the setters method
- potential date time mis managent, may introduce bugs when working with timezones
- no comments

Solutions:

- apply type declations for methods and properties for code clarity
- convert propected properties to prive
- make use of constructor to set properties
- make use of setter functions only to properties that are mutable
- add validation for input related
- enforce DateTime for date time related parameters
- add documentation of methods for better understanding

2. DB.php

- hardcoded credentials, this is a security risk, less code flexible
- no error handling for the connection establishment
- violates SRP(Single Responsibility Pattern), it handles connection and database queries
- can improve naming conventions for the methods, like exec
- not using prepared statements, SQL injections attacks can be achieved
- add explicit function to close database connection
- no comments

Solutions:

- make use of env variables or config files to store sensitive information
- implement error handling using try catch blocks
- separate the database connection and query execution logic
- make a more meaningful naming conventions
- make use of prepared statement
- add close function so we have the ability to close the connection explicitly
- add documentation of methods for better understanding

3. NewsManager.php & CommentManager.php

- using of hard coded sql queries with the use of sting concatenation, which unsafe and sql injection attacks
- no error handling, if a query fails
- database logic and business logic are combined together
- no validation of inputs
- instantiating the direct filepaths to the constructor, will cause error when changing file paths
- consider limit of number of records to fetch on the database if needed
- inefficient way to delete comments, can make use of news_id directly no need to loop
- no type hinting
- no comments

Solutions:

- use of prepared statement to prevent SQL injection
- wrap database operations into a try-catch blocks to properly handle exceptions and return more user-friendly error message
- separate the database logic and business logic to promote SRP
- add validation for inputs, escape inputs to prevent XSS or SQL injection attacks
- use autoloading, instead of using require filepaths
- add pagination if needed
- create a function to delete comments using news id
- add type hinting for return types and parameters for code clarity
- add documentation of methods for better understanding

4. Project Structure

- can give more a meaningful project structure

Solution:

- Follow a PSR recommendations, can promote readbility, maintainability

5. No Testing, added a sample of test only

Special Notes :: It is using a singleton programming pattern, it's ok to create small application. But when the project grow bigger, it's better to make use of Dependency Inversion Pattern. It will make more the code base to be testable and flexible when introducing new functionality.
