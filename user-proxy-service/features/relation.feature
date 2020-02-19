Feature: Relation feature

  @database-clear
  Scenario: Add new football match comment
    Given I am authenticated as 'admin' with 'password' password
    And I send 'POST' request to '/api/relation/football-match/1' with data:
    """
    {
	  "content": "Example relation comment"
    }
    """
    Then the response status code should be 200
    And the response should contain "id"
    And the response should contain "date"
    And the JSON node "content" should be equal to "Example relation comment"

  Scenario: Edit football match comment
    Given I am authenticated as 'admin' with 'password' password
    And I send 'PATCH' request to '/api/relation/1' with data:
    """
    {
	  "content": "Example relation comment - updated!"
    }
    """
    Then the response status code should be 200
    And the JSON node "content" should be equal to "Example relation comment - updated!"

  Scenario: Get all football match comments
    Given I am authenticated as 'normal_user' with 'password' password
    And I send 'GET' request to '/api/relation/football-match/1/complete'
    Then the response status code should be 200
    And the response should contain array with 1 element
