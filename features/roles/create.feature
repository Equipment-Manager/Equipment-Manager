Feature: Create Role

	Background:
		Given the following users are created:
			| id | email             |
			| 1  | admin@example.com |
			| 2  | user@example.com  |
		And the following permissions are created:
			| id | name               | guard_name |
			| 1  | Manage permissions | web        |
		And the following roles are created:
			| id | name      | guard_name |
			| 1  | Admin     | web        |
			| 2  | Moderator | web        |
		And a role "Admin" can "Manage permissions"

	Scenario: Guest user tries to create a role
		Given a user is requesting "/api/roles/add" using "POST" method
		And a request body contains "name" equal "New Role"
		When a request is sent
		Then a response status code should be "401"

	Scenario: User without permissions tries to create a role
		Given a user is requesting "/api/roles/add" using "POST" method
		And a request body contains "name" equal "New Role"
		And a user is logged in as "user@example.com"
		When a request is sent
		Then a response status code should be "403"

	Scenario: Admin is creating a new role
		Given a user is requesting "/api/roles/add" using "POST" method
		And a request body contains "name" equal "New role"
		And a user is logged in as "admin@example.com"
		And a user have role "Admin"
		When a request is sent
		Then a role with "New role" should be created
		Then a response status code should be "201"