Feature: Team feature

  @database-clear
  Scenario: Add new team
    Given I send 'POST' request to '/api/team' with data:
    """
    {
	  "name": "Example team name"
    }
    """
    Then the response status code should be 200
    And the JSON node 'id' should exist

  Scenario: Edit team
    Given I send 'PATCH' request to '/api/team/1' with data:
    """
    {
	  "name": "Example team name - edited"
    }
    """
    Then the response status code should be 200
    And the JSON node 'name' should contain 'Example team name - edited'

  Scenario: View team
    Given I send 'GET' request to '/api/team/1'
    Then the response status code should be 200
    And the JSON node 'id' should exist
    And the JSON node 'name' should exist

  Scenario: Delete team
    Given I send 'DELETE' request to '/api/team/1'
    Then the response status code should be 204
