Feature: Relation feature

  @database-clear
  Scenario: Add new event comment
    Given I send 'POST' request to '/api/relation/event/1' with data:
    """
    {
	  "content": "Example relation comment"
    }
    """
    Then the response status code should be 200
    And the response should contain "id"
    And the response should contain "date"
    And the JSON node "content" should be equal to "Example relation comment"

  Scenario: Edit event comment
    Given I send 'PATCH' request to '/api/relation/1' with data:
    """
    {
	  "content": "Example relation comment - updated!"
    }
    """
    Then the response status code should be 200
    And the JSON node "content" should be equal to "Example relation comment - updated!"


  Scenario: Get all event comments
    Given I send 'GET' request to '/api/relation/event/1/complete'
    Then the response status code should be 200
    And the response should contain array with 1 elements
