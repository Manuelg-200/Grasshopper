Feature: Subscribe

    @smoke @regression @important @signup
    Scenario: Subscribe
        Given I am not logged in
        And I am in the registration page
        When I subscribe
        Then I should see a confirmation message