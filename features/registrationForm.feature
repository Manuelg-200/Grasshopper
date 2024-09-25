Feature: Subscribe

    Background: 
        Given I am not logged in
        And I am in the registration page

    @smoke @regression @important @signup @databse
    Scenario: Subscribe
        When I insert valid data in the form
        And I click the submit button
        Then I should see a confirmation message

    @smoke @signup
    Scenario: Submit button starting disabled
        Then The submit button should be disabled

    @ui @signup
    Scenario: Insert valid data
        When I insert valid data in the form
        Then The submit button should be enabled
        And The form fields should be colored green

    @ui @signup @slow
    Scenario Outline: Insert invalid name
        When I insert a <name> in the field that is not valid
        Then The submit button should be disabled
        And The name field should be colored red
        And An <error> message should be displayed

        Examples:
            | name                                                   | error |
            | aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa | Nome troppo lungo |
            | 12345                                                  | Caratteri speciali non ammessi |