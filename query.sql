1 - Write a mysql statement to find the full name where the age of the employee is
greater than 30.

SELECT CONCAT(first_name , ' ' , last_name ) as full_name from employee WHERE age > 30.

2. Write a mysql statement to get the user, current date and mysql version.

 SELECT VERSION(), USER(), CURRENT_DATE();

3.Write a mysql statement to create a new user and set a password and privileges
for an existing database.

 GRANT ALL PRIVILEGES ON dbTest.* To 'user'@'hostname' IDENTIFIED BY 'password';

4. Write a mysql query to select data of only CS and IT students

 SELECT * FROM students WHERE department = 'CS' OR department = 'IT';

5. Write a mysql statement to select data of all departments in descending order
by age.

SELECT * FROM students ORDER BY age DESC;

6. Write a mysql query to determine the age of each students

SELECT name,birth, TIMESTAMPDIFF(YEAR, birth, CURDATE()) AS age FROM test;

7. Write a mysql statement to find name, birth, department name, department
block from the given tables

SELECT t1.name, t1.birth, t2.dept_name, t2.dept_block, FROM students as t1 LEFT JOIN departments as t2 ON t1.id = t2.dept_id

8. Delete duplicate row from the table

DELETE FROM table WHERE id NOT IN (SELECT MIN(id) FROM table GROUP BY first_name,last_name,email);

9. Write a mysql query to get the nth highest paid and nth lowest paid salary

SELECT * FROM Employee WHERE salary = ( SELECT MIN(salary) FROM Employee  WHERE  salary IN ( SELECT DISTINCT TOP N salary FROM Employee ORDER BY salary DESC))