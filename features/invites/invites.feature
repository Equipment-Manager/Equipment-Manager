Feature: Invites

	Background:
		Given the following users are created:
			| id | email             |
			| 1  | admin@example.com |
			| 2  | user@example.com  |
		And the following permissions are created:
			| id | name           | guard_name |
			| 1  | Manage invites | web        |
		And the following roles are created:
			| id | name  | guard_name |
			| 1  | Admin | web        |
		And a role "Admin" can "Manage invites"
		And the following invites are created:
			| id | email                | token                                | status   |
			| 1  | invited@example.com  | 00000000-0000-0000-0000-000000000000 | pending  |
			| 2  | accepted@example.com | 00000000-0000-0000-0000-000000000001 | accepted |

	Scenario: Guest user tries to send invite
		Given a user is requesting "/api/invite" using "POST" method
		And a request body contains "email" equal "new_user@example.com"
		When a request is sent
		Then a response status code should be "401"

	Scenario: User without permissions tries to send invite
		Given a user is requesting "/api/invite" using "POST" method
		And a request body contains "email" equal "new_user@example.com"
		And a user is logged in as "user@example.com"
		When a request is sent
		Then a response status code should be "403"

	Scenario: Admin is inviting a new user
		Given a user is requesting "/api/invite" using "POST" method
		And a request body contains "email" equal "new_user@example.com"
		And a user is logged in as "admin@example.com"
		And a user have role "Admin"
		When a request is sent
		Then an invite with "new_user@example.com" should be created
		And an invite status should be "pending"
		Then a response status code should be "200"

	Scenario: An user is canceling an pending invite
		Given a user is requesting "/api/invite/cancel/00000000-0000-0000-0000-000000000000" using "POST" method
		And a user is logged in as "user@example.com"
		When a request is sent
		Then a response status code should be "403"

	Scenario: Admin is canceling an pending invite
		Given a user is requesting "/api/invite/cancel/00000000-0000-0000-0000-000000000000" using "POST" method
		And a user is logged in as "admin@example.com"
		And a user have role "Admin"
		When a request is sent
		Then a response status code should be "200"
		And an invite with token "00000000-0000-0000-0000-000000000000" should be "canceled"

	Scenario: Admin is canceling an accepted invite
		Given a user is requesting "/api/invite/cancel/00000000-0000-0000-0000-000000000001" using "POST" method
		And a user is logged in as "admin@example.com"
		And a user have role "Admin"
		When a request is sent
		Then a response status code should be "404"