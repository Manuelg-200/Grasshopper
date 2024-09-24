Feature: Header Buttons Click

    @smoke
    Scenario: Click on a navbar button while unlogged
        Given I am in the home page
        And I am not logged in
        When I click on the Chi Siamo button
        Then I should be taken to the companyBio page
        When I click on the Negozio button
        Then I should be taken to the shop page
        When I click on the Home button
        Then I should be taken to the index page
        When I click on the Accedi button
        Then I should be taken to the LoginForm page
        When I click on the Registrati button
        Then I should be taken to the RegistrationForm page
        
    # The test for the logout button is elsewhere
   @smoke @login
    Scenario: Click on a navbar button while logged
        Given I am logged in
        And I am in the home page
        When I click on the Chi Siamo button
        Then I should be taken to the companyBio page
        When I click on the Negozio button
        Then I should be taken to the shop page
        When I click on the Home button
        Then I should be taken to the index page
        When I click on the Profilo button
        Then I should be taken to the show_profile page
